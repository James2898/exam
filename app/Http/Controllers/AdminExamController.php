<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Config;
use DateTime;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\Form;
use App\Models\Question;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AdminExamController extends Controller
{
    public function index()
    {
        $exams = DB::table('exams')
            ->get();
        return view('admin.exams.index', compact('exams'));
    }

    public function forms($exam_id)
    {
        $exam = Exam::find($exam_id);
        $subjects = Subject::whereIn('id',explode(',',$exam->subject_id))->get();

        $exam_subjects = explode(',', $exam->subject_id);

        $forms = Form::where('exam_id',$exam_id)
            ->join('questions','questions.id','=','forms.question_id')
            ->orderBy('forms.subject_id')
            ->get();
        $subject_questions = Question::whereIn('subject_id',explode(',',$exam->subject_id))->get();
        $exam_questions = [];
        $questions = [];
        
        foreach ($subject_questions as $item) {
            $questions += [$item->subject_id => array()];
        }
        foreach ($forms as $item) {
            $exam_questions += [$item->subject_id => array()];
        }

        foreach ($subject_questions as $item) {
            $subject_id = $item->subject_id;
            array_push($questions[$subject_id],array(
                'type'    => $item->type,
                'question_id'        => $item->id,
                'question'  => $item->description,
                'options'   => array($item->option_1,$item->option_2,$item->option_3,$item->option_4),
                'answer'    => $item->answer
            ));
        }

        foreach ($forms as $item) {
            $subject_id = $item->subject_id;
            $exam_questions[$subject_id] += [$item->id => $item->id];
        }

        return view('admin.exams.forms', compact(['exam','subjects','exam_subjects','questions','exam_questions']));
    }

    public function toggleAssign(request $request)
    {
        $exam = Exam::find($request->exam_id);
        $form = Form::where('question_id',$request->question_id);
        if(count($form->get())) {
            $form->delete();
        }else {
            Form::create([
                'exam_id'       => $exam->id,
                'subject_id'    => $request->subject_id,
                'question_id'   => $request->question_id,
            ]);
        }
        return redirect(route('admin.exams.forms',$exam->id))->with('alert', 'Question Assigned to Exam!');
    }

    public function create(){
        $subjects = DB::table('subjects')
            ->where('status',1)
            ->get();
        return view('admin.exams.create',compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjects'      => 'required|string|',
            'description'   => 'required|string|max:64',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'duration'      => 'required|integer',
            'qty'           => 'required|integer',
        ]);
        
        $start_datetime = $request->schedule_date." ".$request->schedule_time;
        $end_datetime = new DateTime($start_datetime);
        $subject_count = count(explode(', ',$request->exam_subjects));

        // dd($request);
        $exam = Exam::create([
            'subject_id'    => $request->exam_subjects,
            'description'   => $request->description,
            'duration'      => $request->duration,
            'qty'           => $request->qty,
            'start_datetime' => $start_datetime,
            'end_datetime'  => $end_datetime->modify("+".($request->duration * $subject_count)." minutes"),
            'status'        => 1 //Draft
        ]);

        
        DB::update(
            'update exams set exam_id = ? where id = ?', [Carbon::now()->format('Y').(Str::padleft($exam->id,3,'0')), $exam->id]
        );

        return redirect(route('admin.exams'))->with('alert', 'Exam Created!');;
    }

    public function edit($id)
    {
        $exam = Exam::find($id);
        $subjects = DB::table('subjects')
            ->where('status',1)
            ->get();
        $exam_subjects = explode(',', $exam->subject_id);
        // dd($exam_subjects);
        return view('admin.exams.edit', compact(['exam','subjects','exam_subjects']));
    }

    public function update(Request $request)
    {
        $request->validate([
            'subjects'      => 'required|string|',
            'description'   => 'required|string|max:64',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'duration'      => 'required|integer',
            'qty'           => 'required|integer',
        ]);
        
        $start_datetime = $request->schedule_date." ".$request->schedule_time;
        $end_datetime = new DateTime($start_datetime);
        $subject_count = count(explode(', ',$request->exam_subjects));

        $exam = Exam::find($request->id);

        $exam->update([
            'subject_id'    => $request->subjects,
            'description'   => $request->description,
            'duration'      => $request->duration,
            'qty'           => $request->qty,
            'start_datetime' => $start_datetime,
            'end_datetime'  => $end_datetime->modify("+".($request->duration * $subject_count)." minutes"),
            'status'        => $request->status
        ]);

        return redirect(route('admin.exams.edit',$request->id))->with('alert', 'Exam Updated!');
    }


    public function delete($id)
    {
        Exam::find($id)->delete();

        return redirect(route('admin.exams'))->with('alert', 'Exam Deleted!');
    }
}

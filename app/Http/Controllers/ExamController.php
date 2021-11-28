<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Config;
use DateTime;
use Carbon\Carbon;
use App\Models\Question;
use App\Models\Form;
use App\Models\Subject;
use App\Models\ExamineeForm;
use App\Models\Exam;
use App\Models\Examinee;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ExamController extends Controller
{
    public function index()
    {
        $exam_id = Examinee::where('user_id',Auth::user()->id)->get()[0]->exam_id;

        $exam = DB::table('exams')
                ->where('id',$exam_id)    
                ->first();
        
        $exam_startdatetime = null;
        $exam_enddatetime = null;
        $now_datetime = null;
        if ($exam->status != 4){
            // dd($exam);
            $exam_startdatetime = Carbon::parse($exam->start_datetime);
            $exam_enddatetime = Carbon::parse($exam->start_datetime);
            foreach (explode(', ',$exam->subject_id) as $subject) {
                $exam_enddatetime->addMinutes($exam->duration);
            }
            $now_datetime = Carbon::now();

            return view('exams.index', compact(['exam','exam_startdatetime','exam_enddatetime','now_datetime']));
        } else {
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
            
            $examinee_forms = DB::table('examinee_forms')
                ->selectRaw('subject_id as subject_id, count(result) as result')
                ->where('examinee_id',Auth::user()->id)
                ->where('result',1)
                ->groupBy('subject_id')
                ->groupBy('examinee_id')
                ->get();

            $exam_subjects = DB::table('forms')
                ->selectRaw('subject_id as subject_id, count(subject_id) as subject_count')
                ->groupBy('subject_id')
                ->get();

            $examinee_form = [];
            foreach ($examinee_forms as $item) {
                $subject_id = $item->subject_id;
                $exam_questions[$subject_id] += ['score' => $item->result];
            }

            foreach ($forms as $item) {
                if(!isset($exam_questions[$item->subject_id]['score'])) {
                    $exam_questions[$item->subject_id] += ['score' => 0];
                }
            }

            foreach ($exam_subjects as $item) {
                $subject_id = $item->subject_id;
                $exam_questions[$subject_id] += ['questions' => $item->subject_count];
            }

            // dd($exam_questions);

            return view('exams.results', compact(['exam','subjects','exam_subjects','questions','exam_questions']));
        }

    }

    public function questions(request $request)
    {
        $examinee = Examinee::where('user_id',Auth::user()->id)->first();
        $examinee_id = $examinee->user_id;
        $exam  = Exam::find($examinee->exam_id);
        $subjects = Subject::whereIn('id',explode(',',$exam->subject_id))->get();

        $exam_time = Carbon::parse($exam->start_datetime);
        $now_datetime = Carbon::now();
        
        $exam_start = null;
        $exam_end = null;
        $exam_id = $examinee->exam_id;
        $subject_to_exam = 0;
        foreach ($subjects as $subject) {
            $temp = $exam_time;
            $exam_start = Carbon::parse($temp->format('Y-m-d H:i:s'));
            $temp->addMinutes($exam->duration);
            $exam_end = Carbon::parse($temp->format('Y-m-d H:i:s'));

            if ($now_datetime->greaterThanOrEqualto($exam_start) && $now_datetime->lessThan($exam_end)){
                $subject_to_exam = $subject->id;
                break;
            }
        }

        // Return to Index in case of Exam End
        if ($now_datetime->greaterThanOrEqualto($exam_end)) {
            return redirect(route('exams'));
        }
        // dd($exam_start->format('Y-m-d H:i:s'),$exam_end->format('Y-m-d H:i:s'));

        $forms = Form::where('exam_id',$examinee->exam_id)
                    ->join('questions','questions.id','=','forms.question_id')
                    // ->join('examinee_forms','examinee_forms.exam_id','=','forms.exam_id')
                    ->orderBy('forms.question_id','ASC')
                    ->where('forms.subject_id',$subject_to_exam);
        
        $examinee_form = ExamineeForm::where('exam_id',intval($examinee->exam_id))
            ->where('examinee_id',$examinee->user_id);
        // dd($examinee->exam_id);
        // dd(ExamineeForm::where('exam_id','=',intval($examinee->exam_id))->get());
        $examinee_form_lists = array();
        foreach ($examinee_form->get() as $exam) {
            $examinee_form_lists += [$exam->question_id => $exam->answer];
        }

        $subject = Subject::find($subject_to_exam);

        $questions_list = array();
        $i = 1;
        foreach ($forms->get() as $form) {
            $questions_list += [$i++ => array(
                'question_id' => $form->question_id,
                'question'  => $form->description,
                'type'      => $form->type,
                'options'   => implode(",",array($form->option_1,$form->option_2,$form->option_3,$form->option_4)),
                'answer'    => $form->answer
            )];
        }
        $question_no = $request->question ? $request->question : 1;
        // dd($examinee_form_lists);
        // dd($questions_list[$question_no],$examinee_form_lists[$questions_list[$question_no]['question_id']]);
        return view('exams.questions',compact('questions_list','subject','question_no','exam_id','examinee_form_lists','exam_start','exam_end'));
    }

    public function answer(request $request) {
        $question = Question::where('question_id',$request->question_id)->first();
        $result = strtolower($request->answer) == strtolower($question->answer) ? 1 : 0;

        if (count(ExamineeForm::where('question_id',$request->question_id)->where('examinee_id',Auth::user()->id)->get())){
            ExamineeForm::where('question_id',$request->question_id)
                ->where('examinee_id',Auth::user()->id)
                ->update([
                'question'      => implode('-',array(
                    $question->description,
                    $question->option_1,
                    $question->option_2,
                    $question->option_3,
                    $question->option_4
                )),
                'answer'        => $request->answer,
                'result'        => $result
            ]);
        }else {
            ExamineeForm::create([
                'examinee_id'   => Auth::user()->id,
                'exam_id'       => $request->exam_id,
                'subject_id'    => $request->subject_id,
                'question_id'   => $request->question_id,
                'question'      => implode('-',array(
                        $question->description,
                        $question->option_1,
                        $question->option_2,
                        $question->option_3,
                        $question->option_4
                    )),
                'answer'        => $request->answer,
                'result'        => $result
            ]);
        }
        return redirect(route('exams.questions',['id' => Auth::user()->id, 'question' => $request->question_no]))->with('alert', 'Exam Updated!');
    }

}

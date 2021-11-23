<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Config;
use DateTime;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
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

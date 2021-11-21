<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use Config;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class QuestionController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function identification($id)
    {

        $questions = Question::where('subject_id',$id)
            ->where('type',Config::get('constants.question.type.identification.no'))
            ->orderBy('questions.question_id','ASC')
            ->get();
        
        $subject = Subject::find($id);
            
        return view('questions.identification', compact(['questions','subject']));
    }

    public function multiple($id)
    {
        $questions = Question::where('subject_id',$id)
            ->where('type',Config::get('constants.question.type.multiple.no'))
            ->orderBy('questions.question_id','ASC')
            ->get();
        
        $subject = Subject::find($id);
            
        return view('questions.multiple', compact(['questions','subject']));
    }

    public function create($id)
    {
        $subject =  Subject::find($id);
        return view('questions.create', compact(['subject']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id'    => 'required|string|max:12',
            'type'          => 'required|integer',
            'question'   => 'required|string|max:255',
        ]);

        // dd($request);

        $type = $request->type;
        if ($type == 1){
            $request->validate([
                'answer_identification'    => 'required|string|max:64'
            ]);
        } else if ($type == 2) {
            $request->validate([
                'option_1'          => 'required|string|max:255',
                'option_2'          => 'required|string|max:255',
                'option_3'          => 'required|string|max:255',
                'option_4'          => 'required|string|max:255',
                'answer_multiple'   => 'required|string|max:64'
            ]);
        }

        $question = Question::create([
            'subject_id'    => $request->subject_id,
            'type'          => $request->type,
            'description'   => $request->question,
            'answer'        => ''
        ]);

        $subject = Subject::find($question->subject_id);
        if ($type == 1) {
            $question->update([
                'question_id'   => $subject->code."-".(Str::padleft($question->id,3,'0')), $question->id,
                'answer'        => $request->answer_identification,
            ]);
        }else if ($type == 2){
            $question->update([
                'question_id'   => $subject->code."-".(Str::padleft($question->id,3,'0')), $question->id,
                'option_1'      => $request->option_1,
                'option_2'      => $request->option_2,
                'option_3'      => $request->option_3,
                'option_4'      => $request->option_4,
                'answer'        => $request->answer_multiple,
            ]);
        }

        $route = $type == 1 ? 'questions.identification' : 'questions.multiple';
        return redirect(route($route,$subject->id))->with('alert', 'Question Created!');;
    }

    public function edit($id)
    {
        $question = Question::find($id);
        $subject = Subject::find($question->subject_id);
    
        return view('questions.edit', compact(['question','subject']));
    }

    public function update(Request $request)
    {

        $question = Question::find($request->id);
        $subject = Subject::find($question->subject_id);

        $request->validate([
            'question'   => 'required|string|max:255',
        ]);

        // dd($request);

        $type = $question->type;
        if ($type == 1){
            $request->validate([
                'answer_identification'    => 'required|string|max:64'
            ]);
        } else if ($type == 2) {
            $request->validate([
                'option_1'          => 'required|string|max:255',
                'option_2'          => 'required|string|max:255',
                'option_3'          => 'required|string|max:255',
                'option_4'          => 'required|string|max:255',
                'answer_multiple'   => 'required|string|max:64'
            ]);
        }

        if ($type == 1) {
            $question->update([
                'answer'        => $request->answer_identification,
            ]);
        }else if ($type == 2){
            $question->update([
                'option_1'      => $request->option_1,
                'option_2'      => $request->option_2,
                'option_3'      => $request->option_3,
                'option_4'      => $request->option_4,
                'answer'        => $request->answer_multiple,
            ]);
        }

        return redirect(route('questions.edit',$request->id))->with('alert', 'Question Updated!');
    }

    public function delete($id)
    {
        $question = Question::find($id);
        $type = $question->type;
        $subject_id = $question->subject_id;

        
        $route = $type == 1 ? 'questions.identification' : 'questions.multiple';
        $question->delete();
        return redirect(route($route,$subject_id))->with('alert', 'Question Deleted!');
    }
}
?>
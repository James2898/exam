<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Examinee;
use App\Models\Exam;
use App\Models\User;
use App\Models\Form;
use App\Models\Subject;
use App\Models\Question;
use Config;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class DashboardController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->role == 2) {
            // dd('hit');
            $examinee = Examinee::where('user_id',Auth::user()->id)->first();
            $exam = Exam::find($examinee->exam_id);
            $examinee_criteria = array();
            $exam_questions = array();
            $questions = array();
            if($exam != NULL && $exam->status == 4) {
                // dd(explode(', ',$exam->subject_id));
                $subjects = Subject::whereIn('subjects.id',explode(',',$exam->subject_id))
                    ->select('subjects.*','criterias.college_id','criterias.course_id','criterias.value')
                    ->join('criterias','criterias.subject_id','=','subjects.id')
                    ->get();
                foreach($subjects as $subject) {
                    $examinee_criteria += [$subject->college_id => array()];
                    $examinee_criteria[$subject->college_id] += [$subject->course_id => array()];
                    $examinee_criteria[$subject->college_id][$subject->course_id] += 
                        [$subject->id => $subject->value];

                    
                }

                // Examinee Criteria Structure
                // College ID
                // Course ID
                // Subject ID

                //

                $subject_questions = Question::whereIn('subject_id',explode(',',$exam->subject_id))->get();

                $examinee_forms = DB::table('examinee_forms')
                ->selectRaw('subject_id as subject_id, count(result) as result')
                ->where('examinee_id',Auth::user()->id)
                ->where('result',1)
                ->groupBy('subject_id')
                ->groupBy('examinee_id')
                ->get();

                $exam_subjects = DB::table('forms')
                ->selectRaw('subject_id as subject_id, count(subject_id) as subject_count')
                ->where('forms.exam_id','=',$examinee->exam_id)
                ->groupBy('subject_id')
                ->get();

                $forms = Form::where('exam_id',$examinee->exam_id)
                ->join('questions','questions.id','=','forms.question_id')
                ->orderBy('forms.subject_id')
                ->get();

                foreach ($subject_questions as $item) {
                    $questions += [$item->subject_id => array()];
                }

                foreach ($forms as $item) {
                    $exam_questions += [$item->subject_id => array()];
                }

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

                foreach ($exam_questions as $subject_id => $item) {
                    $average = ($item['score'] / $item['questions']) *100;
                    $exam_questions[$subject_id] += ['average' => $average];
                }

                // dd($examinee_criteria,$exam_questions);
            }

            return view('examinees.dashboard',compact('examinee','exam','examinee_criteria','exam_questions'));
        }else{
            $examinees = Examinee::all();
            $total_active_examinees = count($examinees->where('status',1));
            $total_passed_examinees = count($examinees->where('status',4));
            $total_waiting_examinees = count($examinees->where('status',0));
            
            $exams = Exam::all();
            $total_exams = count($exams);
            $total_scheduled_exams = count($exams->where('status',2));
            $total_draft_exams = count($exams->where('status',1));
    
            $users = User::all();
            $total_users = count($users->where('role','<',2));
    
            $subjects = Subject::all();
            $total_active_subjects = count($subjects->where('status',1));
    
            return view('dashboard', compact([
                'total_active_examinees',
                'total_passed_examinees',
                'total_waiting_examinees',
                'total_exams',
                'total_scheduled_exams',
                'total_draft_exams',
                'total_users',
                'total_active_subjects'
            ]));
        }

    }
}
?>
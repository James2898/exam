<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Examinee;
use App\Models\User;
use App\Models\Subject;
use App\Models\Form;
use App\Models\Question;
use App\Models\Exam;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class ExamineeController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $examinees = DB::table('examinees')
            ->join('users','users.id','=','examinees.user_id')
            ->select('users.fname','users.lname','users.mname','examinees.*')
            ->orderBy('examinees.id','ASC')
            ->get();
        return view('examinees.index', compact('examinees'));
    }

    public function create()
    {
        return view('examinees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lrn'       => 'required|string|max:12',
            'fname'     => 'required|string|max:64',
            'mname'     => 'required|string|max:64',
            'lname'     => 'required|string|max:64',
            'birthdate' => 'required|date',
            'gender'    => 'required|integer',
            'marital'       => 'required|string',
            'prev_school'   => 'required|string',
            'strand'        => 'required|string',
            'perm_address'  => 'required|string',
            'cur_address'   => 'required|string',
            'no_siblings'   => 'required|integer',
            'order_siblings' => 'required|integer',
            'weight'        => 'required|string',
            'height'        => 'required|string',
            'nationality'   => 'required|string',
            'religion'      => 'required|string',
            'f_fname'       => 'required|string',
            'f_mname'       => 'required|string',
            'f_lname'       => 'required|string',
            'f_occupation'  => 'required|string',
            'f_mobile'      => 'required|string',
            'm_fname'       => 'required|string',
            'm_mname'       => 'required|string',
            'm_lname'       => 'required|string',
            'm_occupation'  => 'required|string',
            'm_mobile'      => 'required|string',
            'emergency_name' => 'required|string',
            'emergency_mobile' => 'required|string',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'mobile'    => 'required|digits:11|unique:users,mobile',
            'college'   => 'required|integer',
            'course'    => 'required|integer',
            'status'    => 'required|integer'
        ]);

        $user = User::create([
            'fname'     => $request->fname,
            'mname'     => $request->mname,
            'lname'     => $request->lname,
            'email'     => $request->email,
            'address'   => $request->cur_address,
            'password'  => Hash::make($request->password),
            'mobile'    => $request->mobile,
            'role'      => 2,
        ]);

        Examinee::create([
            'lrn'       => $request->lrn,
            'user_id'   => $user->id,
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
            'marital'   => $request->marital,
            'prev_school' => $request->prev_school,
            'strand'    => $request->strand,
            'perm_address' => $request->perm_address,
            'cur_address' => $request->cur_address,
            'no_siblings' => $request->no_siblings,
            'order_siblings' => $request->order_siblings,
            'weight'    => $request->weight,
            'height'    => $request->height,
            'nationality'   => $request->nationality,
            'religion'  => $request->religion,
            'f_fname'   => $request->f_fname,
            'f_mname'   => $request->f_mname,
            'f_lname'   => $request->f_lname,
            'f_occupation' => $request->f_occupation,
            'f_mobile'  => $request->f_mobile,
            'm_fname'   => $request->m_fname,
            'm_mname'   => $request->m_mname,
            'm_lname'   => $request->m_lname,
            'm_occupation' => $request->m_occupation,
            'm_mobile'  => $request->m_mobile,
            'emergency_name' => $request->emergency_name, 
            'emergency_mobile' => $request->emergency_mobile,
            'college'   => $request->college,
            'course'    => $request->course,
            'status'    => 0,
        ]);
        return redirect(route('examinees'))->with('alert', 'Examinee Created!');;
    }

    public function edit($id)
    {
        $examinee = DB::table('examinees')
            ->where('examinees.id','=',$id)
            ->leftJoin('users','users.id','=','examinees.user_id')
            ->select(
                'users.fname','users.lname','users.mname',
                'users.email','users.address','users.mobile',
                'examinees.*'
            )
            ->orderBy('examinees.id','ASC')
            ->first();
        $exams = Exam::all();
        return view('examinees.edit', compact(['examinee','exams']));
    }

    public function update(Request $request)
    {

        $examinee = Examinee::find($request->id);
        $user = User::find($examinee->user_id);

        $request->validate([
            'lrn'       => 'required|string|max:12',
            'fname'     => 'required|string|max:64',
            'mname'     => 'required|string|max:64',
            'lname'     => 'required|string|max:64',
            'birthdate' => 'required|date',
            'gender'    => 'required|integer',
            'marital'       => 'required|string',
            'prev_school'   => 'required|string',
            'strand'        => 'required|string',
            'perm_address'  => 'required|string',
            'cur_address'   => 'required|string',
            'no_siblings'   => 'required|integer',
            'order_siblings' => 'required|integer',
            'weight'        => 'required|string',
            'height'        => 'required|string',
            'nationality'   => 'required|string',
            'religion'      => 'required|string',
            'f_fname'       => 'required|string',
            'f_mname'       => 'required|string',
            'f_lname'       => 'required|string',
            'f_occupation'  => 'required|string',
            'f_mobile'      => 'required|string',
            'm_fname'       => 'required|string',
            'm_mname'       => 'required|string',
            'm_lname'       => 'required|string',
            'm_occupation'  => 'required|string',
            'm_mobile'      => 'required|string',
            'emergency_name' => 'required|string',
            'emergency_mobile' => 'required|string',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'mobile'    => 'required|digits:11|unique:users,mobile,'.$user->id,
            'college'   => 'required|integer',
            'course'    => 'required|integer',
            'status'    => 'required|integer'
        ]);

        $user->update([
            'fname'     => $request->fname,
            'mname'     => $request->mname,
            'lname'     => $request->lname,
            'email'     => $request->email,
            'address'   => $request->cur_address,
            'mobile'    => $request->mobile,
            'role'      => 2,
        ]);

        // dd($request);

        $examinee->update([
            'lrn'       => $request->lrn,
            'exam_id'   => $request->exam_id,
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
            'marital'   => $request->marital,
            'prev_school' => $request->prev_school,
            'strand'    => $request->strand,
            'perm_address' => $request->perm_address,
            'cur_address' => $request->cur_address,
            'no_siblings' => $request->no_siblings,
            'order_siblings' => $request->order_siblings,
            'weight'    => $request->weight,
            'height'    => $request->height,
            'nationality'   => $request->nationality,
            'religion'  => $request->religion,
            'f_fname'   => $request->f_fname,
            'f_mname'   => $request->f_mname,
            'f_lname'   => $request->f_lname,
            'f_occupation' => $request->f_occupation,
            'f_mobile'  => $request->f_mobile,
            'm_fname'   => $request->m_fname,
            'm_mname'   => $request->m_mname,
            'm_lname'   => $request->m_lname,
            'm_occupation' => $request->m_occupation,
            'm_mobile'  => $request->m_mobile,
            'emergency_name' => $request->emergency_name, 
            'emergency_mobile' => $request->emergency_mobile,
            'college'   => $request->college,
            'course'    => $request->course,
            'status'    => $request->status,
        ]);

        if($request->password) {
            $validated = Hash::make($request->password);
            Examinee::find($request->id)->update(['password' => $validated]);
        }

        return redirect(route('examinees.edit',$request->id))->with('alert', 'Examinee Updated!');
    }

    public function examinee_results($examinee_id)
    {
        $examinee =  DB::table('examinees')
            ->where('examinees.id','=',$examinee_id)
            ->join('users','users.id','=','examinees.user_id')->first();
        $exam_id = $examinee->exam_id;
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
            ->where('examinee_id',$examinee->user_id)
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

        return view('exams.results', compact(['examinee','exam','subjects','exam_subjects','questions','exam_questions']));
    }

    public function approve($examinee_id)
    {
        $examinee = DB::table('examinees')
            ->where('examinees.id',$examinee_id)
            ->join('users','users.id','=','examinees.user_id');

        $examinee->update([
            'examinees.status' => 1
        ]);
        $examinee = $examinee->first();
        $name = $examinee->lname.", ".$examinee->fname." ".substr($examinee->mname,0,1).".";
        $details = [
            'title' => 'CvSU Online Entrance Exam',
            'name'  => "Hello ".$name.",",
            'body'  => "Your application for an entrance examination has been approved, please wait for further notifications regarding your examination date"
        ];

        \Mail::to($examinee->email)->send(new \App\Mail\CvSuMail($details));

        return redirect(route('examinees'))->with('alert', 'Examinee Approved!');

    }

    public function delete($id)
    {
        $examinee = Examinee::find($id);
        User::find($examinee->user_id)->delete();
        $examinee->delete();

        return redirect(route('examinees'))->with('alert', 'Examinee Deleted!');
    }
}
?>
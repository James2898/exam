<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Examinee;
use App\Models\User;
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

    public function delete($id)
    {
        $examinee = Examinee::find($id);
        User::find($examinee->user_id)->delete();
        $examinee->delete();

        return redirect(route('examinees'))->with('alert', 'Examinee Deleted!');
    }
}
?>
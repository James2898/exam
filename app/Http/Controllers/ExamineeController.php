<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Examinee;
use App\Models\User;
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
            'email'     => 'required|string|email|max:255|unique:users,email',
            'address'   => 'required|string|max:255',
            'mobile'    => 'required|digits:11|unique:users,mobile',
            'college'   => 'required|integer',
            'course'    => 'required|integer'
        ]);

        $user = User::create([
            'fname'     => $request->fname,
            'mname'     => $request->mname,
            'lname'     => $request->lname,
            'email'     => $request->email,
            'address'   => $request->address,
            'password'  => Hash::make($request->password),
            'mobile'    => $request->mobile,
            'role'      => 2,
        ]);

        Examinee::create([
            'lrn'       => $request->lrn,
            'user_id'   => $user->id,
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
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
        return view('examinees.edit', compact('examinee'));
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
            'email'     => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'address'   => 'required|string|max:255',
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
            'address'   => $request->address,
            'mobile'    => $request->mobile,
            'role'      => 2,
        ]);

        $examinee->update([
            'lrn'       => $request->lrn,
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
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
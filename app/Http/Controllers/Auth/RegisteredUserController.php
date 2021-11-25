<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Examinee;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
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

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}

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

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

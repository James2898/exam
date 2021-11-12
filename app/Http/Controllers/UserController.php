<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('role','<',2)->orderBy('id','ASC')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname'      => 'required|string|max:64',
            'mname'      => 'required|string|max:64',
            'lname'      => 'required|string|max:64',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'address'   => 'required|string|max:255',
            'mobile'    => 'required|digits:11|unique:users,mobile,'.$request->id,
        ]);

        User::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'role' => $request->role,
        ]);
        return redirect(route('users'))->with('alert', 'User Created!');;
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'fname'      => 'required|string|max:64',
            'mname'      => 'required|string|max:64',
            'lname'      => 'required|string|max:64',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'address'   => 'required|string|max:255',
            'mobile'    => 'required|digits:11|unique:users,mobile,'.$request->id,
        ]);

        $user = User::find($request->id);

        $user->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'role' => $request->role,
        ]);

        if($request->password) {
            $validated = Hash::make($request->password);
            User::find($request->id)->update(['password' => $validated]);
        }

        return redirect(route('users.edit',$request->id))->with('alert', 'User Updated!');
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect(route('users'))->with('alert', 'User Deleted!');
    }
}
?>
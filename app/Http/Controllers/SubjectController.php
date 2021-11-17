<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Config;
use App\Models\Examinee;
use App\Models\User;
use App\Models\Subject;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = DB::table('subjects')
            ->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create(){
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'      => 'required|string|max:64|unique:subjects,code',
            'name'      => 'required|string|max:64',
            'status'    => 'required|integer',
        ]);

        Subject::create([
            'code'      => $request->code,
            'name'      => $request->name,
            'status'    => $request->status,
        ]);

        return redirect(route('subjects'))->with('alert', 'Subject Created!');;
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'code'      => 'required|string|max:64|unique:subjects,code,'.$request->id,
            'name'      => 'required|string|max:64',
            'status'    => 'required|integer',
        ]);

        $subject = Subject::find($request->id);

        $subject->update([
            'code'      => $request->code,
            'name'      => $request->name,
            'status'    => $request->status,
        ]);

        return redirect(route('subjects.edit',$request->id))->with('alert', 'Subject Updated!');
    }

    public function view($id)
    {
        $subject = Subject::find($id);
        $subject->update([
            'status' => Config::get('constants.subject.status.active.no')
        ]);

        return redirect(route('subjects'))->with('alert', 'Subject Updated!');
    }

    public function activate($id)
    {
        $subject = Subject::find($id);
        $subject->update([
            'status' => Config::get('constants.subject.status.active.no')
        ]);

        return redirect(route('subjects'))->with('alert', 'Subject Updated!');
    }

    public function deactivate($id)
    {
        $subject = Subject::find($id);
        $subject->update([
            'status' => Config::get('constants.subject.status.inactive.no')
        ]);

        return redirect(route('subjects'))->with('alert', 'Subject Updated!');
    }

    public function delete($id)
    {
        Subject::find($id)->delete();

        return redirect(route('subjects'))->with('alert', 'Subject Deleted!');
    }
}

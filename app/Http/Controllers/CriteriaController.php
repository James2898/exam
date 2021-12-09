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

class CriteriaController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('criterias.index');
    }

    public function edit(request $request)
    {
        $college = $request->college+1;
        $course = $request->course+1;
        $subjects = Subject::all();
        return view('criterias.edit',compact('subjects','college','course'));
    }
}
?>
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Criteria;
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
        $course = $request->course;

        $criterias = Criteria::where('college_id',$college)
        ->where('course_id',$course);
        $subjects = Subject::select('criterias.value','subjects.*')
            ->leftjoinSub($criterias,'criterias','criterias.subject_id','=','subjects.id')
            ->get();
        // dd($subjects->first());
        return view('criterias.edit',compact('subjects','college','course'));
    }

    public function update(request $request)
    {
        // dd($request);
        $criteria = Criteria::where('subject_id',$request->subject_id)
            ->where('college_id',$request->college_id)
            ->where('course_id',$request->course_id)
            ->first();
        
        if($criteria) {
            if($request->criteria) {
                $criteria->update([
                    'value' => $request->value
                ]);
            }else {
                $criteria->delete();
            }
        }else{
            Criteria::create([
                'subject_id'    => $request->subject_id,
                'college_id'    => $request->college_id,
                'course_id'     => $request->course_id,
                'value'         => $request->value,
            ]);
        }

        return redirect(route('criterias.edit',['college' => $request->college_id-1, 'course' => $request->course_id]))->with('alert', 'Criteria Updated!');;
    }
}
?>
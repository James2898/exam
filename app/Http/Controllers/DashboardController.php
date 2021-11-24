<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Examinee;
use App\Models\Exam;
use App\Models\User;
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

        // dd(
        //     $total_active_examinees,
        //     $total_passed_examinees,
        //     $total_waiting_examinees
        // );

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
?>
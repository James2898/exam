<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth::user()->role < 2)
    <div id="content" class="grid grid-cols-1 md:grid-cols-3 justify-center">
		<div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2">Total Active Examinees</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_active_examinees }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('examinees')}}">View Examinees</a>
                </div>
		    </div>
        </div>
        

        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total Passed Examinee</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_passed_examinees }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('examinees')}}">View Examinees</a>
                </div>
		    </div>
        </div>

        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total To Review Examinees</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_waiting_examinees }}</h1>
                </div>
			    <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('examinees')}}">View Examinees</a>
                </div>
		    </div>
        </div>

        @if(Auth::user()->role == 0)
        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total Exams</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_exams }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('admin.exams')}}">View Exams</a>
                </div>
        </div>
        </div>

        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total Exams Scheduled</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_scheduled_exams }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('admin.exams')}}">View Exams</a>
                </div>
		    </div>
        </div>

        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total Exam Drafts</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_draft_exams }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('admin.exams')}}">View Exams</a>
                </div>
		    </div>
        </div>
        
        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total Users</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_users }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('users')}}">View Users</a>
                </div>
		    </div>
        </div>
        @endif

        <div id="whoobe-x7bdr" class="justify-evenly p-4">
			<div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2"> Total Active Subjects</h3>
                <div class="text-center bg-white max-h-full py-5">
                    <h1 class="text-5xl">{{ $total_active_subjects }}</h1>
                </div>
                <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                    <a href="{{ route('subjects')}}">View Subjects</a>
                </div>
		    </div>
        </div>
    </div>
    @else
    <div id="whoobe-x7bdr" class="justify-evenly p-4">
        <div id="whoobe-pqyb1" class="w-full justify-center shadow bg-white">
            <h3 class="text-white text-2xl bg-green-600 p-1" id="whoobe-d4an2">Instructions</h3>
            <div class="bg-white px-5 py-5">
                <ol>
                    <li class="py-4">
                        <h1 class="text-2xl">1. Examinee must not be involved in a communication of any during examination</h1>
                    </li>
                    <li class="py-4">
                        <h1 class="text-2xl">2. Examinee must not browse during examnination</h1>
                    </li>
                    <li class="py-4">
                        <h1 class="text-2xl">3. Examinee should not use their phone during examination</h1>
                    </li>
                </ol>
            </div>
            <div class="bg-green-400 text-right text-white w-full px-4 py-2 hover:bg-green-500">
                <a href="{{ route('subjects')}}">Take Exam</a>
            </div>
        </div>
    </div>
    @endif


</x-app-layout>

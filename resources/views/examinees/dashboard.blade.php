<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if($exam != null && $exam->status == 4)
    <div class="overflow-x-auto">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
        @endif
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
        <div class="w-full lg:w-5/6">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
        <div class="mx-2">
            <h1 class="text-5xl font-bold leading-tight">Chosen Course</h1>
            <table class="w-full table-fixed bg-white">
                <thead>
                    <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">College</th>
                        <th class="py-3 px-6 text-left">Course</th>
                        <th class="py-3 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-green-100">
                        <td class="py-3 px-6 text-left">
                            {{Config::get('constants.college.'.$examinee->college)}}
						</td>
                        <td class="py-3 px-6 text-left">
                            {{Config::get('constants.course.'.$examinee->college.'.'.$examinee->course)}}
						</td>
						<td class="py-3 px-6 text-center justify-center">
                            <?php $is_recommended = true  ?>
                            @foreach ($examinee_criteria[$examinee->college][$examinee->course] as $subject_id => $target_score)
                                {{-- IF EXAMINEES GRADE PASSED THE REQUIRED SUBJECT --}}
                                @if(isset($exam_questions[$subject_id]) && $target_score > $exam_questions[$subject_id]['average'])
                                    @php $is_recommended = false @endphp
                                    @break
                                @endif
                            @endforeach

                            @if ($is_recommended)
                                <span class="bg-yellow-200 text-gray-600 py-1 px-3 rounded-full text-xs">
                                Recommended
                                </span>
                            @else
                                <span class="bg-red-200 text-gray-600 py-1 px-3 rounded-full text-xs">
                                Not Recommended
                                </span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @foreach (Config::get('constants.college') as $college)
        <h1 class="text-3xl my-4 mx-2 font-bold leading-tight">
            {{$college}}
        </h1>
        
        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left" colspan="2">Course</th>
                        <th class="py-3 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach (Config::get('constants.course.'.$loop->index+1) as $item)
                    {{-- @if($loop->index+1 == $examinee->course && $loop->parent->index+1 == $examinee->college ) @continue @endif --}}
                    <tr class="border-b border-gray-200 hover:bg-green-100">
                        <td class="py-3 px-6 text-left" colspan="2">
                        {{$item}}
						</td>
						<td class="py-3 px-6 text-center justify-center">
                            @if (isset($examinee_criteria[$loop->parent->index+1])) {{-- COLLEGE HAS CRITERIA --}}
                                <?php $is_recommended = true  ?>
                            @if (isset($examinee_criteria[$loop->parent->index+1][$loop->index+1])) {{-- COURSE HAS CRITERIA --}}
                                @foreach ($examinee_criteria[$loop->parent->index+1][$loop->index+1] as $subject_id => $target_score)
                                    {{-- IF EXAMINEES GRADE PASSED THE REQUIRED SUBJECT --}}
                                    @if(isset($exam_questions[$subject_id]) && $target_score > $exam_questions[$subject_id]['average'])
                                        @php $is_recommended = false @endphp
                                        @break
                                    @endif
                                @endforeach

                                @if ($is_recommended)
                                    <span class="bg-yellow-200 text-gray-600 py-1 px-3 rounded-full text-xs">
                                    Recommended
                                    </span>
                                @else
                                    <span class="bg-red-200 text-gray-600 py-1 px-3 rounded-full text-xs">
                                    Not Recommended
                                    </span>
                                @endif
                                {{-- {{$examinee_questions[$]}} --}}
                            @else
                            <span class="bg-green-200 text-gray-600 py-1 px-3 rounded-full text-xs">
                                Available
                            </span>
                            @endif
                            @else
                            <span class="bg-green-200 text-gray-600 py-1 px-3 rounded-full text-xs">
                                Available
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
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
                <a href="{{ route('exams')}}">Take Exam</a>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

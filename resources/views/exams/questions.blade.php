<x-app-layout>
    <script>
        let setTimer = function (start,end) {
            
        }
        let timer = function (date) {
            let timer = Math.round(new Date(date).getTime()/1000) - Math.round(new Date().getTime()/1000);
		    let minutes, seconds;
		    setInterval(function () {
                if (--timer < 0) {
                    timer = 0;
                }
                hours = parseInt((timer / 60 / 60) % 24, 10);
                minutes = parseInt((timer / 60) % 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                document.getElementById('cd-hours').innerHTML = hours;
                document.getElementById('cd-minutes').innerHTML = minutes;
                document.getElementById('cd-seconds').innerHTML = seconds;
            }, 1000);
        }
    const today = new Date("{{implode('T',explode(' ',$exam_start))}}")
    const tomorrow = new Date("{{implode('T',explode(' ',$exam_end))}}")
    tomorrow.setDate(tomorrow.getDate() + 1)
    timer(tomorrow);
    </script>
    <div class="overflow-x-auto">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    <div id="content" class="grid grid-cols-1 gap-3 p-5 md:grid-cols-4 justify-center">
        <div class="md:col-span-1">
        <div class="mx-auto">
            <div class="w-full justify-center shadow bg-white">
                <h3 class="text-white text-2xl bg-green-600 p-1">
                    {{$subject->name}}<br> <span id="cd-hours">00</span>:<span id="cd-minutes">00</span>:<span id="cd-seconds">00</span>

                </h3>
                <div class="bg-white grid grid-cols-2 md:grid-cols-1 max-h-full p-5">
                    @for ($i = 1; $i <= count($questions_list) ; $i++)
                        <div>
                            <input type="radio" value="{{$i}}" class="clQuestion" name="questions" @if($question_no == $i) checked @endif onchange="location.href='{{route('exams.questions',['id' => Auth::user()->id,'question' => $i])}}'">
                            <label>
                                Question {{$i}}
                            </label>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        </div>
        <div class="md:col-span-3">
            @if ($message = Session::get('alert'))
                <x-alert  />
            @endif
            <div class="mx-auto">
                <h1 class="text-5xl font-bold leading-tight">Question {{$question_no}}</h1>
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-white text-2xl bg-green-600 p-1">{{$questions_list[$question_no]['question']}}</h3>
                    <div class="bg-white grid grid-cols-1 md:grid-cols-2 max-h-full p-5">
                        @if($questions_list[$question_no]['type'] == 1)
                        <div>
                            <form action="{{route('exams.answer',['exam_id' => $exam_id,'subject_id' => $subject->id,'question_id' => $questions_list[$question_no]['question_id'], 'question_no' => $question_no])}}">
                                <input type="hidden" name="exam_id" value="{{$exam_id}}">
                                <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                <input type="hidden" name="question_id" value="{{$questions_list[$question_no]['question_id']}}">
                                <input type="hidden" name="question_no" value="{{$question_no}}">

                                <input value="@if(isset($examinee_form_lists[$questions_list[$question_no]['question_id']])){{$examinee_form_lists[$questions_list[$question_no]['question_id']]}}@endif" type="text" name="answer" class="w-full h-10 pl-3 pr-6 text-base placeholder-green-600 border rounded-lg appearance-none focus:border-green-600">
                                
                                <button href="#" class="inline-flex items-center my-4 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-500 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Save</button>
                            </form>
                        </div>
                        @else
                        <div>
                            @foreach (explode(',',$questions_list[$question_no]['options']) as $item)
                            <div>
                                <input type="radio" value="{{$loop->index+1}}" class="clQuestion" name="answer" 
                                @if(isset($examinee_form_lists[$questions_list[$question_no]['question_id']]))
                                    @if($examinee_form_lists[$questions_list[$question_no]['question_id']] == $loop->index+1)
                                    checked 
                                    @endif 
                                @endif
                                onchange="location.href='{{route('exams.answer',['exam_id' => $exam_id,'subject_id' => $subject->id,'question_id' => $questions_list[$question_no]['question_id'], 'question_no' => $question_no, 'answer' => $loop->index+1])}}'">
                                <label for="">{{$item}}</label>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
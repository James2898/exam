<x-app-layout>
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
        <div class="mx-auto">
            <h1 class="text-3xl font-bold leading-tight">{{Config::Get('constants.college.'.$college)}}</h1>
            <h2 class="text-2xl font-bold leading-tight">{{Config::Get('constants.course.'.$college.'.'.$course)}}</h2>
        </div>
        <div class="mt-2">
            <a href="{{ route('criterias') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                Return
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Subject Name</th>
                        <th class="py-3 px-6 text-left">Criteria</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($subjects as $subject)
                    <tr class="border-b border-gray-200 hover:bg-green-100">
                        <td class="py-3 px-6 text-left">
                            {{$subject->name}}
						</td>
						<td class="py-3 px-6 text-left justify-left">
                            <form action="{{route('criterias.update')}}" method="POST">
							@csrf
                            <input type="hidden" name="college_id" value="{{$college}}">
                            <input type="hidden" name="course_id" value="{{$course}}">
                            <input type="hidden" name="subject_id" value="{{$subject->id}}">

                            <input type="radio" value="0" class="clCriteria" id="criteria.{{$subject->id}}" name="criteria" @if(!$subject->value) checked @endif>
                            <label for="" class="mr-5">None</label>
                            
                            <input type="radio" value="{{$subject->id}}" class="clCriteria" id="criteria.{{$subject->id}}" name="criteria" @if($subject->value) checked @endif>
                            <label for="" class="mr-5">Criteria %</label>
                            
                            <span id="clCriteriaSubject_{{$subject->id}}" @if(!$subject->value)hidden @endif>
                            <input value="{{$subject->value ? $subject->value : 90}}" type="number" name="value" min="75" max="100" id="id" class="w-1/6 h-5">
                            </span>
                            <button href="#" class="inline-flex items-center px-4 bg-green-500 border border-transparent rounded text-xs text-white">Save</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
    <script defer>
        $('.clCriteria').on("change", function(){
            $('#clCriteriaSubject_'+this.id.split('.')[1]).attr('hidden',false)
            if(this.value == 0){
                console.log('hide')
                $('#clCriteriaSubject_'+this.id.split('.')[1]).attr('hidden',true)
                // delete criteria
            }else {
                console.log('show')
                $('#clCriteriaSubject_'+this.id).attr('hidden',false)
            }
        })
    </script>
</x-app-layout>
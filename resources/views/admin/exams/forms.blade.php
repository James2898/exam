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
        <h1 class="text-5xl font-bold leading-tight">Questionaire</h1>
        <a href="{{ route('admin.exams') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Return
        </a>
      </div>
      
      @foreach ($subjects as $subject)
        <h1 class="my-4 mx-2 font-bold leading-tight">
            <span class="text-3xl">{{$subject->name}}</span>
        </h1>
      
      <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">Assign</th>
					<th class="py-3 px-6 text-center">Type</th>
                    <th class="py-3 px-6 text-center">Question</th>
					<th class="py-3 px-4 text-left">Options</th>
                    <th class="py-3 px-6 text-center">Answer</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @if(array_key_exists($subject->id,$questions))
					@foreach ($questions[$subject->id] as $item)
					<tr class="border-b border-gray-200 hover:bg-green-100">
						<td class="py-3 px-6 text-left whitespace-nowrap">
							<div class="flex items-center justify-center">
								<input value="{{ $subject->id }}" type="checkbox" name="exam_subjects" id="idUserName" class="placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline checked:bg-green-600 checked:border-transparent" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" 
								@if (isset($exam_questions[$subject->id]))
									@if(isset($exam_questions[$subject->id][$item['question_id']])) 
										checked 
									@endif 
								@endif
								onchange="location.href='{{route('admin.exams.toggleAssign',['subject_id' => $subject->id,'exam_id' => $exam->id,'question_id' => $item['question_id']])}}'">
							</div>
						</td>
						<td class="py-3 px-6 text-center">
							<div class="flex items-center justify-center">
								@if($item['type'] == 1)
									<span class="font-medium">Identification</span>
								@else
								<span class="font-medium">Multiple Choice</span>
								@endif
							</div>
						</td>
						<td class="py-3 px-6 text-center">
							<div class="flex items-center justify-center">
								<span class="font-medium">{{$item['question']}}</span>
							</div>
						</td>
						<td class="py-3 px-6">
							
							@if($item['type'] == 2)
							<span class="text-left">
								<ol>
									<li>1. {{$item['options'][0]}}</li>
									<li>2. {{$item['options'][1]}}</li>
									<li>3. {{$item['options'][2]}}</li>
									<li>4. {{$item['options'][3]}}</li>
								</ol>
								@else
									None
							@endif
						</td>
						<td class="py-3 px-6 text-center">
							<div class="flex items-center justify-center">
								@if ($item['type'] == 1)
									{{$item['answer']}}
								@else
								@switch($item['answer'])
									@case(1)
										1. {{$item['options'][0]}}
										@break
									@case(2)
										2. {{$item['options'][1]}}
										@break
									@case(3)
										3. {{$item['options'][2]}}
										@break
									@case(4)
										4. {{$item['options'][3]}}
										@break
									@default
										No Answer
								@endswitch
							</div>
								@endif
						</td>
					</tr>
					@endforeach
				@endif
            </tbody>
        </table>
    </div>
    @endforeach
    </div>
    </div>
    </div>
</x-app-layout>
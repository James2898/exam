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
        <h1 class="text-5xl font-bold leading-tight">{{$exam->description}}Results</h1>
        <a href="{{ route('admin.exams') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Return
        </a>
      </div>
        
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="w-full table-auto">
			<thead>
				<tr class="bg-green-500 text-white uppercase text-sm leading-normal">
					<th class="py-3 px-6 text-center">Assign</th>
					<th class="py-3 px-6 text-center">Examinee #</th>
					<th class="py-3 px-6 text-center">Name</th>
					<th class="py-3 px-6 text-center">College</th>
					<th class="py-3 px-6 text-center">Course</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
               @foreach ($examinees as $examinee)
                  <tr class="border-b border-gray-200 hover:bg-green-100">
					<td class="py-3 px-6 text-center">
						<input value="{{ $examinee->id }}" type="checkbox" name="exam_subjects" id="idUserName" class="placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" 
						@if($examinee->exam_id == $exam->id) checked @endif
						onchange="location.href='{{route('admin.exams.toggleExaminee',['exam_id' => $exam->id,'examinee_id' => $examinee->id])}}'">
					</td>
                    <td class="py-3 px-6 text-center">
                      {{$examinee->id}}
                    </td>
                    <td class="py-3 px-6 text-center">
                      {{$examinee->lname.", ".$examinee->fname." ".substr($examinee->mname,0,1)."."}}
                    </td>
					<td class="py-3 px-6 text-center">
						<div class="flex items-center justify-center">
							<span>{{Config::get('constants.college.'.$examinee->college);}}</span>
						</div>
					</td>
					<td class="py-3 px-6 text-center">
					<div class="flex items-center justify-center">
						<span>{{Config::get('constants.course.'.$examinee->college.'.'.$examinee->course);}}</span>
					</div>
					</td>
                  </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
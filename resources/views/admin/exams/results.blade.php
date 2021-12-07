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
                        <th class="py-3 px-6 text-center">Examinee #</th>
                        <th class="py-3 px-6 text-center">Name</th>
                        @foreach ($subjects as $subject)
                        <th class="py-3 px-6 text-center">{{$subject->name}}</th>
                        @endforeach
                        <th class="py-3 px-6 text-center">Average</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
               @foreach ($examinees as $examinee)
                  <tr class="border-b border-gray-200 hover:bg-green-100">
                    <td class="py-3 px-6 text-center">
                      {{$examinee->id}}
                    </td>
                    <td class="py-3 px-6 text-center">
                      {{$examinee->lname.", ".$examinee->fname." ".substr($examinee->mname,0,1)."."}}
                    </td>
                    @php
                        $average = array();
                    @endphp
                    @foreach ($subjects as $subject)
                        <td class="py-3 px-6 text-center">
                          {{-- {{$subject_scores[$subject->id][$examinee->id]/$subject->questions}} --}}
                          {{number_format((float)(($subject_scores[$subject->id][$examinee->id] / $subject->questions) *100),2,'.','')}}
                          @php
                              array_push($average,($subject_scores[$subject->id][$examinee->id] / $subject->questions) *100)
                          @endphp
                        </td> 
                    @endforeach
                    <td class="py-3 px-6 text-center">
                          {{-- {{array_sum($average)/count($average)}} --}}
                          {{number_format((float)(array_sum($average)/count($average)),2,'.','')}}%
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
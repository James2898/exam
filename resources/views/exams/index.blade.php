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
        <h1 class="text-5xl font-bold leading-tight">Exam</h1>
      </div>
      <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">Description</th>
                    <th class="py-3 px-6 text-center">Start Time</th>
                    <th class="py-3 px-6 text-center">End Time</th>
                    <th class="py-3 px-6 text-center">Time Per Exam</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            @if ($exam)
            <tbody class="text-gray-600 text-sm font-light">
              <tr class="border-b border-gray-200 hover:bg-green-100">
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      {{$exam->description}}
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      {{$exam->start_datetime}}
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      {{$exam->end_datetime}}
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      {{$exam->duration}} minutes
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
                      @if ($now_datetime->greaterThanOrEqualTo($exam_startdatetime) && $exam_enddatetime->greaterThan($now_datetime))
                      <a href="{{ route('exams.questions',['id' => Auth::user()->id]) }}" class="btn mx-auto lg:mx-0 hover:underline bg-green-500 text-white font-bold rounded py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"">
                        Take Exam
                      </a>
                      @elseif ($now_datetime->greaterThan($exam_enddatetime))
                        Exam already ended please wait for the email of results
                      @else
                        wait
                        Exam not available at this time
                      @endif
                    </div>
                  </td>
                </tr>
                @else
                  <tr>
                    <td colspan="5" class="text-center text-2xl">
                      No available exam at the moment
                    </td>
                  </tr>
                @endif
            </tbody>
            
        </table>
      </div>
    </div>
    </div>
    </div>
</x-app-layout>
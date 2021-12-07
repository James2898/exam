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
        <h1 class="text-5xl font-bold leading-tight">Exams</h1>
        <a href="{{ route('admin.exams.create') }}" class="btn mx-auto lg:mx-0 hover:underline bg-green-500 text-white font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Add
        </a>
      </div>
      <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">Exam ID</th>
                    <th class="py-3 px-6 text-center">Description</th>
                    <th class="py-3 px-6 text-center">Schedule</th>
                    <th class="py-3 px-6 text-center">Time Per Exam</th>
                    <th class="py-3 px-6 text-center">No. of Items</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
              @foreach ($exams as $exam)
              <tr class="border-b border-gray-200 hover:bg-green-100">
                  <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center justify-center">
                        <span class="font-medium">{{$exam->exam_id}}</span>
                    </div>
                  </td>
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
                      {{$exam->duration}} minutes
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      {{$exam->qty}}
                    </div>
                  </td>
                  <td class="py-auto px-auto text-center">
                    <div class="flex items-center justify-center">
                      @switch ($exam->status)
                        @case(1)
                        @case(2)
                        @case(3)
                        <a href="{{ route('admin.exams.publish',$exam->id) }}" class="btn mx-auto lg:mx hover:underline bg-green-500 text-white font-bold rounded-full py-1 px-4 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out" onclick="return confirm('Are you sure to publish this exam?')">Publish Results</a>
                          @break
                        @case(4)
                          <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                              Published
                          </span>
                          @break
                        @default
                          @break
                      @endswitch
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-end justify-end">
                      @if($exam->has_exam)
                      <a href="{{route('exam.results', $exam->id)}}">
                        <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        </div>
                      </a>
                      @endif
                      <a href="{{route('admin.exams.forms', $exam->id)}}">
                        <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
                          </svg>
                        </div>
                      </a>
                      <a href="{{route('admin.exams.edit', $exam->id)}}">
                        <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        </div>
                      </a>
                      <a href="{{ route('admin.exams.delete', $exam->id) }}" onclick="return confirm('Are you sure?')">
                        <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                      </a>
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
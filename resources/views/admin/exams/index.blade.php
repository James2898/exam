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
        <table class="min-w-max w-full table-fixed">
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
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      @switch ($exam->status)
                        @case(1)
                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(2)
                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(3)
                        <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(4)
                        <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(5)
                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                          @break
                      @endswitch
                          {{Config::get('constants.exam.status.'.$exam->status)}}
                        </span>
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
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
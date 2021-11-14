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
        <h1 class="text-5xl font-bold leading-tight">Examinees</h1>
        <a href="{{ route('examinees.create') }}" class="btn mx-auto lg:mx-0 hover:underline bg-green-500 text-white font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Add
        </a>
      </div>
      <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-fixed">
            <thead>
                <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center" >Examinee #</th>
                    <th class="py-3 px-6 text-center" >LRN #</th>
                    <th class="py-3 px-6 text-center">Name</th>
                    <th class="py-3 px-6 text-center">College</th>
                    <th class="py-3 px-6 text-center">Course</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
              @foreach ($examinees as $examinee)
              <tr class="border-b border-gray-200 hover:bg-green-100">
                  <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center justify-center">
                        <span class="font-medium">{{$examinee->id}}</span>
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                        <span>{{$examinee->lrn}}</span>
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                        <span>{{$examinee->lname.", ".$examinee->fname." ".substr($examinee->mname,0,1)."."}}</span>
                    </div>
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
                  <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center">
                      @switch ($examinee->status)
                        @case(0)
                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(1)
                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(2)
                        <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(3)
                        <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                          @break
                        @case(4)
                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                          @break
                      @endswitch
                          {{Config::get('constants.examinee.status.'.$examinee->status)}}
                        </span>
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
                      <a href="{{route('examinees.edit', $examinee->id)}}">
                        <div class="w-4 mr-2 transform hover:text-green-500 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                      </a>
                      <a href="{{ route('examinees.delete', $examinee->id) }}" onclick="return confirm('Are you sure?')">
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
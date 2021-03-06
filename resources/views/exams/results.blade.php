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
        <h1 class="text-5xl font-bold leading-tight">{{$exam->description}}</h1>
        @if(isset($examinee))<h4 class="font-bold">{{ $examinee->lname.", ".$examinee->fname." ".substr($examinee->mname,0,1).".";}}</h4>@endif
      </div>
      @if(Auth::user()->role < 2)
      <a href="{{ route('examinees') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Return
      </a>
      @endif
      <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
          <table class="w-full table-auto">
              <thead>
                  <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                      <th class="py-3 px-6 text-center">Subject</th>
                      <th class="py-3 px-6 text-center">Score</th>
                      <th class="py-3 px-6 text-center">Percentage</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @foreach ($subjects as $subject)
                  <tr class="border-b border-gray-200 hover:bg-green-100">
                    <td class="py-3 px-6 text-center">
                      <div class="flex items-center justify-center">
                        {{$subject->name}}
                      </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                      <div class="flex items-center justify-center">
                        <span class="font-medium">
                          {{$exam_questions[$subject->id]['score']}}/{{$exam_questions[$subject->id]['questions']}}
                        </span>
                      </div>
                    </td>
                    <td class="py-3 px-6">
                      <div class="flex items-center justify-center">
                        <span class="font-medium">
                          {{number_format((float)(($exam_questions[$subject->id]['score'] / $exam_questions[$subject->id]['questions']) *100),2,'.','')}}%
                        </span>
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
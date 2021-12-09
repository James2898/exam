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
            <a href="{{ route('subjects') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                Return
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Subject  Code</th>
                        <th class="py-3 px-6 text-left">Subject Name</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($subjects as $subject)
                    <tr class="border-b border-gray-200 hover:bg-green-100">
                        <td class="py-3 px-6 text-left">
                            {{$subject->code}}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{$subject->name}}
						</td>
						<td class="py-3 px-6 text-center justify-center">
							<input type="radio" value="{{$i}}" class="clQuestion" name="questions" onchange="location.href='{{route('exams.questions',['id' => Auth::user()->id,'question' => $i])}}'">
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
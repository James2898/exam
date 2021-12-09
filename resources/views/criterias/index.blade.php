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
            <h1 class="text-5xl font-bold leading-tight">Criterias</h1>
        </div>
        @foreach (Config::get('constants.college') as $college)
        <h1 class="my-4 mx-2 font-bold leading-tight">
            <span class="text-3xl">{{$college}}</span>
        </h1>
        
        <div class="overflow-x-auto bg-white shadow-md rounded my-6">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-green-500 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Course</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach (Config::get('constants.course.'.$loop->index+1) as $item)
                    <tr class="border-b border-gray-200 hover:bg-green-100">
                        <td class="py-3 px-6 text-left">
                            {{$item}}
						</td>
						<td class="py-3 px-6 text-center justify-center">
							<a href="{{ route('criterias.edit',['college' => $loop->parent->index,'course' => $loop->index+1]) }}" class="btn mx-auto hover:underline text-xs bg-green-500 text-white font-bold rounded-full py-1 px-4 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out" >View Criterias</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
    </div>
    </div>
</x-app-layout>
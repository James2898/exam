<x-app-layout>
<script>
    function getSubjects () {
        var subjects = document.querySelectorAll('input[name=exam_subjects]:checked');
        
        var exam_subjects = '';
        subjects.forEach(element => {
            exam_subjects += exam_subjects ? ', '+element.value : element.value;
        });
        document.getElementById('idSubjects').value = exam_subjects

        console.log(exam_subjects)

    }
</script>
<div class="overflow-x-auto">
<div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
<div class="w-full lg:w-5/6">
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <h1 class="text-5xl font-bold leading-tight">Create Exam</h1>
    <a href="{{ route('admin.exams') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Return
    </a>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
    <div class="grid mt-8 gap-8 grid-cols-1">
    <div class="flex flex-col ">
    <div class="bg-white shadow-md rounded-3xl p-5">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('admin.exams.store') }}">
            @csrf

            <input type="text" value="" name="subjects" id="idSubjects" hidden>

            <div>
                <x-label for="description" :value="__('Description')" />

                <input value="" type="text" name="description" id="idDescription" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="name" :value="__('Schedule Date')" />

                <input value="{{ Carbon\Carbon::now()->format('Y-m-d')}}" type="date" name="schedule_date" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
            </div>

            <div class="mt-4">
                <x-label for="schedule_time" :value="__('Schedule Time')" />

                <input value="08:00" type="time" name="schedule_time" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
            </div>

            <div class="mt-4">
                <x-label for="duration" :value="__('Duration Per Subject')" />

                <select name="duration" class="subjects w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                    @foreach (Config::get('constants.exam.duration') as $item)
                        <option value="{{$item}}">{{$item}} minutes</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="mt-4">
                <x-label for="qty" :value="__('No. of Items')" />

                <input value="" type="number" name="qty" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  placeholder="10" required>
            </div>

            <div class="mt-4">
                <x-label for="status" :value="__('Subject')" />
                @foreach ($subjects as $subject)
                    <label for="">
                        <input value="{{ $subject->id }}" type="checkbox" name="exam_subjects" id="idUserName" class="placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" onchange="getSubjects()">
                        <span>{{ $subject->name }}</span>
                    </label>
                @endforeach
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Add') }}
                </x-button>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
</div>
</div>
</div>
</x-app-layout>
<x-app-layout>
<script>
    var courses = {
    @for ($i = 1; $i <= count(Config::get('constants.course')) ; $i++)
    '{{ $i }}' : {
        @foreach (Config::get('constants.course.'.$i) as $item)
            {{$loop->index}} : '{{ $item }}',
        @endforeach
        },
    @endfor
    }

    function updateCourse (id) {
        const htmlCourse = document.getElementById("idCourse");
        let college_course = courses[id]
        var str = "<option selected disabled>Select Course</option>"
        for (var index in college_course) {
            str += '<option value="'+(parseInt(index)+1)+'">' + college_course[index] + '</option>'
        }
        htmlCourse.innerHTML = str;
    }
</script>

<div class="overflow-x-auto">
<div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
<div class="w-full lg:w-5/6">
    <h1 class="text-5xl font-bold leading-tight">Create Examinee</h1>
    <a href="{{ route('users') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Return
    </a>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
    <div class="grid mt-8 gap-8 grid-cols-1">
    <div class="flex flex-col ">
    <div class="bg-white shadow-md rounded-3xl p-5">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('examinees.store') }}">
            @csrf

            <div>
                <x-label for="lrn" :value="__('LRN')" />

                <input value="" type="text" name="lrn" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="fname" :value="__('First Name')" />

                <input value="" type="text" name="fname" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="mname" :value="__('Middle Name')" />

                <input value="" type="text" name="mname" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="lname" :value="__('Last Name')" />

                <input value="" type="text" name="lname" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="birthdate" :value="__('Birth Date')" />

                <input value="" type="date" name="birthdate" id="idBirthdate" min='1900-01-01' max='2005-01-01' class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="Gender" :value="__('Gender')" />

                <select name="gender" id="idGender" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                    <option value="" disabled selected>
                        Select Gender
                    </option>
                @for ($i = 0; $i < count(Config::get('constants.examinee.gender')) ; $i++)
                    <option value='{{$i}}'>
                        {{Config::get('constants.examinee.gender.'.$i)}}
                    </option>
                @endfor
                </select>
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <input value="" type="email" name="email" id="idUserEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <input value="" type="text" name="password" id="idUserPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />

                <input value="" type="text" name="address" id="idUserAddress" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile #')" />

                <input value="" type="text" name="mobile" id="idUserMobile" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="college" :value="__('College')" />

                <select name="college" id="idCollege" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 
                border rounded-lg appearance-none focus:shadow-outline" onchange="updateCourse(this.value)">
                    <option value="" disabled selected>
                        Select College
                    </option>
                @for ($i = 1; $i <= count(Config::get('constants.college')) ; $i++)
                    <option value='{{$i}}'>
                        {{Config::get('constants.college.'.$i)}}
                    </option>
                @endfor
                </select>
            </div>

            <div class="mt-4">
                <x-label for="mobile" :value="__('Course')" />

                <select name="course" id="idCourse" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 
                border rounded-lg appearance-none focus:shadow-outline">
                    <option value="" disabled selected>
                        Select Course
                    </option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Add Examinee') }}
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
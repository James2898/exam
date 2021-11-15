<x-guest-layout>
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
<x-auth-card>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-label for="lrn" :value="__('LRN')" />

            <x-input id="lrn" class="block mt-1 w-full" type="text" name="lrn" :value="old('lrn')" required autofocus />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-label for="fname" :value="__('First Name')" />

            <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required />
        </div>

        <div class="mt-4">
            <x-label for="mname" :value="__('Middle Name')" />

            <x-input id="mname" class="block mt-1 w-full" type="text" name="mname" :value="old('mname')" required />
        </div>

        <div class="mt-4">
            <x-label for="lname" :value="__('Last Name')" />

            <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required />
        </div>
        
        <div class="mt-4">
            <x-label for="birthdate" :value="__('Birth Date')" />

            <x-input value="" type="date" name="birthdate" id="idBirthdate" min='1900-01-01' max='2005-01-01' class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required/>
        </div>

        <div class="mt-4">
            <x-label for="Gender" :value="__('Gender')" />

            <select name="gender" id="idGender" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
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

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <div class="mt-4">
            <x-label for="address" :value="__('Address')" />

            <input value="" type="text" name="address" id="idUserAddress" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"  required>
        </div>

        <div class="mt-4">
            <x-label for="mobile" :value="__('Mobile #')" />

            <input value="" type="text" name="mobile" id="idUserMobile" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"  required>
        </div>

        <div class="mt-4">
            <x-label for="college" :value="__('College')" />

            <select name="college" id="idCollege" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 
            border rounded-lg appearance-none focus:shadow-outline border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" onchange="updateCourse(this.value)">
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
            border rounded-lg appearance-none focus:shadow-outline border-green-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                <option value="" disabled selected>
                    Select Course
                </option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Already have an account</a>
            <x-button class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</x-auth-card>
</x-guest-layout>

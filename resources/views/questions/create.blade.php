<x-app-layout>
<script>
    hideMultiple();
</script>
<div class="overflow-x-auto">
<div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
<div class="w-full lg:w-5/6">
    <h1 class="text-5xl font-bold leading-tight">Create Question</h1>
    <a href="{{ route('questions.identification', $subject->id) }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Return
    </a>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
    <div class="grid mt-8 gap-8 grid-cols-1">
    <div class="flex flex-col ">
    <div class="bg-white shadow-md rounded-3xl p-5">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('questions.store') }}">
            @csrf

            <input value="{{ $subject->id }}" type="text" name="subject_id" hidden>

            <div>
                <x-label for="subject" :value="__('Subject')" />

                <input value="{{$subject->name}}" type="text" name="lrn" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" disabled>
            </div>

            <div class="mt-4">
                <x-label for="type" :value="__('Type')" />

                <select name="type" id="idType" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" onchange="changeType(this.value)">
                    <option value='1'>Identification</option>
                    <option value='2'>Multiple</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="question" :value="__('Question')" />

                <input value="" type="text" name="question" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4 multiple" hidden>
                <x-label for="option_1" :value="__('Option 1')" />

                <input value="" type="text" name="option_1" id="idOption1" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
            </div>

            <div class="mt-4 multiple" hidden>
                <x-label for="option_2" :value="__('Option 2')" />

                <input value="" type="text" name="option_2" id="idOption2" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
            </div>

            <div class="mt-4 multiple" hidden>
                <x-label for="option_3" :value="__('Option 3')" />

                <input value="" type="text" name="option_3" id="idOption3" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
            </div>

            <div class="mt-4 multiple" hidden>
                <x-label for="option_4" :value="__('Option 4')" />

                <input value="" type="text" name="option_4" id="idOption4" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
            </div>

            <div class="mt-4 identification">
                <x-label for="answer" :value="__('Answer')" />

                <input value="" type="text" name="answer_identification" id="idUserName" class="identification w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
            </div>

            <div class="mt-4 multiple" hidden>
                <x-label for="answer" :value="__('Answer')" />

                <select name="answer_multiple" id="idType" class="multiple w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" onchange="changeType(this.value)">
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
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

<script>
    function hideMultiple() {
        var multiple = document.getElementsByClassName("multiple");
        var identification = document.getElementsByClassName("identification");
        for(var i = 0; i < multiple.length; i++) {
            console.log('hit')
            multiple[i].style.display = "none";
        }

        for(var i = 0; i < identification.length; i++) {
            console.log('hit')
            identification[i].style.display = "inline";
        }
    }

    function showMultiple() {
        var multiple = document.getElementsByClassName("multiple");
        var identification = document.getElementsByClassName("identification");
        for(var i = 0; i < multiple.length; i++) {
            multiple[i].style.display = "inline";
        }

        for(var i = 0; i < identification.length; i++) {
            identification[i].style.display = "none";
        }

    }

    function changeType(type) {
        console.log(type)
        if (type == '1') {
            console.log('Identification')
            hideMultiple();
        }else if (type == '2') {
            console.log('Multiple')
            showMultiple();
        }
    }

</script>

</x-app-layout>
<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-">
    <div class="w-full lg:w-5/6">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
        <h1 class="text-5xl font-bold leading-tight">Edit Question</h1>
        <a href="{{ route('questions.identification', $subject->id) }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Return
        </a>
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <div class="grid mt-8 gap-8 grid-cols-1">
        <div class="flex flex-col ">
        <div class="bg-white shadow-md rounded-3xl p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('questions.update') }}">
                @csrf
                @method('PUT')

                <input type="text" value="{{$question->id}}" name="id" hidden>

                <div>
                    <x-label for="subject" :value="__('Subject')" />
    
                    <input value="{{$subject->name}}" type="text" name="lrn" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" disabled>
                </div>
    
                <div class="mt-4">
                    <x-label for="question" :value="__('Question')" />
    
                    <input value="{{ $question->description }}" type="text" name="question" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>
                
                @if($question->type == 1)
                <div class="mt-4 identification">
                    <x-label for="answer" :value="__('Answer')" />
    
                    <input value="{{ $question->answer }}" type="text" name="answer_identification" id="idUserName" class="identification w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>
                @else
                <div class="mt-4 multiple" >
                    <x-label for="option_1" :value="__('Option 1')" />
    
                    <input value="{{ $question->option_1 }}" type="text" name="option_1" id="idOption1" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
                </div>
    
                <div class="mt-4 multiple" >
                    <x-label for="option_2" :value="__('Option 2')" />
    
                    <input value="{{ $question->option_2 }}" type="text" name="option_2" id="idOption2" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
                </div>
    
                <div class="mt-4 multiple" >
                    <x-label for="option_3" :value="__('Option 3')" />
    
                    <input value="{{ $question->option_3 }}" type="text" name="option_3" id="idOption3" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
                </div>
    
                <div class="mt-4 multiple" >
                    <x-label for="option_4" :value="__('Option 4')" />
    
                    <input value="{{ $question->option_4 }}" type="text" name="option_4" id="idOption4" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline multiple">
                </div>
                
                <div class="mt-4 multiple" >
                    <x-label for="answer" :value="__('Answer')" />
    
                    <select name="answer_multiple" id="idType" class="multiple w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" onchange="changeType(this.value)">
                        <option value="1" @if ($question->answer == 1) selected @endif>Option 1</option>
                        <option value="2" @if ($question->answer == 2) selected @endif>Option 2</option>
                        <option value="3" @if ($question->answer == 3) selected @endif>Option 3</option>
                        <option value="4" @if ($question->answer == 4) selected @endif>Option 4</option>
                    </select>
                </div>
                @endif
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Update') }}
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
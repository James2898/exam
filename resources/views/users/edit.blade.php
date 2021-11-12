<x-app-layout>
<div class="overflow-x-auto">
<div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
<div class="w-full lg:w-5/6">
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <h1 class="text-5xl font-bold leading-tight">Edit User</h1>
    <a href="{{ route('users') }}" class="btn mx-auto lg:mx-0 hover:underline bg-gray-500 text-white font-bold rounded-full py-1 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Return
    </a>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
    <div class="grid mt-8 gap-8 grid-cols-1">
    <div class="flex flex-col ">
    <div class="bg-white shadow-md rounded-3xl p-5">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('users.update') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}" />

            <div>
                <x-label for="fname" :value="__('First Name')" />

                <input value="{{ $user->fname  }}" type="text" name="fname" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="mname" :value="__('Middle Name')" />

                <input value="{{ $user->mname  }}" type="text" name="mname" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="lname" :value="__('Last Name')" />

                <input value="{{ $user->lname  }}" type="text" name="lname" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <input value="{{ $user->email }}" type="email" name="email" id="idUserEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <input value="" type="text" name="password" id="idUserPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Password will not be changed if empty">
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />

                <input value="{{ $user->address }}" type="text" name="address" id="idUserAddress" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="mobile" :value="__('Mobile #')" />

                <input value="{{ $user->mobile }}" type="text" name="mobile" id="idUserMobile" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="role" :value="__('Role')" />

                <select name="role" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                    <option value="0" @if ($user->role == 0) selected @endif>Admin</option>
                    <option value="1" @if ($user->role == 1) selected @endif>Staff</option>
                </select>
            </div>

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

@extends('auth.layouts.app')

@section('title', 'Help Center')

@section('app')

    <div class="mt-8 px-12.5">

        <p class="flex justify-center gap-x-[1rem] text-2xl text-blue-600"><i class="fa-solid fa-key"></i>Help Center</p>

        <div class="flex flex-wrap flex-row w-full justify-between gap-y-11 mt-10">
    
            <label for="change-password" class="flex gap-x-[1rem] border-2 border-solid border-gray-300 rounded-md px-4 py-4 w-full lg:w-[48%] h-auto cursor-pointer transition-all duration[.12s] ease-in-out hover:gap-x-[1.5rem] hover:border-blue-700">
                I want to change me password
                <i class="fa-solid fa-arrow-right"></i>
            </label>
    
            <label for="forget-password" class="flex gap-x-[1rem] border-2 border-solid border-gray-300 rounded-md px-4 py-4 w-full lg:w-[48%] h-auto cursor-pointer transition-all duration[.12s] ease-in-out hover:gap-x-[1.5rem] hover:border-blue-700">
                I forget my password
                <i class="fa-solid fa-arrow-right"></i>
            </label>
    
            <label for="delete-account" class="flex gap-x-[1rem] border-2 border-solid border-gray-300 rounded-md px-4 py-4 w-full lg:w-[48%] h-auto cursor-pointer transition-all duration[.12s] ease-in-out hover:gap-x-[1.5rem] hover:border-blue-700">
                I want delete my account
                <i class="fa-solid fa-arrow-right"></i>
            </label>
    
            <label for="hack-account" class="flex gap-x-[1rem] border-2 border-solid border-gray-300 rounded-md px-4 py-4 w-full lg:w-[48%] h-auto cursor-pointer transition-all duration[.12s] ease-in-out hover:gap-x-[1.5rem] hover:border-blue-700">
                My account got hacked
                <i class="fa-solid fa-arrow-right"></i>
            </label>
    
        </div>

        <div class="w-full mt-12">

            <input class="hidden peer/change-password" type="radio" name="help" id="change-password" checked>
            <div class="hidden border !border-gray-200 rounded-md peer-checked/change-password:block">
                <div class="px-[1.5rem] py-3 bg-gray-200 font-bold text-xl">
                    I want to change me password
                </div>
                <div class="px-[1.5rem] py-3 bg-gray-50">
                    <ol class="bg-white list-decimal list-inside">
                        <li>Fisrt, you sign in your account.</li>
                        <li>Goto "profile" page.</li>
                        <li>And them you click the "Change Password" Button.</li>
                    </ol>
                </div>
            </div>

            <input class="hidden peer/forget-password" type="radio" name="help" id="forget-password">
            <div class="hidden border !border-gray-200 rounded-md peer-checked/forget-password:block">
                <div class="px-[1.5rem] py-3 bg-gray-200 font-bold text-xl">
                    I forget my password
                </div>
                <div class="px-[1.5rem] py-3 bg-gray-50">
                    <ol class="bg-white list-decimal list-inside">
                        <li>Fisrt, you click below button.</li>
                        <li>And enter your email address.</li>
                        <li>After you will receive a reset password email in your mailbox.</li>
                    </ol>

                    <x-form.post :action="route('auth.password.reset')">
                        <input class="border border-gray-500 -mr-[4px] rounded-l-sm w-full lg:w-[20rem] mt-4 lg:mt-0" type="text" name="email" placeholder="Email" required>
                        <button class="mt-4 px-[1rem] py-2 text-white bg-purple-600 rounded-r-sm transition-all duration-[.12s] ease-in-out hover:bg-purple-700">Reset Password</button>
                    </x-form.post>
                </div>
            </div>

            <input class="hidden peer/delete-account" type="radio" name="help" id="delete-account">
            <div class="hidden peer-checked/delete-account:block">
                <div class="px-[1.5rem] py-3 bg-gray-200 font-bold text-xl">
                    I want delete my account
                </div>
                <div class="px-[1.5rem] py-3 bg-gray-50">
                    <ol class="bg-white list-decimal list-inside">
                        <li>Fisrt, you sign in your account.</li>
                        <li>And goto "Profile" page.</li>
                        <li>Click the gear icon and select "Delete Account".</li>
                    </ol>
                </div>
            </div>

            <input class="hidden peer/hack-account" type="radio" name="help" id="hack-account">
            <div class="hidden peer-checked/hack-account:block">
                <div class="px-[1.5rem] py-3 bg-gray-200 font-bold text-xl">
                    My account got hacked
                </div>
                <div class="px-[1.5rem] py-3 bg-gray-50">
                    <ol class="bg-white list-decimal list-inside">
                        <li>Use reset password to get back your account.</li>
                    </ol>
                </div>
            </div>

        </div>
    </div>

    <a href="{{ route('frontend.home') }}">
        <button class="flex justify-center gap-x-[.725rem] mt-4 ml-12.5 px-[1rem] py-2 text-white bg-blue-500 rounded-sm transition-all duration-[.12s] ease-in-out hover:bg-blue-600">
            <i class="fa-solid fa-home"></i>Home
        </button>
    </a>

@endsection
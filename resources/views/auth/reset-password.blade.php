
@extends('auth.layouts.app')

@section('title', 'Reset Password')

@section('app')

    <div class="px-4 py-8">
        <p class="text-2xl w-full text-center">Reset Password</p>
    
        <x-form.patch class="px-3 py-4" :action="route('auth.password.renew')">
    
            <input name="email" id="email" value="{{ $email }}" hidden required>

            <div class="mb-3">
                <label class="required" for="password">Password</label>
                <input class="border border-gray-300" type="password" placeholder="Password" name="password" id="password" required>
            </div>
    
            <div class="mb-3">
                <label class="required" for="confirmed-password">Confirmed Password</label>
                <input class="border border-gray-300" type="password" placeholder="Confirmed Password" name="confirmed_password" id="confirmed-password" required>
            </div>
    
            <button class="flex justify-center gap-x-[1rem] mt-4 px-[1rem] py-2 text-white bg-purple-600 rounded-sm transition-all duration-[.12s] ease-in-out hover:bg-purple-700">
                <i class="fa-solid fa-key"></i>Reset Password
            </button>
    
        </x-form.patch>
    </div>

@endsection
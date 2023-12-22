
@extends('auth.layouts.app')

@section('title', 'Login')

@section('app')

    <div class="h-[100vh] w-auto fixed -z-1">
        <img class="h-full w-full object-cover brightness-50 blur-[2px]" src="{{ asset('image/frozen air cond.webp') }}" alt="">
    </div>

    <div class="flex flex-col justify-center align-items-center h-[100vh] mt-20">

        <a class="mb-[.5rem]" href="{{ route('frontend.home') }}">
            <img class="w-40 h-auto object-cover" src="{{ asset('image/logo.webp') }}" alt="">
        </a>

        <p class="text-3xl text-white font-sans font-black mb-[2.25rem]">Sign in to your account</p>

        <div class="shadow py-[2.25rem] px-[1.75rem] mt-[1rem] mb-[1rem] rounded-md bg-white border-1 border-solid border-gray-300 w-[40%]">

            <x-form.post :action="route('auth.login.valid')">
                
                @include('auth.forms.login-form')

            </x-form.post>
            

            {{-- <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="block text-sm rounded-md @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form> --}}
        </div>
    </div>
@endsection

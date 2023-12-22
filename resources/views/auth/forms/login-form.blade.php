
<div>

    <div class="w-full mb-2">

        <section class="input-area active" data-page="1">
        
            <div class="mb-4">
                <label for="email" class="form-sans font-bold required mb-2">Email</label>
                <input title="Please enter your email address" type="email" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" autocomplete="username" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>
        
            <div class="mb-2">
                <label for="password" class="form-sans font-bold required mb-2">Password</label>
                <input title="Please enter password" type="password" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" name="password" id="password" autocomplete="current-password" placeholder="Password" value="{{ old('password') }}" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('auth.password.reset') }}" class="w-[50%] text-sm font-bold text-blue-700 hover:text-blue-800 transition-colors duration-[.12s] ease-in-out">Forget Password ?</a>
                <a href="{{ route('auth.register.index') }}" class="w-[50%] text-sm text-blue-900 flex justify-end gap-x-[.6rem] transition-all duration-200 ease-in-out hover:gap-x-[1rem]">
                    Haven't any account? <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        
        </section>

    </div>
    <div class="mt-[1.75rem]">
        <button type="submit" id="submit-button" class="block w-full text-base bg-purple-800 rounded-md relative text-white px-4 py-[.75rem] hover:bg-purple-900 transition-colors duration-200 ease-in-out">
            <i class="fa-solid fa-lock absolute top-[50%] left-[1.5rem] -translate-y-[50%]"></i>
            Sign in
        </button>
    </div>
</div>


@extends('auth.layouts.app')

@section('title', __('Register'))

@section('app')

    <div class="flex justify-center align-items-center w-full h-[100vh]">

        <div class="absolute w-full h-full -z-1">
            <img class="w-full h-full object-cover" src="{{ asset('image/frozen air cond.webp') }}" alt="">
        </div>

        <div class="shadow bg-gray-50 border-1 border-solid border-gray-300 relative w-[60%] rounded-md py-4 px-[1.5rem]" data-carousel="static" id="slider-form">
    
            <!-- Stepper -->
            <ol class="flex justify-evenly items-center w-full mb-4">
                <li class="flex items-center text-blue-500 gap-x-[1rem] cursor-pointer" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0">
                    <span class="flex items-center justify-center w-8 h-8 border !border-blue-600 rounded-full shrink-0">
                        1
                    </span>
                    <span>
                        <h3 class="font-bold leading-tight">User info</h3>
                        <p class="text-sm">Basic information</p>
                    </span>
                </li>
                <li class="flex items-center text-gray-400 gap-x-[1rem] cursor-pointer aria-[current=true]:text-blue-500 group" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1">
                    <span class="flex items-center justify-center w-8 h-8 border !border-gray-500 group-aria-[current=true]:!border-blue-600 rounded-full shrink-0 ">
                        2
                    </span>
                    <span>
                        <h3 class="font-bold leading-tight">Company info</h3>
                        <p class="text-sm">Step details here</p>
                    </span>
                </li>
            </ol>
    
            <!-- Content -->
            <x-form.post :action="route('auth.register.store')" class="flex flex-col">
                
                <div class="relative h-[26.5rem] w-full overflow-hidden">
                    <div class="px-2 hidden !w-full mr-[3px]" data-carousel-item="active">
                        
                        <!-- Name & Email -->
                        <div class="flex justify-between gap-x-4">
                            <div class="mb-2 w-[48%]">
                                <label for="password" class="form-sans font-bold required mb-2">Name</label>
                                <input title="Please enter your name" type="text" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" name="name" id="name" autocomplete="current-password" placeholder="Name" value="{{ old('name') }}" required>
                            </div>
                        
                            <div class="mb-4 w-[48%]">
                                <label for="email" class="form-sans font-bold required mb-2">Email</label>
                                <input title="Please enter your email address" type="email" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" autocomplete="username" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                        </div>
    
                        <!-- Contact & Whatapps -->
                        <div class="flex flex-col mb-4">
    
                            <div class="flex justify-between gap-x-4 mb-2">
                                <div class="w-full" data-container>
                                    <label for="contact-phone" class="form-sans font-bold required mb-2">Contact Phone Number</label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-l-md ">
                                            +60
                                        </span>
                                        <input maxlength="14" title="Please enter your contact phone number" type="text" class="bg-gray-100 block w-full rounded-r-md border-1 border-solid border-gray-300 focus:bg-white" autocomplete="tel" name="contact_phone" id="contact-phone" placeholder="Contact Number" value="{{ old('contact_phone') }}" required>
                                    </div>
                                </div>
                            
                                <div class="w-[48%] hidden" data-container>
                                    <label for="whatsapp-phone" class="form-sans font-bold mb-2">Whatapps Phone Number</label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-l-md">
                                            +60
                                        </span>
                                        <input maxlength="14" title="Please enter your whatasapp phone number" type="text" class="bg-gray-100 block w-full rounded-r-md border-1 border-solid border-gray-300 focus:bg-white" name="whatsapp_phone" id="whatsapp-phone" autocomplete="tel" placeholder="Whatapps Number" value="{{ old('whatsapp_phone') }}">
                                    </div>
                                </div>
                            </div>
    
                            <div class="flex justify-start align-items-center gap-x-[.5rem]">
                                <input type="checkbox" onchange="showHideWhatasappPhone(event)" class="border border-gray-500 ml-[3px] cursor-pointer" name="samePhone" id="same-phone">
                                <label for="same-phone">My Contact Number and Phone Number aren't same.</label>
                            </div>
    
                        </div>
    
                        <!-- Shop Name -->
                        <div class="mb-4 w-full">
                            <label for="shop-name" class="form-sans font-bold required mb-2">Shop Name</label>
                            <input title="Please enter your shop name" type="text" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" name="shop_name" id="shop-name" placeholder="Shop Name" value="{{ old('shop_name') }}" required>
                        </div>

                        <!-- Next -->
                        <button type="button" class="bg-purple-600 text-white px-3 py-2 rounded-md hover:bg-purple-700" data-carousel-next>
                            Next
                        </button>
    
                    </div>
    
                    <div class="px-2 hidden !w-full mr-[3px]" data-carousel-item>
    
                        <!-- Birthday & Job -->
                        <div class="flex justify-between gap-x-4">
                            <div class="mb-4 w-[48%]">
                                <label for="birthday" class="form-sans font-bold required mb-2">Birthday</label>
                                <input title="Please enter your birthday date" type="date" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" name="birthday" id="birthday" placeholder="Birthday" value="{{ old('birthday') }}" required>
                            </div>
                        
                            <div class="mb-2 w-[48%]">
                                <label for="job" class="form-sans font-bold required mb-2">Job</label>
                                <input title="Please enter your job" type="text" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" name="job" id="job" placeholder="Job" value="{{ old('job') }}" required>
                            </div>
                        </div>
    
                        <!-- Address -->
                        <div class="mb-4 w-full">
                            <label for="address" class="form-sans font-bold required mb-2">Address</label>
                            <textarea title="Please enter address" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white resize-none" name="address" id="adderss" autocomplete="address-level1" placeholder="Address" value="" rows="3" required>{{ old('address') }}</textarea>
                        </div>
        
                        <!-- Password & Confirm Password -->
                        <div class="flex justify-between gap-x-4">
                            <div class="mb-4 w-[48%]">
                                <label for="password" class="form-sans font-bold required mb-2">Password</label>
                                <input title="Please enter your password" type="password" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" autocomplete="new-password" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
                                @error('password')
                                    <span class="text-sm text-red-700 " role="alert">
                                        <strong>{{ $errors->default->first('password') }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="mb-2 w-[48%]">
                                <label for="confirmed_password" class="form-sans font-bold required mb-2">Password Confirmed</label>
                                <input title="Please enter password" type="password" class="bg-gray-100 block w-full rounded-md border-1 border-solid border-gray-300 focus:bg-white" name="confirmed_password" id="confirmed_password" autocomplete="current-password" placeholder="Password" value="{{ old('confirmed_password') }}" required>
                            </div>
                        </div>

                        <div class="flex justify-between align-items-center">
                            <!-- Prev -->
                            <button type="button" class="bg-purple-600 text-white px-3 py-2 rounded-md hover:bg-purple-700" data-carousel-prev>
                                Prev
                            </button>
    
                            <!-- Submit -->
                            <button type="submit" id="submitBtn" class="flex justify-center align-items-center gap-x-[.75rem] bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed" disabled>
                                <i class="fa-solid fa-lock"></i> Sign Up
                            </button>
                        </div>

                    </div>
                </div>

            </x-form.post>
    
            <div class="flex justify-end mt-4">
                <a href="{{ route('auth.login.index') }}" class="w-[50%] text-sm text-blue-900 flex justify-end gap-x-[.6rem] transition-all duration-200 ease-in-out hover:gap-x-[1rem]">
                    Already have account? <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

    </div>
   
@endsection

@push('before-body')

@endpush

@push('after-body')
    <script>

        function showHideWhatasappPhone(event) {

            // Get target
            let checkbox = event.target;

            // Get Contact Phone Number [Input & Container]
            let contactPhoneNumberInput = document.querySelector('[name="contact_phone"]');
            let contactPhoneNumberContainer = contactPhoneNumberInput.closest('[data-container]')

            // Get Whatapps Phone Number [Input & Container]
            let whatappsPhoneNumberInput = document.querySelector('[name="whatsapp_phone"]');
            let whatappsPhoneNumberContainer = whatappsPhoneNumberInput.closest('[data-container]')

            if (checkbox.checked){
                contactPhoneNumberContainer.classList.add('!w-[48%]');
                whatappsPhoneNumberContainer.classList.remove('hidden');
                whatappsPhoneNumberInput.required = true;
            }else{
                contactPhoneNumberContainer.classList.remove('!w-[48%]');
                whatappsPhoneNumberContainer.classList.add('hidden');
                whatappsPhoneNumberInput.required = false;
            }
        }

        const requiredElements = document.querySelectorAll('[required]');

        document.querySelector('form').addEventListener('submit', function (event) {

            const isValid = Array.from(requiredElements).every(element => element.value.trim() !== '');

            if (!isValid) {
                event.preventDefault();
                alert('Please fill in all required fields.');
            }
        });

        requiredElements.forEach(element => {
            element.addEventListener('input', function () {

                const isFormValid = Array.from(requiredElements).every(element => element.value.trim() !== '');
                document.getElementById('submitBtn').disabled = !isFormValid;
            });
        });

    </script>
@endpush
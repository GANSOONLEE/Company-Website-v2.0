
@extends('backend.layouts.app')

@section('title', 'Profile')

@section('subtitle', 'See or update your profile data.')

@section('main')
        
    <x-form.patch :action="route('backend.user.data.storeProfile')">

        <input type="hidden" name="id" value="{{ $user->id }}">

        <!-- Basic Information -->
        <div class="row">

            <div class="row-content">

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="">Name</label>
                        <input type="text" class="input-field" name="name" disabled value="{{ $user->name }}"  placeholder="John" required>
                    </div>
    
                    <div class="col">
                        <label class="form-label read-only" for="">Email</label>
                        <input type="text" class="input-field" name="email" read-only disabled value="{{ $user->email }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="">Whatasapp Number</label>
                        <input type="text" class="input-field" name="whatsapp_phone" disabled value="{{ $user->whatsapp_phone }}">
                    </div>
                    
                    <div class="col">
                        <label class="form-label" for="">Contact Number</label>
                        <input type="text" class="input-field" name="contact_phone" disabled value="{{ $user->contact_phone }}">
                    </div>
                </div>

            </div>

        </div>

        <!-- Shop Information -->
        <div class="row">

            <div class="row-title">
                <p class="row-title-text">Shop Information</p>
            </div>

            <div class="row-content">
                
                <div class="col">
                    <label class="form-label" for="">Address</label>
                    <textarea class="input-field resize-none" name="address" disabled>{{ $user->address }}</textarea>
                </div>

                <div class="row mt-3">

                    <div class="col">
                        <label class="form-label read-only" for="">Jobs</label>
                        <input name="profession" type="text" class="input-field" value="{{ $user->profession }}"disabled>
                    </div>

                    <div class="col">
                        <label class="form-label read-only" for="">Shops Name</label>
                        <input name="shop_name" type="text" class="input-field" value="{{ $user->shop_name }}" disabled>
                    </div>

                </div>

            </div>
        </div>

        <!-- Button Action -->
        <div class="flex justify-between mt-3">
            <p class="text-sm">
                {{-- The column remark "#" can't change!<br>
                If you need to change please email<a href="mailto:frozenaircond.noreply@gmail.com">
                    Frozenaircond.noreply@gmail.com
                </a> --}}
            </p>
            <div class="flex jutify-center items-center gap-x-4">
                <button data-button-action="change" class="flex gap-x-4 items-center btn text-white bg-secondary" type="button" data-bs-toggle="modal" data-bs-target="#changePassword">
                    <i class="fa-solid fa-lock"></i>
                    @if ($user->password !== null)
                        Change Password
                    @else
                        Reset Password
                    @endif
                </button>
                <button data-button-action="edit" class="flex gap-x-4 items-center btn text-white bg-secondary" type="button">
                    <i class="fa-solid fa-pen"></i>
                    Edit
                </button>
                <button class="flex gap-x-4 items-center btn text-white bg-success" type="submit" disabled>
                    <i class="fa-solid fa-save"></i>
                    Save
                </button>
            </div>
        </div>

    </x-form.patch>

    @include('backend.user.change-passowrd')

@endsection

@push('after-style')

@endpush

@push('before-script')
<script>

    resetInput();
    let disabledElements = document.querySelectorAll('[disabled]:not([read-only])');

    function resetInput(){
        let editButton = document.querySelector('[data-button-action="edit"]');
        editButton.addEventListener('click', e => {
            disabledElements.forEach(disabledElement => {
                disabledElement.disabled = false;
            });
        })
    }

    // Form Submit
    // let form = document.querySelector('form');
    // form.addEventListener("submit", event =>{
    //     event.preventDefault();
        
    //     let xhr = new XMLHttpRequest();
    //     xhr.open(
    //         'POST',
    //         form.action,
    //         true
    //     );

    //     // csrf token
    //     xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    //     xhr.onreadystatechange = () => {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //             let response = JSON.parse(xhr.responseText);
    //             disabledElements.forEach(disabledElement=>{
    //                 disabledElement.disabled = true;
    //             })
    //         }
    //     };

    //     let formData = new FormData(form);
    //     formData.append('_method', 'PATCH');
    //     xhr.send(formData);
        
    // });

    // Valid Form

    // let formPassword = document.querySelector('form#information');

    // formPassword.addEventListener("submit", (event)=>{
    //     event.preventDefault();

    //     let currentPassword = document.querySelector('input[name="current-password').value;
    //     let newPassword = document.querySelector('input[name="new-password').value;
    //     let confirmPassword = document.querySelector('input[name="confirm-password').value;
        
    //     let xhr = new XMLHttpRequest();
    //     xhr.open(
    //         'post',
    //         formPassword.action,
    //         true
    //     );

    //     // csrf token
    //     let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    //     xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    //     xhr.onreadystatechange = () => {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //             let response = JSON.parse(xhr.responseText);
    //             formPassword.reset();
    //         }
    //     };

    //     let formData = new FormData(formPassword);
    //     formData.append('_method', 'PATCH');
    //     xhr.send(formData);
    // })

</script>
@endpush

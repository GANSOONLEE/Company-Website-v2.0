
@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('app')

    <div class="content">

        @php
            // $profileImages = [
            //     [
            //         'imagePath' => 'image/profile/AhShe.png',
            //         'name' => 'AhShe',
            //         'contactNumber' => '012-3456 7890',
            //     ],
            //     [
            //         'imagePath' => 'image/profile/DaSheng.png',
            //         'name' => 'DaSheng',
            //         'contactNumber' => '012-3456 7890',
            //     ]
            // ];
        @endphp

        @foreach ($profileImages as $image)
            <div class="profile">
                
                <!-- Picture -->
                <div class="profile-avatar">
                    <img src="{{ asset($image['imagePath']) }}" alt="" class="profile-picture" onload="this.style.display='block'">
                </div>

                <!-- Information -->
                <div class="profile-information">

                    <!-- Name -->
                    <div class="profile-name">
                        <p class="profile-name-text">
                            {{ $image['name'] }}
                        </p>
                    </div>

                    <!-- Contact Number -->
                    <div class="contact-number">
                        <p class="contact-number-text">
                            {{ $image['contactNumber'] }}
                        </p>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

@endsection

@push('before-body')
    <link rel="stylesheet" href="{{asset('css/frontend/contact.css')}}">
@endpush
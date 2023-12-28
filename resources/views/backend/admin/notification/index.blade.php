
@extends('backend.layouts.app')

@section('title', __('notification.publish-panel'))

@section('subtitle', __('notification.publish-panel-description'))

@section('main')

    <x-control-panel class="!w-full !max-w-[100%]">

        <x-form.post :action="route('backend.admin.notification.publish')"  class="flex flex-col justify-start items-start w-full">
            <div class="relative mb-3 w-full">
                <label class="mb-[.3rem]" for="notification-messages">@lang('notification.messages')</label>
                <input name="messages" type="search" id="notification-messages" class="block w-full px-3 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('notification.messages') }}" required>
            </div>
            <div class="relative">
                <label class="mb-[.3rem]" for="notification-duration">@lang('notification.duration', ["unit" => "ms"])</label>
                <input name="duration" type="number" id="notification-duration" min="1000" max="86400" class="block px-3 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000">
            </div>
            <button class="text-base px-3 py-2 mt-2 self-end text-white bg-blue-600 rounded-sm hover:bg-blue-700">@lang('Publish')</button>
        </x-form.post>

    </x-control-panel>

@endsection

<div class="p-6 bg-gray-10 c-bg-white border border-gray-200 c-w-48 rounded-lg dark:bg-gray-800 dark:border-gray-700">
    <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $attributes['title'] }}</h5>

    <p class="mb-4 font-normal text-gray-700 dark:text-gray-400">
        {{ $slot }}
    </p>

    @if ($attributes['showButton'])      
        <a href="{{ $attributes['button-href'] }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ $attributes['button-text'] }}
            <i class=" ml-3 fa-solid fa-arrow-right"></i>
        </a>
    @endif

</div>

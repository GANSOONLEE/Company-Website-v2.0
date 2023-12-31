
<li>
    <a href="{{ $attributes['href'] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <i class="fa-solid fa-{{ $attributes['icon'] }} flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
        <span class="ms-3">{{ $attributes['label'] }}</span>
    </a>
</li>
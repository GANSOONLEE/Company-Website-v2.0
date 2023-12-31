
<li>
    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown" data-collapse-toggle="dropdown-example">
       <i class="fa-solid fa-{{ $attributes['icon'] }} flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
       <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $attributes['label'] }}</span>
       <svg class="max-w-3 max-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
       </svg>
    </button>
    <ul id="dropdown-example" class="relative hidden py-2 space-y-2">
      {{ $slot }}
    </ul>
 </li>
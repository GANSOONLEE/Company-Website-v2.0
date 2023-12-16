
<section>

    <button type="button" id="sidebar-button" class="mx-8 p-2 mb-2 text-white bg-blue-600 transition duration-150 ease-in-out hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <i class="fa-solid fa-filter"></i>
    </button>

    <x-frontend.sidebar :category="$category">


    </x-frontend.sidebar>

</section>
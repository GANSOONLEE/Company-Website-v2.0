
<style>
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
</style>

@unless($breadcrumbs->isEmpty())
    <ol class="relative breadcrumb flex px-4 py-3 text-gray-700 border border-gray-200 rounded-md bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:!text-white z-99">
        @foreach($breadcrumbs as $breadcrumb)
 
            @if(!$loop->last)
                <li class="breadcrumb-item dark:!text-white"><a class="dark:text-whitehover:text-sky-700 dark:hover:text-gray-300" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item dark:!text-gray-200 active dark:before:!text-white">{{ $breadcrumb->title }}</li>
            @endif
 
        @endforeach
    </ol>
@endunless

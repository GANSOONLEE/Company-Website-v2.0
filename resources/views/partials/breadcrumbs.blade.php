
<style>
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
</style>

@unless($breadcrumbs->isEmpty())
    <ol class="breadcrumb flex px-4 py-3 text-gray-700 border border-gray-200 rounded-md bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        @foreach($breadcrumbs as $breadcrumb)
 
            @if(!$loop->last)
                <li class="breadcrumb-item dark:text-white"><a class="dark:text-whitehover:text-sky-700 dark:hover:text-slate-300 dark:text-white before:text-white" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item dark:text-slate-500 active">{{ $breadcrumb->title }}</li>
            @endif
 
        @endforeach
    </ol>
@endunless

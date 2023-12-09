
@unless($breadcrumbs->isEmpty())
    <ol class="breadcrumb flex px-4 py-3 text-gray-700 border border-gray-200 rounded-md bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
        @foreach($breadcrumbs as $breadcrumb)
 
            @if(!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item dark:text-white"><a class="hover:text-sky-700 dark:hover:text-slate-300" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item dark:text-slate-500 active">{{ $breadcrumb->title }}</li>
            @endif
 
        @endforeach
    </ol>
@endunless
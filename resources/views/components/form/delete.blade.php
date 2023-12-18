
<form method="post" enctype="multipart/form-data" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal']) }}>
    @csrf
    @method('delete'
    )
    {{ $slot }}

</form>

<form method="get" enctype="multipart/form-data" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal']) }}>

    {{ $slot }}

</form>
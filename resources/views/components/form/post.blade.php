
<form method="post" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal']) }}>
    @csrf
    @method('post')

    {{ $slot }}

</form>
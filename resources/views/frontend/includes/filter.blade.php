
<section class="filter">

    <form action="" method="GET">
        @csrf

        <!-- Search Field -->
        <input class="form-search" type="search" name="" id="">

        @foreach ($typeData as $type)
        <label for="{{ $type->name }}">
            <input type="checkbox" name="" id="{{ $type->name }}">
            <div class="type-box">
                {{ $type->name }}
            </div>
        </label>
        @endforeach

    </form>

</section>
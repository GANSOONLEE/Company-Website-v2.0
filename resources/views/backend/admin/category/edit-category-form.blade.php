
<div class="background-form">

    <!-- Section -->
    <section class="form">

        <!-- Form Header -->
        <div class="form-header">
            <p class="form-header-text">{{ __('category.edit-category-form') }}</p>
        </div>

        <!-- Form Body -->
        <div class="form-body">

            <!-- Form -->
            <form class="edit-category-form" id="form" action="{{ route('backend.admin.category.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Cover -->
                <div class="category-cover">
                    <img src="" alt="" class="category-cover-image">
                </div>

                <!-- Upload -->
                <div class="category-upload">
                    <label for="category-cover" class="category-cover">{{ __('category.upload-cover') }}</label>
                    <input type="file" name="category-cover" id="category-cover" accept=".jpg, .png, .jpeg">
                </div>

                <!-- Category Name -->
                <label for="" class="form-label">{{ __('category.edit-category-name') }}</label>
                <input class="form-control" name="category-name" type="text" value="">

                <!-- Category Name -->
                <label for="" class="form-label" hidden>{{ __('category.edit-category-name') }}</label>
                <input class="form-control" name="category-name-old" type="text" value="" hidden>

                <!-- Button -->
                <button class="update-button btn btn-primary" type="submit">{{ __('category.update') }}</button>
            </form>
        </div>

    </section>
</div>
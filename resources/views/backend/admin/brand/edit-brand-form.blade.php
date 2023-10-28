
<div class="background-form">

    <!-- Section -->
    <section class="form">

        <!-- Form Header -->
        <div class="form-header">
            <p class="form-header-text">{{ __('brand.edit-brand-form') }}</p>
        </div>

        <!-- Form Body -->
        <div class="form-body">

            <!-- Form -->
            <form class="edit-brand-form" id="form" action="{{ route('backend.admin.brand.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <!-- Cover -->
                <div class="brand-cover">
                    <img src="" alt="" class="brand-cover-image">
                </div>

                <!-- Upload -->
                <div class="brand-upload">
                    <label for="brand-cover" class="brand-cover">{{ __('brand.upload-cover') }}</label>
                    <input type="file" name="brand-cover" id="brand-cover" accept=".jpg, .png, .jpeg">
                </div>

                <!-- brand Name -->
                <label for="" class="form-label">{{ __('brand.edit-brand-name') }}</label>
                <input class="form-control" name="brand-name" type="text" value="">
                <input class="form-control" type="text" name="brand-origin-name" hidden id="">

                <!-- Button -->
                <button class="update-button btn btn-primary" type="submit">{{ __('brand.update') }}</button>
            </form>
        </div>

    </section>
</div>

<section class="panel" id="create-role">
    
    <p class="section-title">{{ __('account.create-role-panel') }}</p>

    <form action="{{ route('backend.admin.account.create-role') }}" class="form" id="form" method="POST">
        @csrf
        <div class="row">
            <div class="mb-3 col-6">
                <label for="" class="form-label">{{ __('account.form.label.role-id') }}</label>
                <input type="text" class="form-control" id="" name="role-id" placeholder="{{ __('account.form.label.role-id') }}" required>
            </div>
    
            <div class="mb-3 col-6">
                <label for="" class="form-label">{{ __('account.form.label.role-weight') }}</label>
                <input type="text" class="form-control" id="" name="role-weight" placeholder="{{ __('account.form.label.role-weight') }}" required>
            </div>
        </div>
    
        <div class="row">
            <div class="mb-3 col-6">
                <label for="" class="form-label">{{ __('account.form.label.role-name-en') }}</label>
                <input type="text" class="form-control" id="" name="role-name-zh" placeholder="{{ __('account.form.label.role-name-en') }}" required>
            </div>
    
            <div class="mb-3 col-6">
                <label for="" class="form-label">{{ __('account.form.label.role-name-zh') }}</label>
                <input type="text" class="form-control" id="" name="role-name-en" placeholder="{{ __('account.form.label.role-name-zh') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="mt-3">
                <button class="btn btn-success" type="submit">{{ __('account.submit') }}</button>
            </div>
        </div>

    </form>

</section>
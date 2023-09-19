

<div class="modal-background">

    
    <!-- Modal -->
    <div class="custom-modal">

        <!-- Form -->
        <form action="{{ route('backend.admin.account.update-user') }}" class="form" id="form" method="post">
            @csrf
            <!-- Title -->
            <div class="modal-header">
                <p class="modal-title">{{ __('account.edit') }}</p>
                <button type="button" class="btn-close close-button"></button>
            </div>

            <!-- Content -->
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="modal-input-name" class="form-label">{{ __('account.user-name') }}</label>
                    <input type="text" name="name" id="modal-input-name" class="form-control" readonly disabled>
                </div>

                <div class="mb-3">
                    <label for="modal-input-email" class="form-label">{{ __('account.user-email') }}</label>
                    <input type="text" name="email" id="modal-input-email" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="modal-input-role" class="form-label">{{ __('account.role') }}</label>
                    <select name="role" id="modal-input-role" class="form-control">
                        @foreach($roleData as $role)
                            <option value="{{ $role }}">{{ __("account.roles.$role") }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Button -->
            <div class="modal-footer">
                <button id="edit-submit-button" class="btn btn-success" type="submit">{{ __('account.submit') }}</button>
            </div>
            
        </form>
    </div>
</div>
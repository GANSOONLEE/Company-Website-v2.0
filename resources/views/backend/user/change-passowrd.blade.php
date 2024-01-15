
<!-- Modal -->
<div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content dark:bg-gray-700">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="flex justify-center items-center btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark dark:text-white"></i>
                </button>
            </div>
            <div class="modal-body">
                
                <x-form.patch :action="route('backend.user.data.update')" id="information" class="form">

                    <input type="text" name="email" value="{{ $user->email }}" hidden>

                    <div class="mb-3" {{ $user->password === null ? 'hidden' : '' }}>
                        <label for="" class="form-label">Current Password :</label>
                        <input type="password" name="current-password" class="form-control dark:bg-gray-600 dark:text-white" autocomplete="current-password" value="{{ $user->password === null ? null : '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">New Password :</label>
                        <input type="password" name="new-password" class="form-control dark:bg-gray-600 dark:text-white" autocomplete="new-password">
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Confirm New Password :</label>
                        <input type="password" name="confirm-password" class="form-control dark:bg-gray-600 dark:text-white" autocomplete="new-password">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn bg-secondary text-white" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary text-white">Submit</button>
                    </div>
                </x-form.patch>

            </div>
        </div>
    </div>
</div>
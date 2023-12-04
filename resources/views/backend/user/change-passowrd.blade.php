
<!-- Modal -->
<div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('backend.user.data.change-password-post') }}" id="information" class="form" method="POST">
                    @csrf

                    <div class="mb-3" {{ $user->password === null ? 'hidden' : '' }}>
                        <label for="" class="form-label">Current Password :</label>
                        <input type="password" name="current-password" class="form-control" autocomplete="current-password" value="{{ $user->password === null ? null : '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">New Password :</label>
                        <input type="password" name="new-password" class="form-control" autocomplete="new-password">
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Confirm New Password :</label>
                        <input type="password" name="confirm-password" class="form-control" autocomplete="new-password">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
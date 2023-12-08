
<template>
    <div class="modal" id="deleteConfirmModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ app }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p> {{ message }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deleteImageButton" data-bs-dismiss="modal"> {{ delete }}</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> {{ cancel }}</button>
            </div>
          </div>
        </div>
    </div>
</template>

<style>

</style>

<script>
export default {
  props: {
    app: String,
    message: String,
    delete: String,
    cancel: String,
  }
};
</script>
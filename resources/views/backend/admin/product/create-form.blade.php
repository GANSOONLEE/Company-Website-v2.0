<x-form.post :action="route('backend.admin.user.store')">

    @for ($i = 0; $i < 10; $i++)
        <div class="box">
            <div class="container">
                <label for="product-{{ $i }}">
                    1
                </label>

            </div>
            <input type="file" name="product[]" id="product-{{ $i }}" onchange="previewFile(event)" hidden>
        </div>
    @endfor

    <img src="" alt="" id="display">

</x-form.post>

<script>

    function previewFile(event) {
        let preview = document.querySelector('img#display');
        let file = event.target.files[0];
        console.log(event.target)
        let reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }

</script>

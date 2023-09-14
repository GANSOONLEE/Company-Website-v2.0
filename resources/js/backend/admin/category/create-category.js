

$('#category-cover').on('change', function() {
    var file = this.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.category-cover-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});



$('#brand-cover').on('change', function() {
    var file = this.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.brand-cover-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

$(document).ready(function(){
    $('#image').on("change", previewImages);

    function previewImages() {

        var $preview = $('#preview').empty();
        if (this.files) $.each(this.files, readAndPreview);
        function readAndPreview(i, file) {

            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            }

            var reader = new FileReader();

            $(reader).on("load", function () {
                $preview.append($("<img/>", { src: this.result, height: 100 }));
            });

            reader.readAsDataURL(file);
        }
    }

    $('#blog').submit(function(){
        
        let title = $('#title').val();
        let description = $('#description').val();
        let body = $body('#body').val();
        
        $('.error').remove();

        if (title.length < 1) {
            $('#title').after('<span class="error text-danger">Plese enter your name<span>');
            return false;
        }
        if(description.length < 1){
            $('#description').after('<span class="error text-danger">Plese enter description<span>');
            return false;
        }
        if(body.length < 1){
            $('#body').after('<span class="error text-danger">Plese enter body<span>');
            return false;
        }
    });
});
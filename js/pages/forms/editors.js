$(function () {
    //CKEditor
    // CKEDITOR.replace('ckeditor');
    // CKEDITOR.config.height = 300;

    //TinyMCE
    tinymce.init({
        selector: "textarea.tinymce",
        theme: "modern",
        // theme : "advanced",
        mode: "exact",
        elements : "tinymce, tinymce2",
        height: 200,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template code paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = 'plugins/tinymce';
});
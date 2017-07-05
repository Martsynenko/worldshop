jQuery(function ($) {

    $("#answer").summernote({

        lang:'ru-Ru',
        height:200,
        minwidth:400,
        minHeight:200,
        maxHeight:400,
        focus:false,
        placeholder:'Enter text here',
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        toolbar:[
            ['insert', ['link']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['height', ['height']]
        ],
        disableDragAndDrop:true
    });

});


 $(function (){
    $ ( ".select2" ). select2 ({
        tags : true ,
        tokenSeparators : [',']
    })

    $ ( ".select2-init" ). select2 ({
    placeholder: "Select a state",
    allowClear: true
});


         let editor_config = {
             forced_root_block : false,
             path_absolute : "/",
         selector: 'textarea.tynimce_init',
         relative_urls: false,
         plugins: [
         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen",
         "insertdatetime media nonbreaking save table directionality",
         "emoticons template paste textpattern"
         ],
         toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
         file_picker_callback : function(callback, value, meta) {
         let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
         let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

         let cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
         if (meta.filetype == 'image') {
         cmsURL = cmsURL + "&type=Images";
     } else {
         cmsURL = cmsURL + "&type=Files";
     }

         tinyMCE.activeEditor.windowManager.openUrl({
         url : cmsURL,
         title : 'Filemanager',
         width : x * 0.8,
         height : y * 0.8,
         resizable : "yes",
         close_previous : "no",
         onMessage: (api, message) => {
         callback(message.content);
     }
     });
     }
     };


         tinymce.init(editor_config);

});


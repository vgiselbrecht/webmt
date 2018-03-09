<?php

class JS
{
    function includefileuploader()
    {
        return '<script src="html/classes/file_upload/client/fileuploader.js"></script>';
    }
    function fileuploader($htmid, $action, $extension, $multiple, $auto, $text, $site)
    {
        return "
        var uploader = new qq.FileUploader({
        element: document.getElementById('".$htmid."'),
        // Use the relevant server script url here
        action: '".$action."',
        allowedExtensions: ['".$extension."'],
        multiple: ".$multiple.",
        autoUpload: ".$auto.",
        uploadButtonText: '".$text."',
        onComplete: function(id, fileName, responseJSON) {
            if (responseJSON.success) {
                window.location = '".$site."';
            }
        },
        debug: true
        });";
    }
    function startfileuploader()
    {
        return 'uploader.uploadStoredFiles();';
    }
}

?>

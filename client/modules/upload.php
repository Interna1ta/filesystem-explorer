<?php

session_start();

$types_allowed = [
    'application/msword',
    'application/vnd.ms-powerpoint',
    'application/vnd.ms-excel',
    'image/svg+xml',
    'image/jpg',
    'image/jpeg',
    'image/png',
    'text/csv',
    'image/svg+xml',
    'text/plain',
    'application/vnd.oasis.opendocument.text',
    'application/pdf',
    'application/zip',
    'application/vnd.rar',
    'application/x-msdownload',
    'audio/mpeg',
    'video/mp4',
];

function upload_error($error)
{
    $upload_errors = array(
        UPLOAD_ERR_OK                 => "No errors.",
        UPLOAD_ERR_INI_SIZE      => "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE     => "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL         => "Partial upload.",
        UPLOAD_ERR_NO_FILE         => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION     => "File upload stopped by extension."
    );
    return $upload_errors[$error];
}

$dir = '../files/';

if (isset($_POST)) {
    // process the form data

    $filename = basename($_FILES['file_upload']['name']);
    $tmp_path = $_FILES['file_upload']['tmp_name'];
    $type = $_FILES['file_upload']['type'];
    $size = $_FILES['file_upload']['size'];
    $error = $_FILES['file_upload']['error'];

    // check for upload errors
    if ($error > 0) {
        $message = upload_error($error);

        // validate file type
    } elseif (!in_array($type, $types_allowed)) {
        $message = 'File must be an image file.';

        // validate file type
    } elseif ($size > 10485760) {
        $message = 'File must be less than 10MB.';
    } else {
        // choose a new file name if desired
        $target_path = "{$dir}/{$filename}";

        // move file to permanent location
        if (move_uploaded_file($tmp_path, $target_path)) {
            // change file permissions
            chmod($target_path, 0766);
            $message = "File" . $filename . "was uploaded successfully.";
        } else {
            $message = "There is an error uploading the file" . $filename . ". Please try again.";
        }
    }
}
header('Location: ../dashboard.php');

<?php
// Image upload endpoint for FCKeditor - inserts images into editor content
include_once("functions/is_login.php");
session_start();
if(!is_login()){
    http_response_code(403);
    exit('Please login first');
}

$allowed_exts = array("jpg","jpeg","png","gif","bmp");
$upload_dir = "uploads/";

if(!isset($_FILES["upload"])){
    http_response_code(400);
    exit('No file uploaded');
}

$file = $_FILES["upload"];
$error = $file['error'];
if($error !== 0){
    http_response_code(400);
    exit('Upload error');
}

$file_name = $file['name'];
$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
if(!in_array($ext, $allowed_exts)){
    http_response_code(400);
    exit('Only image files allowed (jpg/jpeg/png/gif/bmp)');
}

$new_name = date("Ymd_His") . "_" . mt_rand(1000,9999) . "." . $ext;
$destination = $upload_dir . $new_name;

if(move_uploaded_file($file['tmp_name'], $destination)){
    $url = $destination;
    echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . intval($_GET['CKEditorFuncNum']) . ', "' . htmlspecialchars($url) . '");</script>';
}else{
    http_response_code(500);
    exit('File save failed');
}
?>
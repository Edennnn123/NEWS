<?php
include_once("functions/is_login.php");
if(!session_id()){
     session_start();
}
if(!is_login()){
     echo "请先登录系统再访问此页面！";
     return;
}
include_once("functions/database.php");
include_once("functions/file_system.php");
$news_id = intval($_POST["news_id"]);
$category_id = intval($_POST["category_id"]);
$title = escape_string($_POST["title"]);
$content = escape_string($_POST["content"]);

// summary
if(!empty(trim($_POST["summary"]))){
    $summary = escape_string($_POST["summary"]);
}else{
    $plain = strip_tags($_POST["content"]);
    $summary = escape_string(mb_strcut($plain, 0, 200, "gbk"));
}

$is_top = isset($_POST["is_top"]) ? 1 : 0;

// thumbnail
$thumbnail_sql = "";
if(isset($_FILES["thumbnail"]) && $_FILES["thumbnail"]["error"] == 0){
    $ext = strtolower(pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION));
    $allowed_img = array("jpg","jpeg","png","gif","bmp");
    if(in_array($ext, $allowed_img)){
        $thumb_name = "thumb_" . date("Ymd_His") . "_" . mt_rand(1000,9999) . "." . $ext;
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "uploads/" . $thumb_name);
        $thumbnail = escape_string($thumb_name);
        $thumbnail_sql = ",thumbnail='$thumbnail'";
    }
}

// attachment
$file_sql = "";
if(isset($_FILES["news_file"]) && $_FILES["news_file"]["error"] == 0){
    $file_name = escape_string($_FILES["news_file"]["name"]);
    $msg = upload($_FILES["news_file"], "uploads");
    if($msg == "文件上传成功！"){
        $file_sql = ",attachment='$file_name'";
    }
}

$sql = "update news set category_id=$category_id,title='$title',content='$content',summary='$summary',is_top=$is_top$thumbnail_sql$file_sql where news_id=$news_id";
get_connection();
mysqli_query($GLOBALS['database_connection'], $sql);
close_connection();
$message = "新闻信息修改成功！";
header("Location:index.php?url=news_list.php&message=$message");
?>
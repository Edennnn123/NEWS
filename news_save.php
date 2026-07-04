<?php
include_once("functions/is_login.php");
session_start();
if(!is_login()){
     echo "请先登录系统再访问此页面！";
     return;
}
include_once("functions/file_system.php");
if(empty($_POST)){
     $message = "上传的文件大小超过php.ini中post_max_size选项限制的值";
}else{
     $user_id = intval($_SESSION["user_id"]);
     $category_id = intval($_POST["category_id"]);
     $title = escape_string($_POST["title"]);
     $content = escape_string($_POST["content"]);

     // Summary: auto-extract from content if empty
     if(!empty(trim($_POST["summary"]))){
         $summary = escape_string($_POST["summary"]);
     }else{
         $plain = strip_tags($_POST["content"]);
         $summary = escape_string(mb_strcut($plain, 0, 200, "gbk"));
     }

     $currentDate = date("Y-m-d H:i:s");
     $clicked = 0;
     $is_top = isset($_POST["is_top"]) ? 1 : 0;

     // Thumbnail upload
     $thumbnail = "";
     if(isset($_FILES["thumbnail"]) && $_FILES["thumbnail"]["error"] == 0){
         $ext = strtolower(pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION));
         $allowed_img = array("jpg","jpeg","png","gif","bmp");
         if(in_array($ext, $allowed_img)){
             $thumb_name = "thumb_" . date("Ymd_His") . "_" . mt_rand(1000,9999) . "." . $ext;
             move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "uploads/" . $thumb_name);
             $thumbnail = escape_string($thumb_name);
         }
     }

     // Attachment
     $file_name = "";
     $message = "新闻发布成功！";
     if(isset($_FILES["news_file"]) && $_FILES["news_file"]["error"] == 0){
         $file_name = escape_string($_FILES["news_file"]["name"]);
         $msg = upload($_FILES["news_file"], "uploads");
         if($msg == "文件上传成功！" || $msg == "没有选择上传文件！"){
             $message = $msg;
         }else{
             $file_name = "";
             $message = $msg;
         }
     }

     $sql = "insert into news values(null,$user_id,$category_id,'$title','$content','$summary','$currentDate',$clicked,'$file_name','$thumbnail',$is_top)";
     include_once("functions/database.php");
     get_connection();
     mysqli_query($GLOBALS['database_connection'], $sql);
     close_connection();
}
$message = urlencode($message);
header("Location:index.php?url=news_list.php&message=$message");
?>
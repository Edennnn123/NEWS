<?php 
include_once("functions/is_login.php"); 
session_start(); 
if(!is_login()){ 
     echo "???????????????????—ž"; 
     return; 
} 
?> 
<?php 
include_once("functions/file_system.php"); 
if(empty($_POST)){ 
     $message = "??????????????php.ini??post_max_size?????????"; 
}else{ 
     $user_id = intval($_SESSION["user_id"]);
     $category_id = intval($_POST["category_id"]);
     $title = escape_string($_POST["title"]);
     $content = escape_string($_POST["content"]);
     $currentDate =  date("Y-m-d H:i:s"); 
     $clicked = 0; 
     $file_name = escape_string($_FILES["news_file"]["name"]); 
     $message = upload($_FILES["news_file"],"uploads"); 
     $sql = "insert into news 
values(null,$user_id,$category_id,'$title','$content', '$currentDate',$clicked,'$file_name')"; 
     if($message=="???????????"||$message=="???????????????"){ 
     		include_once("functions/database.php"); 
     		get_connection(); 
     		mysqli_query($GLOBALS['database_connection'], $sql); 
     		close_connection();		 
     }	 
} 
$message = urlencode($message);
header("Location:index.php?url=news_list.php&message=$message");  
?>
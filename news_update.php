<?php 
include_once("functions/is_login.php"); 
if(!session_id()){//这里使用session_id()判断是否已经开启了Session 
     session_start(); 
} 
if(!is_login()){ 
     echo "请您登录系统后，再访问该页面！"; 
     return; 
} 
?> 
<?php 
include_once("functions/database.php"); 
$news_id = intval($_POST["news_id"]); 
$category_id = intval($_POST["category_id"]); 
$title = escape_string($_POST["title"]); 
$content = escape_string($_POST["content"]); 
$sql = "update news set category_id=$category_id,title='$title',content='$content' where news_id=$news_id"; 
get_connection(); 
mysqli_query($GLOBALS['database_connection'], $sql); 
close_connection(); 
$message = "新闻信息修改成功！"; 
header("Location:index.php?url=news_list.php&message=$message"); 
?> 
<?php 
include_once("functions/is_login.php"); 
if (!session_id()){//这里使用session_id()判断是否已经开启了Session 
     session_start(); 
} 
if(!is_login()){ 
     echo "请您登录系统后，再访问该页面！"; 
     return; 
} 
?> 
<?php 
include_once("functions/database.php"); 
$news_id = intval($_GET["news_id"]); 
get_connection(); 
mysqli_query($GLOBALS['database_connection'], "delete from review where news_id=$news_id"); 
mysqli_query($GLOBALS['database_connection'], "delete from news where news_id=$news_id"); 
close_connection(); 
$message = "新闻及相关评论信息删除成功！"; 
header("Location:index.php?url=news_list.php&message=$message");
?> 
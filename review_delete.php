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
$review_id = intval($_GET["review_id"]); 
$sql = "delete from review where review_id=$review_id"; 
get_connection(); 
$result_set = mysqli_query($GLOBALS['database_connection'], $sql); 
close_connection(); 
header("Location:index.php?url=review_list.php"); 
?> 
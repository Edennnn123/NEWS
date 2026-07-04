<?php 
include_once("functions/database.php"); 
$news_id = intval($_POST["news_id"]); 
//$content = htmlspecialchars(addslashes($_POST["content"]));
$content = escape_string($_POST["content"]); 
$currentDate = date("Y-m-d H:i:s"); 
$ip = $_SERVER["REMOTE_ADDR"]; 
$state = "δ���"; 
$sql = "insert into review values(null,$news_id,'$content','$currentDate','$state','$ip')"; 
get_connection(); 
mysqli_query($GLOBALS['database_connection'], $sql); 
close_connection(); 
$message = "�����ŵ�������Ϣ�ɹ����ӵ����ݿ���У�"; 
header("Location:index.php?url=news_list.php&message=$message");  
?> 
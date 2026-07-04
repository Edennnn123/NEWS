<?php
include_once("functions/database.php");
get_connection();
// 添加初始分类
mysqli_query($GLOBALS['database_connection'], "insert into category values(null,'国内')");
mysqli_query($GLOBALS['database_connection'], "insert into category values(null,'国际')");
// 添加管理员用户 admin，密码 admin，双重 MD5 加密
$password = md5(md5("admin"));
mysqli_query($GLOBALS['database_connection'], "insert into users values(null,'admin','$password')");
close_connection();
echo "成功添加初始数据";
?>

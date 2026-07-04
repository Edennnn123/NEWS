<?php
$database_connection = null;
function get_connection(){
     $hostname = "localhost"; 		//数据库服务器的主机名或IP地址
     $database = "news"; 			//数据库名
     $username = "root"; 			//数据库服务器用户名
     $password = ""; 				//数据库服务器密码
     global $database_connection;
     // 先连接MySQL（不指定数据库），再创建/选择数据库
     $database_connection = @mysqli_connect($hostname, $username, $password);
     if(!$database_connection){
     		exit("系统错误，请稍后再试");
     }
     // 创建数据库（如果不存在）
     mysqli_query($database_connection, "set names 'gbk'");
     mysqli_query($database_connection, "create database if not exists `$database` default charset gbk collate gbk_chinese_ci");
     mysqli_select_db($database_connection, $database);
}
function close_connection(){
     global $database_connection;
     if($database_connection){
     		@mysqli_close($database_connection);
	}
}
function escape_string($input){
	global $database_connection;
	return mysqli_real_escape_string($database_connection, $input);
}
?>

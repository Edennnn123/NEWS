<?php
$database_connection = null;
function get_connection(){
     $hostname = "localhost"; 		//数据库服务器的主机名或IP地址
     $database = "news"; 			//数据库名
     $username = "root"; 			//数据库服务器用户名
     $password = ""; 				//数据库服务器密码
     global $database_connection;
     $database_connection = @mysqli_connect($hostname, $username, $password, $database);
     if(!$database_connection){
     		exit("系统错误，请稍后再试");
     }
     mysqli_query($database_connection, "set names 'gbk'");//设置字符集
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
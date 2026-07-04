<?php
$database_connection = null;
function get_connection(){
     $hostname = "localhost"; 		// database server hostname or IP
     $database = "news"; 			// database name
     $username = "root"; 			// database username
     $password = ""; 				// database password
     global $database_connection;
     // connect first, then create/select database
     $database_connection = @mysqli_connect($hostname, $username, $password);
     if(!$database_connection){
          exit("系统错误，请稍后再试");
     }
     // charset & create/select database
     mysqli_query($database_connection, "set names 'gbk'");
     if(!mysqli_select_db($database_connection, $database)){
         mysqli_query($database_connection, "create database if not exists `$database` default charset gbk collate gbk_chinese_ci");
         mysqli_select_db($database_connection, $database);
     }
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

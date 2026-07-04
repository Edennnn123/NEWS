<?php
session_start();
include_once("functions/database.php");

$name = trim($_POST["name"]);
$password = $_POST["password"];
$password2 = $_POST["password2"];

// 验证码校验
if($_POST["checknum"] != $_SESSION["checknum"]){
    header("Location:register.php?message=checknum_error");
    return;
}

// 两次密码一致性校验
if($password != $password2){
    header("Location:register.php?message=password_mismatch");
    return;
}

// 检查用户名是否已存在
get_connection();
$check_sql = "select * from users where name='$name'";
$check_result = mysql_query($check_sql);
if(mysql_num_rows($check_result) > 0){
    close_connection();
    header("Location:register.php?message=name_exists");
    return;
}

// 密码双重MD5加密（与现有系统一致）
$password_md5 = md5(md5($password));

// 插入新用户
$sql = "insert into users values(null,'$name','$password_md5')";
if(mysql_query($sql)){
    // 获取新用户ID并自动登录
    $user_id = mysql_insert_id();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['name'] = $name;
    close_connection();
    header("Location:register.php?message=register_success");
}else{
    close_connection();
    header("Location:register.php?message=fail");
}
?>

<?php
include_once("functions/is_login.php");
if(isset($_GET["login_message"])){
     if($_GET["login_message"]=="checknum_error"){
          echo '<div class="message message-error">验证码错误，请重新登录</div>';
     }else if($_GET["login_message"]=="password_error"){
          echo '<div class="message message-error">密码错误，请重新登录</div>';
     }else if($_GET["login_message"]=="password_right"){
          echo '<div class="message message-success">登录成功</div>';
     }
}
if(is_login()){
     echo '<div class="welcome-info">欢迎 <strong>'.$_SESSION['name'].'</strong> 进入系统</div>';
     echo '<a href="logout.php" class="logout-link">退出登录</a>';
     return;
}
$name = "";
if(isset($_COOKIE["name"])){
     $name = $_COOKIE["name"];
}
$password = "";
if(isset($_COOKIE["password"])){
     $password = $_COOKIE["password"];
}
?>
<form action="login_process.php" method="post" class="login-form">
    <div class="form-row">
        <div class="form-group">
            <label class="form-label">用户名</label>
            <input type="text" name="name" class="form-input" value="<?php echo $name?>" placeholder="用户名">
        </div>
        <div class="form-group">
            <label class="form-label">密码</label>
            <input type="password" name="password" class="form-input" value="<?php echo $password?>" placeholder="密码">
        </div>
        <div class="form-group">
            <label class="form-label">验证码</label>
            <div class="checknum-row">
                <input type="text" name="checknum" class="form-input" style="width:70px;" placeholder="验证码">
<?php
$checknum  =  "";
$checknum .= mt_rand(0,9);
$checknum .= mt_rand(0,9);
$checknum .= mt_rand(0,9);
$checknum .= mt_rand(0,9);
$_SESSION['checknum'] = $checknum;
echo '                <span class="checknum-display">'.$checknum.'</span>';
?>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">&nbsp;</label>
            <div class="form-actions">
                <input type="submit" value="登录" class="btn btn-primary">
            </div>
        </div>
    </div>
    <div class="form-row" style="margin-top:8px;">
        <div class="login-cookie">
            <input type="checkbox" name="expire" value="3600" checked/> Cookie保存1小时
        </div>
        <div class="login-links">
            <a href="register.php">没有账号？注册</a>
        </div>
    </div>
</form>

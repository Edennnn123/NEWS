<?php
session_start();
include_once("functions/is_login.php");
if (!session_id()) {
    session_start();
}
$checknum = "";
$checknum .= mt_rand(0,9);
$checknum .= mt_rand(0,9);
$checknum .= mt_rand(0,9);
$checknum .= mt_rand(0,9);
$_SESSION['checknum'] = $checknum;

$message = "";
if(isset($_GET["message"])){
    if($_GET["message"]=="name_exists"){
        $message = "用户名已存在，请重新选择！";
    }else if($_GET["message"]=="checknum_error"){
        $message = "验证码错误，请重新输入！";
    }else if($_GET["message"]=="password_mismatch"){
        $message = "两次密码输入不一致！";
    }else if($_GET["message"]=="register_success"){
        $message = "注册成功！欢迎进入系统。";
    }else if($_GET["message"]=="fail"){
        $message = "注册失败，请稍后重试！";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<title>用户注册 - 新闻发布系统</title>
<link rel="stylesheet" href="css/news.css" type="text/css">
</head>
<body>
<div id="container">
    <div id="header">
        <div id="menu">
            <div class="site-logo">新闻发布系统</div>
            <ul>
                <li><a href="index.php">首页</a></li>
                <li class="menudiv"></li>
                <li><a href="index.php?url=review_list.php">评论管理</a></li>
                <li class="menudiv"></li>
                <li><a href="index.php?url=news_add.php">发布新闻</a></li>
                <li class="menudiv"></li>
                <li><a href="index.php">返回首页</a></li>
            </ul>
        </div>
        <div id="banner"></div>
    </div>
    <div id="pagebody">
        <div id="mainbody" style="width:100%; float:none; margin:0 auto;">
            <div id="mainfunction">
                <div class="card">
                    <h2 class="card-title">用户注册</h2>
                    <?php if(!empty($message)): ?>
                        <div class="message <?php echo ($_GET["message"]=="register_success")?"message-success":"message-error"; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!isset($_GET["message"]) || $_GET["message"]!="register_success"): ?>
                    <form action="register_process.php" method="post" class="form-container">
                        <div class="form-group">
                            <label class="form-label">用户名</label>
                            <input type="text" name="name" class="form-input" placeholder="请输入用户名" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">密码</label>
                            <input type="password" name="password" class="form-input" placeholder="请输入密码" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">确认密码</label>
                            <input type="password" name="password2" class="form-input" placeholder="请再次输入密码" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">验证码</label>
                            <div class="checknum-row">
                                <input type="text" name="checknum" class="form-input" style="width:120px;" placeholder="请输入验证码" required>
                                <span class="checknum-display"><?php echo $checknum;?></span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="注册" class="btn btn-primary">
                            <a href="index.php" class="btn btn-secondary">返回首页</a>
                        </div>
                    </form>
                    <div class="form-footer">
                        已有账号？<a href="index.php">立即登录</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div id="footer">
        <a href="">系统首页</a>
        <a href="">联系我们</a>
        <a href="">相关法规</a>
        <a href="">举报违法信息</a>
        <br><br>公司版权所有
    </div>
</div>
</body>
</html>

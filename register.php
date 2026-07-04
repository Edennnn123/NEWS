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
        $message = "用户名已存在，请重新选择";
    }else if($_GET["message"]=="checknum_error"){
        $message = "验证码错误，请重新输入！";
    }else if($_GET["message"]=="password_mismatch"){
        $message = "两次密码输入不一致！";
    }else if($_GET["message"]=="register_success"){
        $message = "注册成功，欢迎进入系统！";
    }else if($_GET["message"]=="fail"){
        $message = "注册失败，请稍后重试！";
    }
}
?><!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>用户注册 - 新闻发布系统</title>
<link rel="stylesheet" href="css/news.css" type="text/css">
</head>
<body>
<div class="site">

  <header class="header">
    <a href="index.php" class="logo">新闻发布系统</a>
    <nav class="nav">
      <a href="index.php">首页</a>
<?php if(is_login()){ ?>
      <a href="index.php?url=news_add.php">发布</a>
      <a href="index.php?url=review_list.php">评论</a>
<?php } ?>
    </nav>
    <div class="header-user">
<?php if(is_login()){ ?>
      <span class="user-welcome"><strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong></span>
      <a href="logout.php" class="logout-link">退出</a>
<?php } ?>
    </div>
  </header>

  <main class="main">
    <div class="card">
      <h2 class="card-title">用户注册</h2>
<?php if(!empty($message)){ ?>
      <div class="message <?php echo ($_GET["message"]=="register_success")?"message-success":"message-error"; ?>">
        <?php echo $message; ?>
      </div>
<?php } ?>
<?php if(!isset($_GET["message"]) || $_GET["message"]!="register_success"){ ?>
      <form action="register_process.php" method="post">
        <div class="form-group">
          <label class="form-label">用户名</label>
          <input type="text" name="name" class="form-input" placeholder="输入用户名" required>
        </div>
        <div class="form-group">
          <label class="form-label">密码</label>
          <input type="password" name="password" class="form-input" placeholder="输入密码" required>
        </div>
        <div class="form-group">
          <label class="form-label">确认密码</label>
          <input type="password" name="password2" class="form-input" placeholder="再次输入密码" required>
        </div>
        <div class="form-group">
          <label class="form-label">验证码</label>
          <div class="checknum-row">
            <input type="text" name="checknum" class="form-input" style="width:100px;" placeholder="输入验证码" required>
            <span class="checknum-display"><?php echo $checknum;?></span>
          </div>
        </div>
        <div class="form-actions">
          <input type="submit" value="注册" class="btn btn-primary">
          <a href="index.php" class="btn btn-secondary">返回首页</a>
        </div>
      </form>
      <div class="form-footer">
        已有账号？<a href="index.php">返回登录</a>
      </div>
<?php } ?>
    </div>
  </main>

  <footer class="footer">
    <a href="index.php">首页</a>
    <a href="#">关于</a>
    <a href="#">联系</a>
  </footer>

</div>
</body>
</html>
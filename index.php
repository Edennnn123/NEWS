<?php
session_start();
include_once("functions/is_login.php");
?><!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>新闻发布系统</title>
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
<?php } else { ?>
      <span class="header-login-trigger" onclick="this.style.display='none';document.getElementById('loginArea').style.display='block'">登录</span>
<?php } ?>
    </div>
  </header>

  <main class="main">
<?php
$allowed_pages = array(
    "news_list.php",
    "news_detail.php",
    "news_add.php",
    "news_edit.php",
    "news_delete.php",
    "review_list.php",
    "review_news_list.php",
);
$url = "news_list.php";
if(isset($_GET["url"]) && in_array($_GET["url"], $allowed_pages)){
    $url = $_GET["url"];
}
if(!is_login() && $url == "news_list.php"){
    echo '<div class="login-section" id="loginArea">' . "\n";
    echo '  <h2>登录</h2>' . "\n";
    include_once("login.php");
    echo '</div>' . "\n";
}
include_once($url);
?>
  </main>

  <footer class="footer">
    <a href="index.php">首页</a>
    <a href="#">关于</a>
    <a href="#">联系</a>
  </footer>

</div>
</body>
</html>

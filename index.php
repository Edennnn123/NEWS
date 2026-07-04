<?php
session_start();
include_once("functions/is_login.php");
?><!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>���ŷ���ϵͳ</title>
<link rel="stylesheet" href="css/news.css" type="text/css">
</head>
<body>
<div class="site">

  <header class="header">
    <a href="index.php" class="logo">���ŷ���ϵͳ</a>
    <nav class="nav">
      <a href="index.php">��ҳ</a>
<?php if(is_login()){ ?>
      <a href="index.php?url=news_add.php">����</a>
      <a href="index.php?url=review_list.php">����</a>
<?php } ?>
    </nav>
    <div class="header-user">
<?php if(is_login()){ ?>
      <span class="user-welcome"><strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong></span>
      <a href="logout.php" class="logout-link">�˳�</a>
<?php } else { ?>
      <span class="header-login-trigger" onclick="this.style.display='none';document.getElementById('loginArea').style.display='block'">��¼</span>
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
);
$url = "news_list.php";
if(isset($_GET["url"]) && in_array($_GET["url"], $allowed_pages)){
    $url = $_GET["url"];
}
if(!is_login() && $url == "news_list.php"){
    echo '<div class="login-section" id="loginArea">' . "\n";
    echo '  <h2>��¼</h2>' . "\n";
    include_once("login.php");
    echo '</div>' . "\n";
}
include_once($url);
?>
  </main>

  <footer class="footer">
    <a href="index.php">��ҳ</a>
    <a href="#">����</a>
    <a href="#">��ϵ</a>
  </footer>

</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="gbk">
<title>欢迎访问新闻发布系统</title>
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
     			</ul>
     		</div>
     		<div id="banner">新闻发布系统</div>
     </div>
     <div id="pagebody">
     		<div id="sidebar">
     			<div id="login">
     				<div class="card">
     				<br>
     				<?php
     				include_once("login.php");
     				?>
     				</div>
     			</div>
     		</div>
     		<div id="mainbody">
     			<div id="mainfunction">
     				<br>
     				<?php
     					$allowed_pages = [
     						"news_list.php",
     						"news_detail.php",
     						"news_add.php",
     						"news_edit.php",
     						"news_delete.php",
     						"review_list.php",
     						"review_news_list.php",
     						"news_list_1.php",
     						"news_list_2.php",
     						"review_list_1.php",
     					];
     					$url = "news_list.php";
     					if(isset($_GET["url"]) && in_array($_GET["url"], $allowed_pages)){
     						$url = $_GET["url"];
     					}
     					include_once($url);
     				?>
     			</div>
     		</div>
     		<div style="clear:both;">
     		</div>
     </div>
     <div id="footer">
     		<a href="index.php">系统首页</a>
     		<a href="">联系我们</a>
     		<a href="">相关法规</a>
     		<a href="">举报违法信息</a>
     		<br><br>公司版权所有
     </div>
</div>
</body>
</html>
<script>
var sidebarHeight = document.getElementById("sidebar").clientHeight;
var mainbodyHeight = document.getElementById("mainbody").clientHeight;
if(sidebarHeight<500&&mainbodyHeight<500){
     document.getElementById("sidebar").style.height="500px";
     document.getElementById("mainbody").style.height="500px";
}else{
     if(sidebarHeight<mainbodyHeight){
     		document.getElementById("sidebar").style.height=mainbodyHeight+"px";
     }else{


     		document.getElementById("mainbody").style.height=sidebarHeight+"px";
     }
}
</script>

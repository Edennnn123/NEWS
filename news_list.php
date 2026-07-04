<div class="card">
<h2 class="card-title">新闻列表</h2>

<?php
include_once("functions/database.php");
include_once("functions/page.php");
include_once("functions/is_login.php");
if (!session_id()){
    session_start();
}
if(isset($_GET["message"])){
    echo '<div class="message message-success">' . htmlspecialchars($_GET["message"]) . '</div>';
}
$keyword = "";
$search_sql = "select * from news order by news_id desc";
if(isset($_GET["keyword"])){
    $keyword = trim(escape_string($_GET["keyword"]));
    $search_sql = "select * from news where title like '%$keyword%' or content like '%$keyword%' order by news_id desc";
}
?>

<form action="index.php?url=news_list.php" method="get" class="search-bar">
    <input type="hidden" name="url" value="news_list.php">
    <input type="text" name="keyword" class="form-input" placeholder="搜索新闻..." value="<?php echo $keyword?>">
    <input type="submit" value="搜索" class="btn btn-primary">
</form>

<?php
get_connection();
$result_news = mysqli_query($GLOBALS['database_connection'], $search_sql);
$total_records = mysqli_num_rows($result_news);
$page_size = 3;
if(isset($_GET["page_current"])){
    $page_current = intval($_GET["page_current"]);
}else{
    $page_current = 1;
}
$start = ($page_current - 1) * $page_size;
$search_sql = "select * from news order by news_id desc limit $start,$page_size";
if(isset($_GET["keyword"])){
    $keyword = trim(escape_string($_GET["keyword"]));
    $search_sql = "select * from news where title like '%$keyword%' or content like '%$keyword%' order by news_id desc limit $start,$page_size";
}
$result_set = mysqli_query($GLOBALS['database_connection'], $search_sql);
close_connection();
if(mysqli_num_rows($result_set) == 0){
    echo "<div class=\"empty-state\">暂无记录</div>";
}else{
    echo "<ul class=\"news-list\">";
    while($row = mysqli_fetch_array($result_set)){
?>
    <li class="news-item">
        <div class="news-item-title">
            <a href="index.php?url=news_detail.php&keyword=<?php echo $keyword?>&news_id=<?php echo $row['news_id']?>">
                <?php echo mb_strcut($row['title'], 0, 40, "gbk")?>
            </a>
        </div>
<?php if(is_login()){ ?>
        <div class="news-item-actions">
            <a href="index.php?url=news_edit.php&news_id=<?php echo $row['news_id']?>">编辑</a>
            <a href="index.php?url=news_delete.php&news_id=<?php echo $row['news_id']?>" onclick="return confirm('确认删除？');">删除</a>
        </div>
<?php } ?>
    </li>
<?php
    }
    echo "</ul>";
}
?>

<div class="pagination">
<?php
$url = $_SERVER["PHP_SELF"] . "?url=news_list.php";
page($total_records, $page_size, $page_current, $url, $keyword);
?>
</div>
</div>

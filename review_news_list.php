<div class="card">
<?php
include_once("functions/database.php");
$news_id = intval($_GET["news_id"]);
$sql = "select * from review where news_id=$news_id and state='已审核' order by review_id desc";
get_connection();
$result_set = mysqli_query($GLOBALS['database_connection'], $sql);
close_connection();
echo "<h2 class='card-title'>该新闻的评论如下：</h2>";
if(mysqli_num_rows($result_set)==0){
    echo "<div style='color:#94A3B8;'>暂无评论</div>";
}
while($row = mysqli_fetch_array($result_set)){
?>
<div class="review-item">
    <div class="review-content"><?php echo $row["content"];?></div>
    <div class="review-meta">评论时间：<?php echo $row["publish_time"];?> &middot; IP地址：<?php echo $row["ip"];?></div>
</div>
<?php
}
?>
</div>

<div class="card">
<?php
include_once("functions/database.php");
$news_id = intval($_GET["news_id"]);
$sql_news_update = "update news set clicked=clicked+1 where news_id=$news_id";
$sql_news_detail = "select * from news where news_id=$news_id";
$sql_review_query = "select * from review where news_id=$news_id and state='已审'";
get_connection();
mysqli_query($GLOBALS['database_connection'], $sql_news_update);
$result_news = mysqli_query($GLOBALS['database_connection'], $sql_news_detail);
$result_review = mysqli_query($GLOBALS['database_connection'], $sql_review_query);
$count_news = mysqli_num_rows($result_news);
$count_review = mysqli_num_rows($result_review);
if($count_news == 0){
    echo '<div class="message message-error">该新闻不存在或已被删除</div>';
    exit;
}
$news = mysqli_fetch_array($result_news);
$user_id = $news["user_id"];
$sql_user = "select * from users where user_id=$user_id";
$result_user = mysqli_query($GLOBALS['database_connection'], $sql_user);
$user = mysqli_fetch_array($result_user);
$category_id = $news["category_id"];
$sql_category = "select * from category where category_id=$category_id";
$result_category = mysqli_query($GLOBALS['database_connection'], $sql_category);
$category = mysqli_fetch_array($result_category);
close_connection();
mysqli_free_result($result_user);
mysqli_free_result($result_category);
mysqli_free_result($result_news);
mysqli_free_result($result_review);
$title = $news['title'];
$content = $news['content'];
if(isset($_GET["keyword"])){
    $keyword = escape_string($_GET["keyword"]);
    $replacement = "<b><i>".$keyword."</b></i>";
    $title = str_replace($keyword, $replacement, $title);
    $content = str_replace($keyword, $replacement, $content);
}
?>

<div class="news-detail-title"><?php echo $title;?></div>
<div class="news-meta">
    <span>作者：<?php echo $user['name'];?></span>
    <span>分类：<?php echo $category['name'];?></span>
    <span>发布时间：<?php echo $news['publish_time'];?></span>
    <span>点击：<?php echo $news['clicked'];?></span>
</div>

<div class="news-content">
    <?php echo $content;?>
</div>

<?php if(!empty($news['attachment'])){ ?>
<div class="attachment-link">
    <a href="download.php?attachment=<?php echo urlencode($news['attachment']);?>">下载附件：<?php echo $news['attachment'];?></a>
</div>
<?php } ?>

<div class="review-section">
    <h3>评论 (<?php echo $count_review;?>)</h3>
<?php
if($count_review > 0){
    $sql_review = "select * from review where news_id=$news_id and state='已审' order by review_id desc";
    get_connection();
    $result_review = mysqli_query($GLOBALS['database_connection'], $sql_review);
    close_connection();
    while($review = mysqli_fetch_array($result_review)){
?>
    <div class="review-item">
        <div class="review-content"><?php echo $review['content'];?></div>
        <div class="review-meta"><?php echo $review['publish_time'];?> &middot; IP: <?php echo $review['ip'];?></div>
    </div>
<?php
    }
}else{
    echo "<div style="color:#999;font-size:13px;margin-bottom:16px;">暂无评论</div>";
}
?>

    <div class="review-form">
        <h3 style="font-size:14px;margin-bottom:12px;">发表评论</h3>
        <form action="review_save.php" method="post">
            <textarea name="content" placeholder="写下你的评论..." style="width:100%;padding:10px 12px;border:1px solid #e8e8e8;font-size:14px;font-family:inherit;resize:vertical;min-height:72px;outline:none;"></textarea>
            <input type="hidden" name="news_id" value="<?php echo $news['news_id'];?>">
            <div style="margin-top:10px;">
                <input type="submit" value="发表评论" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
</div>
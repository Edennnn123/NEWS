<div class="card">
<h2 class="card-title">评论管理</h2>
<?php
include_once("functions/is_login.php");
if (!session_id()){
    session_start();
}
if(!is_login()){
    echo "<div class='message message-error'>请先登录系统再访问此页面！</div>";
    return;
}
include_once("functions/database.php");
include_once("functions/page.php");
$sql = "select * from review";
get_connection();
$result_news = mysqli_query($GLOBALS['database_connection'], $sql);
$total_records = mysqli_num_rows($result_news);
$page_size = 3;
if(isset($_GET["page_current"])){
    $page_current = intval($_GET["page_current"]);
}else{
    $page_current = 1;
}
$start = ($page_current-1)*$page_size;
$result_sql = "select * from review order by review_id desc limit $start,$page_size";
$result_set = mysqli_query($GLOBALS['database_connection'], $result_sql);
close_connection();
if(mysqli_num_rows($result_set)==0){
    echo "<div style='text-align:center;padding:20px;color:#94A3B8;'>暂无评论</div>";
}
while($row = mysqli_fetch_array($result_set)){
    $state_class = ($row["state"]=="未审核")?"state-pending":"state-approved";
    $state_text = ($row["state"]=="未审核")?"待审核":"已审核";
?>
<div class="review-mgmt-item">
    <div class="review-mgmt-content"><?php echo $row["content"];?></div>
    <div class="review-mgmt-meta">
        <span>时间：<?php echo $row["publish_time"];?></span>
        &nbsp;&nbsp;
        <span>IP：<?php echo $row["ip"];?></span>
        &nbsp;&nbsp;
        <span class="state-badge <?php echo $state_class;?>"><?php echo $state_text;?></span>
    </div>
    <div class="review-mgmt-actions">
        <a href="review_delete.php?review_id=<?php echo $row["review_id"];?>" class="btn btn-danger btn-small">删除</a>
        <?php if($row["state"]=="未审核"){ ?>
        <a href="review_verify.php?review_id=<?php echo $row["review_id"];?>" class="btn btn-primary btn-small">审核通过</a>
        <?php } ?>
    </div>
</div>
<?php
}
?>
<div class="pagination">
<?php
$url = "index.php?url=review_list.php";
page($total_records,$page_size,$page_current,$url,"");
?>
</div>
</div>

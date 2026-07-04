<?php
include_once("functions/is_login.php");
if (!session_id()){
    session_start();
}
if(!is_login()){
    echo "<div class="message message-error">请先登录系统再访问此页面！</div>";
    return;
}
include_once("functions/database.php");
$news_id = intval($_GET["news_id"]);
get_connection();
$result_news = mysqli_query($GLOBALS['database_connection'], "select * from news where news_id=$news_id");
$result_category = mysqli_query($GLOBALS['database_connection'], "select * from category");
close_connection();
$news = mysqli_fetch_array($result_news);
?>
<div class="card">
<h2 class="card-title">编辑新闻</h2>
<form action="news_update.php" method="post">
    <div class="form-group">
        <label class="form-label">标题</label>
        <input type="text" name="title" class="form-input" value="<?php echo $news['title']?>">
    </div>
    <div class="form-group">
        <label class="form-label">内容</label>
<?php
include("fckeditor/fckeditor.php");
$oFCKeditor = new FCKeditor('content');
$oFCKeditor->BasePath = 'fckeditor/';
$oFCKeditor->Width = '100%';
$oFCKeditor->Height = 350;
$oFCKeditor->Value = $news['content'];
$oFCKeditor->ToolbarSet = "Default";
$oFCKeditor->Config['EnterMode'] = 'br';
$oFCKeditor->Create();
?>
    </div>
    <div class="form-group">
        <label class="form-label">分类</label>
        <select name="category_id" class="form-input" style="width:200px;">
<?php
while($category = mysqli_fetch_array($result_category)){
    $selected = ($news['category_id'] == $category['category_id']) ? "selected" : "";
?>
            <option value="<?php echo $category['category_id'];?>" <?php echo $selected;?>><?php echo $category['name'];?></option>
<?php
}
?>
        </select>
    </div>
    <div class="form-actions">
        <input type="hidden" name="news_id" value="<?php echo $news_id?>">
        <input type="submit" value="保存修改" class="btn btn-primary">
        <input type="button" value="取消" class="btn btn-secondary" onclick="window.history.back();">
    </div>
</form>
</div>
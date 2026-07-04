<?php
include_once("functions/is_login.php");
if (!session_id()){
    session_start();
}
if(!is_login()){
    echo "<div class='message message-error'>请先登录系统再访问此页面！</div>";
    return;
}
?>
<div class="card">
<h2 class="card-title">发布新闻</h2>
<form action="news_save.php" method="post" enctype="multipart/form-data" class="form-container" style="max-width:100%;">
    <div class="form-group">
        <label class="form-label">标题</label>
        <input type="text" size="60" name="title" class="form-input" placeholder="请输入新闻标题">
    </div>
    <div class="form-group">
        <label class="form-label">内容</label>
<?php
include("fckeditor/fckeditor.php");
$oFCKeditor = new FCKeditor('content');
$oFCKeditor->BasePath = 'fckeditor/';
$oFCKeditor->Width = 550;
$oFCKeditor->Height = 350;
$oFCKeditor->Value = "请在此输入新闻的内容...";
$oFCKeditor->ToolbarSet = "Default";
$oFCKeditor->Config['EnterMode'] = 'br';
$oFCKeditor->Create();
?>
    </div>
    <div class="form-group">
        <label class="form-label">分类</label>
        <select name="category_id" class="form-input" style="width:200px;">
<?php
include_once("functions/database.php");
get_connection();
$result_set = mysqli_query($GLOBALS['database_connection'], "select * from category");
close_connection();
while($row = mysqli_fetch_array($result_set)){
?>
            <option value="<?php echo $row['category_id'];?>"><?php echo $row['name'];?></option>
<?php
}
?>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">附件上传</label>
        <input type="file" name="news_file" style="font-size:13px;">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
        <div style="font-size:12px;color:#94A3B8;margin-top:4px;">支持文档、图片等格式，最大10MB</div>
    </div>
    <div class="form-actions">
        <input type="submit" value="提交" class="btn btn-primary">
        <input type="reset" value="重置" class="btn btn-secondary">
        <a href="index.php" class="btn btn-secondary">取消</a>
    </div>
</form>
</div>

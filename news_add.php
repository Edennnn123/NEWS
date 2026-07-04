<?php
include_once("functions/is_login.php");
if (!session_id()){
    session_start();
}
if(!is_login()){
    echo '<div class="message message-error">请先登录系统再访问此页面！</div>';
    return;
}
?>
<div class="card">
<h2 class="card-title">发布新闻</h2>
<form action="news_save.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="form-label">标题</label>
        <input type="text" name="title" class="form-input" placeholder="输入新闻标题">
    </div>
    <div class="form-group">
        <label class="form-label">摘要</label>
        <textarea name="summary" class="form-input" rows="3" placeholder="新闻摘要（留空则自动从内容截取）"></textarea>
    </div>
    <div class="form-group">
        <label class="form-label">内容</label>
<?php
include("fckeditor/fckeditor.php");
$oFCKeditor = new FCKeditor('content');
$oFCKeditor->BasePath = 'fckeditor/';
$oFCKeditor->Width = '100%';
$oFCKeditor->Height = 350;
$oFCKeditor->Value = "在此输入新闻内容...";
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
        <label class="form-label">缩略图</label>
        <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/gif,image/bmp">
        <div style="font-size:12px;color:#999;margin-top:4px;">建议尺寸 300x200，仅支持图片格式</div>
    </div>
    <div class="form-group">
        <label class="form-label">附件上传</label>
        <input type="file" name="news_file" style="font-size:13px;">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
        <div style="font-size:12px;color:#999;margin-top:4px;">支持文档和图片格式，最大10MB</div>
    </div>
    <div class="form-group">
        <label class="form-label">
            <input type="checkbox" name="is_top" value="1"> 置顶此新闻
        </label>
    </div>
    <div class="form-actions">
        <input type="submit" value="提交" class="btn btn-primary">
        <input type="reset" value="重置" class="btn btn-secondary">
        <a href="index.php" class="btn btn-secondary">取消</a>
    </div>
</form>
</div>
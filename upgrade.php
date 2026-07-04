<?php
// 数据库升级脚本 - 为 news 表增加摘要、缩略图、置顶字段
include_once("functions/database.php");

get_connection();

$conn = $GLOBALS['database_connection'];

$errors = array();

// 检查字段是否已存在，避免重复添加
$result = mysqli_query($conn, "SHOW COLUMNS FROM news LIKE 'summary'");
if(mysqli_num_rows($result) == 0){
    $sql1 = "ALTER TABLE news ADD COLUMN summary text AFTER content";
    if(mysqli_query($conn, $sql1)){
        echo "? 添加 summary 字段成功<br>\n";
    }else{
        $errors[] = "summary: " . mysqli_error($conn);
    }
}else{
    echo "→ summary 字段已存在<br>\n";
}

$result = mysqli_query($conn, "SHOW COLUMNS FROM news LIKE 'thumbnail'");
if(mysqli_num_rows($result) == 0){
    $sql2 = "ALTER TABLE news ADD COLUMN thumbnail varchar(200) AFTER attachment";
    if(mysqli_query($conn, $sql2)){
        echo "? 添加 thumbnail 字段成功<br>\n";
    }else{
        $errors[] = "thumbnail: " . mysqli_error($conn);
    }
}else{
    echo "→ thumbnail 字段已存在<br>\n";
}

$result = mysqli_query($conn, "SHOW COLUMNS FROM news LIKE 'is_top'");
if(mysqli_num_rows($result) == 0){
    $sql3 = "ALTER TABLE news ADD COLUMN is_top tinyint(1) DEFAULT 0 AFTER thumbnail";
    if(mysqli_query($conn, $sql3)){
        echo "? 添加 is_top 字段成功<br>\n";
    }else{
        $errors[] = "is_top: " . mysqli_error($conn);
    }
}else{
    echo "→ is_top 字段已存在<br>\n";
}

close_connection();

if(count($errors) > 0){
    echo "<br>? 以下字段添加失败：<br>\n";
    foreach($errors as $e){
        echo "&nbsp;&nbsp;" . $e . "<br>\n";
    }
}else{
    echo "<br>? 数据库升级完成！<br>\n";
    echo "<a href='index.php'>返回首页</a>\n";
}
?>

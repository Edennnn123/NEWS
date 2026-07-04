#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import os

# Fix nested double quotes in PHP echo statements
# Change echo "<div class="... to echo '<div class="...

fixes = {
    "news_add.php": [
        ('echo "<div class="message message-error">请先登录系统再访问此页面！</div>";',
         "echo '<div class=\"message message-error\">请先登录系统再访问此页面！</div>';"),
    ],
    "news_edit.php": [
        ('echo "<div class="message message-error">请先登录系统再访问此页面！</div>";',
         "echo '<div class=\"message message-error\">请先登录系统再访问此页面！</div>';"),
    ],
    "review_list.php": [
        ('echo "<div class="message message-error">请先登录系统再访问此页面！</div>";',
         "echo '<div class=\"message message-error\">请先登录系统再访问此页面！</div>';"),
        ('echo "<div class="empty-state">暂无评论</div>";',
         "echo '<div class=\"empty-state\">暂无评论</div>';"),
    ],
    "news_detail.php": [
        ('echo "<div class="message message-error">该新闻不存在或已被删除</div>";',
         "echo '<div class=\"message message-error\">该新闻不存在或已被删除</div>';"),
    ],
}

for path, replacements in fixes.items():
    full = os.path.join("C:/wamp/www/news", path)
    with open(full, 'rb') as f:
        raw = f.read()
    content = raw.decode('gbk')
    for old, new in replacements:
        if old in content:
            content = content.replace(old, new)
            print(f"Fixed: {path}")
        else:
            print(f"Pattern not found in {path}")
    with open(full, 'wb') as f:
        f.write(content.encode('gbk'))

# news_list.php has multiple issues
path = "C:/wamp/www/news/news_list.php"
with open(path, 'rb') as f:
    raw = f.read()
content = raw.decode('gbk')

content = content.replace(
    'echo "<div class="message message-success">".$_GET["message"]."</div>";',
    "echo '<div class=\"message message-success\">'.\$_GET[\"message\"].'</div>';"
)
content = content.replace(
    'echo "<div class="empty-state">暂无记录</div>";',
    "echo '<div class=\"empty-state\">暂无记录</div>';"
)
content = content.replace(
    'echo "<ul class="news-list">";',
    "echo '<ul class=\"news-list\">';"
)
with open(path, 'wb') as f:
    f.write(content.encode('gbk'))
print("Fixed: news_list.php")

print("\nAll done!")

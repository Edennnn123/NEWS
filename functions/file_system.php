<?php
function upload($file,$file_path){
     $error = $file['error'];
     switch ($error){
     		case 0:
     			$file_name = $file['name'];
     			// 检查文件扩展名白名单
     			$ext = strtolower(extension_name($file_name));
     			$allowed_exts = array("jpg","jpeg","png","gif","bmp","pdf","doc","docx","xls","xlsx","ppt","pptx","txt","rtf","zip","rar");
     			if(!in_array($ext, $allowed_exts)){
     				return "文件类型不允许上传，仅支持图片、文档和压缩包格式";
     			}
     			$file_temp = $file['tmp_name'];
     			$destination = $file_path."/".$file_name;
     			move_uploaded_file($file_temp,$destination);
     			return "文件上传成功！";
     		case 1:
     			return "上传文件的大小超过php.ini中upload_max_filesize选项限制的值！";
     		case 2:
     			return "上传文件的大小超过form表单中MAX_FILE_SIZE选项指定的值！";
     		case 3:
     			return "文件只有部分被上传！";
     		case 4:
     			return "没有选择上传文件！";
     }
}
function extension_name($file_name){
     $extension = explode(".",$file_name);
     $key = count($extension)-1;
     return $extension[$key];
}
function content_type($extension){
     $mime_types = array(
     		'txt' => 'text/plain',
     		'htm' => 'text/html',
     		'html' => 'text/html',
     		'php' => 'text/html',
     		'css' => 'text/css',
     		'js' => 'application/javascript',
     		'xml' => 'application/xml',
     		'swf' => 'application/x-shockwave-flash',
     		'flv' => 'video/x-flv',
     		// images
     		'png' => 'image/png',
     		'jpe' => 'image/jpeg',
     		'jpeg' => 'image/jpeg',
     		'jpg' => 'image/jpeg',
     		'gif' => 'image/gif',
     		'bmp' => 'image/bmp',
     		'ico' => 'image/vnd.microsoft.icon',
     		// archives
     		'zip' => 'application/zip',
     		'rar' => 'application/x-rar-compressed',
     		'exe' => 'application/x-msdownload',
     		// audio/video
     		'mp3' => 'audio/mpeg',
     		'qt' => 'video/quicktime',
     		'mov' => 'video/quicktime',
     		// adobe
     		'pdf' => 'application/pdf',
     		// ms office
     		'doc' => 'application/msword',
     		'rtf' => 'application/rtf',
     		'xls' => 'application/vnd.ms-excel',
     		'ppt' => 'application/vnd.ms-powerpoint'
     );
     if(array_key_exists($extension,$mime_types)){
     		return $mime_types["$extension"];
     }else{
     		return "application/octet-stream";
     }
}
function download($file_dir,$file_name){
     if (!file_exists($file_dir.$file_name)) { //检查文件是否存在
     		exit("文件不存在或已被删除");
     } else {
     		$file = fopen($file_dir.$file_name,"r"); // 打开文件
     		//取出文件扩展名
     		$extension_name = extension_name($file_name);
     		//根据扩展名取得文件的MIME类型
     		$content_type = content_type($extension_name);
     		//发送指定给浏览器信息以打开方式
     		header("Content-Type:$content_type");
     		//强制显示下载对话框，并提供一个推荐的文件名
     		header("Content-Disposition: attachment; filename=".$file_name);
     		// 输出文件大小
     		echo fread($file,filesize($file_dir.$file_name));
     		fclose($file);
     		exit;
     }
}

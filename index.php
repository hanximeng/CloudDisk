<!--
寒曦朦文件系统
作者：寒曦朦
作者博客：https://hanximeng.com

核心代码及创意来自：https://github.com/TrainTsang/CloudDisk
原作者：TrainTsang

前端框架：MDUI (https://www.mdui.org/)
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>寒曦朦文件系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<link rel="shortcut icon" href="https://q1.qlogo.cn/g?b=qq&amp;nk=1017959770&amp;s=640" type="image/x-icon"/>
	<!-- 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/mdui/0.4.3/css/mdui.min.css"/>
	<!-- 核心 JS 文件 -->
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/mdui/0.4.3/js/mdui.min.js"></script>
</head>
<style>
.mdui-list-item-content {
    margin-left: 16px;
}
</style>
<body style="padding-top: 20px;background: url(https://tva1.sinaimg.cn/large/007X8olVly1g7ioblp83kj31hc0u0jw7.jpg) no-repeat center center fixed;">
	<div class="mdui-container mdui-shadow-5" style="background: rgba(255, 255, 255, 0.8);border-radius: 10px;">
		<div class="container" style="padding:15px">
			<ul class="mdui-list">
				<li class='mdui-list-item mdui-ripple' onclick="location.href='./'"><i class='mdui-list-item-avatar mdui-icon material-icons mdui-color-blue mdui-text-color-white'>home</i><div class='mdui-list-item-content'><a>根目录</a></li>
<?php
error_reporting(0);
$dir = empty($_REQUEST["dir"]) ? __DIR__ : $_REQUEST["dir"];
function getfiles($path)
{
    $file = [];
    $tmp = [];
    foreach (scandir($path) as $afile) {
        if ($afile == '.' || $afile == '..' || $afile == '.idea'|| strpos($afile, '.php') || strpos($afile, '.html') || strpos($afile, '.ini')) continue;//过滤文件及文件夹
        if (is_dir($path . '/' . $afile)) {
            $tmp['type'] = 'dir';
        } else {
            $tmp['type'] = 'file';
        }
        $tmp['dirtext'] = $path . '/' . $afile;
        $tmp['filename'] = $afile;
        $tmp['dirtext2'] = str_replace(__DIR__ . '/', '', $path . '/' . $afile);
        $file[] = $tmp;
    }
    return $file;
}
$data = getfiles($dir);
for ($x='0'; $x<count($data); $x++) {
		if($data[$x][type] !== 'dir' ){
			echo "				<li class='mdui-list-item mdui-ripple' onclick=\"location.href='".$data[$x]['dirtext']."'\"><i class='mdui-list-item-avatar mdui-icon material-icons mdui-color-blue mdui-text-color-white'>insert_drive_file</i><div class='mdui-list-item-content'> <a>".$data[$x]['filename']."</a></li>\n";
		}else{
			echo "				<li class='mdui-list-item mdui-ripple' onclick=\"location.href='?dir=".$data[$x]['dirtext2']."'\"><a><i class='mdui-list-item-avatar mdui-icon material-icons mdui-color-blue mdui-text-color-white'>folder</i><div class='mdui-list-item-content'>".$data[$x]['filename']."</a></div></li>\n";
		}
}
?>
			</ul>
		</div>
	</div>
</body>
</html>
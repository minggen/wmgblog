<?php
echo <<<EOT
{
	"contentManagement": [
		{
			"title": "文章列表",
			"icon": "icon-text",
			"href": "page/news/newsList.php",
			"spread": false
		},
		{
			"title": "图片管理",
			"icon": "&#xe634;",
			"href": "page/img/images.php",
			"spread": false
		},
		{
			"title": "用户中心",
			"icon": "&#xe612;",
			"href": "page/user/userList.php",
			"spread": false
		},
		{
			"title": "系统基本参数",
			"icon": "&#xe631;",
			"href": "page/systemSetting/basicParameter.php",
			"spread": false
		},{
			"title": "系统日志",
			"icon": "icon-log",
			"href": "page/systemSetting/logs.php",
			"spread": false
		},{
			"title": "友情链接",
			"icon": "&#xe64c;",
			"href": "page/systemSetting/linkList.php",
			"spread": false
		}
	]
}



EOT;
?>
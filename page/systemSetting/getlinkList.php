<?php

require_once dirname(__FILE__)."/../../model/link_model.php";
$linkmodel = new link_model();


$logs = $linkmodel->getAllLink();

$res =array(
    "code"=>0,
    "msg"=>"",
    "count"=>count($logs),
    "data"=>$logs
);

echo json_encode($res);

// echo <<<EOT
// {
// 	"code": 0,
// 	"msg": "",
// 	"count": 4,
// 	"data": [
// 		{
// 			"linkId": "1",
// 			"logo": "../../images/layui.png",
// 			"websiteName": "layui - 经典模块化前端框架",
// 			"websiteUrl": "http://www.layui.com",
// 			"masterEmail": "xianxin@layui.com",
// 			"addTime": "2017-05-14",
// 			"showAddress": "checked"
// 		},{
// 			"linkId": "2",
// 			"logo": "../../images/fly.png",
// 			"websiteName": "fly - 前端框架官方社区",
// 			"websiteUrl": "http://fly.layui.com",
// 			"masterEmail": "xianxin@layui.com",
// 			"addTime": "2017-05-14",
// 			"showAddress": ""
// 		},{
// 			"linkId": "3",
// 			"logo": "../../images/mayun.png",
// 			"websiteName": "layuicms2.0 - 码云 - 开源中国",
// 			"websiteUrl": "https://gitee.com/layuicms/layuicms2.0",
// 			"masterEmail": "git@oschina.cn",
// 			"addTime": "2017-05-14",
// 			"showAddress": ""
// 		},{
// 			"linkId": "4",
// 			"logo": "../../images/git.png",
// 			"websiteName": "layuicms2.0 - Github",
// 			"websiteUrl": "https://github.com/BrotherMa/layuiCMS2.0",
// 			"masterEmail": "github@github.cn",
// 			"addTime": "2017-05-14",
// 			"showAddress": ""
// 		}
// 	]
// }
// EOT;

// ?>
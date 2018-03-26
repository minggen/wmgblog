<?php 
require_once dirname(__FILE__)."/../../model/log_model.php";
$logmodel = new Log_Model();
$logs = $logmodel->getAllLogs();

$res =array(
    "code"=>0,
    "msg"=>"",
    "count"=>count($logs),
    "data"=>$logs
);

echo json_encode($res);
/* echo <<<EOF
{"code":0,"msg":"","count":8,"data":[{"newsId":"1","newsName":"css3用transition实现边框动画效果","newsAuthor":"admin","abstract":"css3用transition实现边框动画效果css3用transition实现边框动画效果","newsStatus":"0","newsImg":"../../images/userface1.jpg","newsLook":"开放浏览","newsTop":"","newsTime":"2017-04-14 00:00:00","content":"css3用transition实现边框动画效果<img src='../../images/userface1.jpg' alt='文章内容图片'>css3用transition实现边框动画效果css3用transition实现边框动画效果"},{"newsId":"2","newsName":"自定义的模块名称可以包含/吗","newsAuthor":"admin","abstract":"自定义的模块名称可以包含/吗自定义的模块名称可以包含/吗","newsStatus":"1","newsImg":"../../images/userface2.jpg","newsLook":"私密浏览","newsTop":"checked","newsTime":"2017-04-14 00:00:00","content":"自定义的模块名称可以包含自定义的模块名称可<img src='../../images/userface2.jpg' alt='文章内容图片'>以包含自定义的模块名称可以包含自定义的模块名称可以包含"},{"newsId":"3","newsName":"layui.tree如何ajax加载二级菜单","newsAuthor":"admin","abstract":"layui.tree如何ajax加载二级菜单layui.tree如何ajax加载二级菜单","newsStatus":"2","newsImg":"../../images/userface3.jpg","newsLook":"开放浏览","newsTop":"checked","newsTime":"2017-04-14 00:00:00","content":"layui.tree如何ajax加载二级菜单layui.tree如何<img src='../../images/userface3.jpg' alt='文章内容图片'>ajax加载二级菜单layui.tree如何ajax加载二级菜单"},{"newsId":"4","newsName":"layui.upload如何带参数？像jq的data:{}那样","newsAuthor":"admin","abstract":"layui.upload如何带参数？像jq的data:{}那样layui.upload如何带参数？像jq的data:{}那样","newsStatus":"0","newsImg":"../../images/userface4.jpg","newsLook":"私密浏览","newsTop":"","newsTime":"2017-04-14 00:00:00","content":"layui.upload如何带参数？像jq的data:{}那样layui.upload如何带参数？像jq的data:{}那样layui.upload如何带参数？像jq的data:{}那样"},{"newsId":"5","newsName":"表单元素长度应该怎么调整才美观","newsAuthor":"admin","abstract":"表单元素长度应该怎么调整才美观表单元素长度应该怎么调整才美观","newsStatus":"1","newsImg":"../../images/userface5.jpg","newsLook":"开放浏览","newsTop":"checked","newsTime":"2017-04-14 00:00:00","content":"表单元素长度应该怎么调整才美观表单元素长度应该怎么调整才美观表单元素长度应该怎么调整才美观表单元素长度应该怎么调整才美观"},{"newsId":"6","newsName":"layui 利用ajax冲获取到json 数据后 怎样进行渲染","newsAuthor":"admin","abstract":"layui 利用ajax冲获取到json 数据后 怎样进行渲染layui 利用ajax冲获取到json 数据后 怎样进行渲染","newsStatus":"0","newsImg":"../../images/userface1.jpg","newsLook":"私密浏览","newsTop":"checked","newsTime":"2017-04-14 00:00:00","content":"layui 利用ajax冲获取到json 数据后 怎样进行渲染layui 利用ajax冲获取到json 数据后 怎样进行渲染layui 利用ajax冲获取到json 数据后 怎样进行渲染"},{"newsId":"7","newsName":"微信页面中富文本编辑器LayEdit无法使用","newsAuthor":"admin","abstract":"微信页面中富文本编辑器LayEdit无法使用微信页面中富文本编辑器LayEdit无法使用","newsStatus":"1","newsImg":"../../images/userface2.jpg","newsLook":"开放浏览","newsTop":"","newsTime":"2017-04-14 00:00:00","content":"微信页面中富文本编辑器LayEdit无法使用微信页面中富文本编辑器LayEdit无法使用微信页面中富文本编辑器LayEdit无法使用"},{"newsId":"8","newsName":"layui 什么时候发布新的版本呀","newsAuthor":"admin","abstract":"layui 什么时候发布新的版本呀layui 什么时候发布新的版本呀","newsStatus":"2","newsImg":"../../images/userface3.jpg","newsLook":"私密浏览","newsTop":"checked","newsTime":"2017-04-14 00:00:00","content":"layui 什么时候发布新的版本呀layui 什么时候发布新的版本呀layui 什么时候发布新的版本呀layui 什么时候发布新的版本呀"}]}
EOF; */
?>
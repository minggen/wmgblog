<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>系统基本参数</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="../../layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="../../css/public.css" media="all" />
</head>
<body class="childrenBody">
	<form class="layui-form">
		<table class="layui-table mag0">
			<colgroup>
				<col width="25%">
				<col width="45%">
				<col>
		    </colgroup>
		    <thead>
		    	<tr>
		    		<th>参数说明</th>
		    		<th>参数值</th>
		    		<th pc>变量名</th>
		    	</tr>
		    </thead>
		    <tbody>
		    	<tr>
		    		<td>网站名称</td>
		    		<td><input type="text" class="layui-input cmsName" lay-verify="required" placeholder="请输入模版名称"></td>
		    		<td pc>cmsName</td>
		    	</tr>
		    	<tr>
		    		<td>当前版本</td>
		    		<td><input type="text" class="layui-input version" placeholder="请输入当前模版版本"></td>
		    		<td pc>version</td>
		    	</tr>
		    	<tr>
		    		<td>开发作者</td>
		    		<td><input type="text" class="layui-input author" placeholder="请输入开发作者"></td>
		    		<td pc>author</td>
		    	</tr>
		    	<tr>
		    		<td>网站首页</td>
		    		<td><input type="text" class="layui-input homePage" placeholder="请输入网站首页"></td>
		    		<td pc>homePage</td>
		    	</tr>
		    	<tr>
		    		<td>服务器环境</td>
		    		<td><input type="text" class="layui-input server" placeholder="请输入服务器环境"></td>
		    		<td pc>server</td>
		    	</tr>
		    	<tr>
		    		<td>数据库版本</td>
		    		<td><input type="text" class="layui-input dataBase" placeholder="请输入数据库版本"></td>
		    		<td pc>dataBase</td>
		    	</tr>
		    	<tr>
		    		<td>最大上传限制</td>
		    		<td><input type="text" class="layui-input maxUpload" placeholder="请输入最大上传限制"></td>
		    		<td pc>maxUpload</td>
		    	</tr>
		    	<tr>
		    		<td>用户权限</td>
		    		<td><input type="text" class="layui-input userRights" placeholder="请输入当前用户权限"></td>
		    		<td pc>userRights</td>
		    	</tr>
		    	<tr>
		    		<td>默认关键字</td>
		    		<td><input type="text" class="layui-input keywords" placeholder="请输入默认关键字"></td>
		    		<td pc>keywords</td>
		    	</tr>
		    	<tr>
		    		<td>版权信息</td>
		    		<td><input type="text" class="layui-input powerby" placeholder="请输入网站版权信息"></td>
		    		<td pc>powerby</td>
		    	</tr>
		    	<tr>
		    		<td>网站描述</td>
		    		<td><textarea placeholder="请输入网站描述" class="layui-textarea description"></textarea></td>
		    		<td pc>description</td>
		    	</tr>
		    	<tr>
		    		<td>网站备案号</td>
		    		<td><input type="text" class="layui-input record" placeholder="请输入网站备案号"></td>
		    		<td pc>record</td>
		    	</tr>
		    </tbody>
		</table>
		<div class="magt10 layui-right">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="systemParameter">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="../../layui/layui.js"></script>
	<script type="text/javascript">
	layui.use(['form','layer','jquery'],function(){
		var form = layui.form,
			layer = parent.layer === undefined ? layui.layer : top.layer,
			laypage = layui.laypage,
			$ = layui.jquery;

	 	var systemParameter;
	 	form.on("submit(systemParameter)",function(data){
	 		systemParameter = '{"cmsName":"'+$(".cmsName").val()+'",';  //模版名称
	 		systemParameter += '"version":"'+$(".version").val()+'",';	 //当前版本
	 		systemParameter += '"author":"'+$(".author").val()+'",'; //开发作者
	 		systemParameter += '"homePage":"'+$(".homePage").val()+'",'; //网站首页
	 		systemParameter += '"server":"'+$(".server").val()+'",'; //服务器环境
	 		systemParameter += '"dataBase":"'+$(".dataBase").val()+'",'; //数据库版本
	 		systemParameter += '"maxUpload":"'+$(".maxUpload").val()+'",'; //最大上传限制
	 		systemParameter += '"userRights":"'+$(".userRights").val()+'",'; //用户权限
	 		systemParameter += '"description":"'+$(".description").val()+'",'; //站点描述
	 		systemParameter += '"powerby":"'+$(".powerby").val()+'",'; //版权信息
	 		systemParameter += '"record":"'+$(".record").val()+'",'; //网站备案号
	 		systemParameter += '"keywords":"'+$(".keywords").val()+'"}'; //默认关键字
	 		window.sessionStorage.setItem("systemParameter",systemParameter);
	 		//弹出loading
	 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
	        setTimeout(function(){
	            layer.close(index);
				layer.msg("系统基本参数修改成功！");
	        },500);
	 		return false;
	 	})


	 	//加载默认数据
	 	if(window.sessionStorage.getItem("systemParameter")){
	 		var data = JSON.parse(window.sessionStorage.getItem("systemParameter"));
	 		fillData(data);
	 	}else{
	 		$.ajax({
				url : "systemParameter.php",
				type : "get",
				dataType : "json",
				success : function(data){
					fillData(data);
				}
			})
	 	}

	 	//填充数据方法
	 	function fillData(data){
	 		$(".version").val(data.version);      //当前版本
			$(".author").val(data.author);        //开发作者
			$(".homePage").val(data.homePage);    //网站首页
			$(".server").val(data.server);        //服务器环境
			$(".dataBase").val(data.dataBase);    //数据库版本
			$(".maxUpload").val(data.maxUpload);  //最大上传限制
			$(".userRights").val(data.userRights);//当前用户权限
			$(".cmsName").val(data.cmsName);      //模版名称
			$(".description").val(data.description);//站点描述
			$(".powerby").val(data.powerby);      //版权信息
			$(".record").val(data.record);      //网站备案号
			$(".keywords").val(data.keywords);    //默认关键字
	 	}
	 	
	})

	</script>
	<script type="text/javascript" src="../../js/cache.js"></script>
</body>
</html>
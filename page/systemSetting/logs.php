<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>系统日志--layui后台管理模板 2.0</title>
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

	<table id="logs" lay-filter="logs"></table>

	<script type="text/javascript" src="../../layui/layui.js"></script>
	<script type="text/javascript" >
	layui.use(['table'],function(){
		var table = layui.table;

		//系统日志
	    table.render({
	        elem: '#logs',
	        url : 'getlogs.php',
	        cellMinWidth : 95,
	        page : true,
	        height : "full-20",
	        limit : 20,
	        limits : [10,15,20,25],
	        id : "systemLog",
	        cols : [[
	            {type: "checkbox", fixed:"left", width:50},
	            {field: 'logId', title: '序号', width:60, align:"center"},
	            {field: 'url', title: '请求地址', width:350},
	            {field: 'method', title: '操作方式', align:'center',templet:function(d){
	                if(d.method.toUpperCase() == "GET"){
	                    return '<span class="layui-blue">'+d.method+'</span>'
	                }else{
	                    return '<span class="layui-red">'+d.method+'</span>'
	                }
	            }},
	            {field: 'ip', title: '操作IP',  align:'center',minWidth:130},
	            {field: 'timeConsuming', title: '耗时', align:'center',templet:function(d){
	                return '<span class="layui-btn layui-btn-normal layui-btn-xs">'+d.timeConsuming+'</span>'
	            }},
	            {field: 'isAbnormal', title: '是否异常', align:'center',templet:function(d){
	                if(d.isAbnormal == "正常"){
	                    return '<span class="layui-btn layui-btn-green layui-btn-xs">'+d.isAbnormal+'</span>'
	                }else{
	                    return '<span class="layui-btn layui-btn-danger layui-btn-xs">'+d.isAbnormal+'</span>'
	                }
	            }},
	            {field: 'operator',title: '操作人', minWidth:100, templet:'#newsListBar',align:"center"},
	            {field: 'operatingTime', title: '操作时间', align:'center', width:170}
	        ]]
	    });
	 	
	})

	</script>
</body>
</html>
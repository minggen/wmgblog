<?php 

function getnav($islogin=fasle,$user){
    ?>

<body>
  <div id="head" class="layui-header layui-bg-black top" style="min-width:700px;">
   <!-- 导航栏 -->
   <ul class="layui-nav" lay-filter="" id="mynav">
    <div class="layui-logo" style=" display:inline-block;"><img src="./images/fly.png" width="120px"></div>
    <li class="layui-nav-item"><a href="/">首页</a></li>
    <li class="layui-nav-item "><a href="/weiyu.php">微语</a></li>
<!--    <li class="layui-nav-item"><a href="">时间线</a></li>-->
    <li class="layui-nav-item">
      <a href="javascript:;">文章分类</a>
      <dl class="layui-nav-child"> <!-- 二级菜单 -->
      	<?php require_once dirname(__FILE__).'/../model/sort_model.php' ;
      	 $sort = new Sort_Model();
      	 $res = $sort->getSorts();
      	foreach ($res as $row) {
      	 ?>
        <dd><a href="javascript:void(0)" onclick="getsort(<?php echo $row['sid'];?>)"><?php echo $row['sortname']?></a></dd>      	
      	<?php    
      	}?>
      </dl>
      
      <script type="text/javascript">
		function getsort(sid){
			  $.post("action.php",
			    	    {
			    	      action:"getsort",
			    	      id:sid
			    	    },
			    	    function(data1,status){
			    	     	layer.msg(status);
				    	 	$(".main").html(data1);
			    	    });

					
		}
      </script>
    </li>
    <li class="layui-nav-item "><a href="">相册</a></li>
    <li class="layui-nav-item "><a href="javascript:;" id="search"> <i class="layui-icon" >&#xe615;</i>
    </a></li>
    <?php if ($islogin){ ?>
    <div class="layui-nav-item layui-layout-right">
     <a href="javascript:;">
      <img src="./images/userface2.jpg" class="layui-nav-img">
      admin
    </a>
    <dl class="layui-nav-child">
      <dd><a href="">个人中心</a></dd>
      <dd><a href="">账号设置</a></dd>
      <hr>
      <dd><a href="javascript:void(0)" onclick="exitlogin()">退出</a></dd>
      <script type="text/javascript">
		function exitlogin(){
		    $.post("action.php",
    			{
    		      action:"exit"
    			},
	    	    function(data1,status){
					if(status=='success'){
						console.log(data1);
						window.location.href='http://php.wmgblog.pw';
					}
			   });

		    
		}
</script>
    </dl>
  </div>
  <?php }else {?>
   <div class="layui-nav-item layui-layout-right">
    <a href="javascript:void(0)" onclick="tologin()">登录</a></li>
  </div>
  <script type="text/javascript">
		function tologin(){
			layui.use('layer', function(){
				  var layer = layui.layer;
				  layer.open({
					  title: '<h2>登录</h2>'
					 ,content: '<form class="layui-form" action="action.php" method="post" ><div class="layui-form-item"><label class="layui-form-label">用户名</label><div class="layui-input-block"><input type="text" name="username" lay-verify="title" autocomplete="off" placeholder="请输入用户名" class="layui-input"></div></div><div class="layui-form-item"><label class="layui-form-label">密码</label><div class="layui-input-block"><input type="password" name="passwd" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input"></div></div><div class="layui-input-block"><input type="submit" value="登陆" lay-submit lay-filter="login" class="layui-btn"></div></form>'
					,skin: 'layui-layer-molv' 
					,area: ['500px', '300px']
					,btn:[]
					
					});    
				});       
		}
			layui.use('form', function(){
			  var form = layui.form;
			  form.on('submit(login)', function(data){
				   $.post("action.php",
				    	    {
				    	      action:"login",
				    	      username:data.field.username,
				    	      passwd:data.field.passwd
				    	    },
				    	    function(data1,status){
							if(data1=="登录失败")
					   			layer.msg(data1);
							else{
								console.log(data1);
								window.location.href='http://php.wmgblog.pw/admin.php';
							}
					   });

				    return false;
				  });
			  
		});
		
  </script>
  <?php }?>
  
</ul>

<ul class="layui-nav" lay-filter="" id="mynav-search" hidden>
  <div class="layui-logo"><img src="./images/fly.png" width="120px"></div>
  <li class="layui-nav-item "><a href="javascript:;" id="search">首页</a></li>

  <div style="display:inline-block;vertical-align:middle;margin-left:200px;">
    <i class="nav-search-icon" ></i>
  </div><!--
   <div class="search" id="search-close">
    <i class="nav-search-icon" ></i>
  </div> -->
  <div class="search" style="margin-left:8px;">
    <input type="text" name="title" required  lay-verify="required" placeholder="搜索" autocomplete="off" style="background-color: #393D49;border:none;width:400px;font-size:20px;">
  </div>

  <div class="search" id="search-close">
    <i class="nav-search-close-icon" ></i>
  </div>
</ul>

</div>

<script>
  layui.use('element', function(){
    var element = layui.element;
  });

  layui.use('layer', function(){
    var layer = layui.layer;
  // layer.msg('hello');
});

  jQuery(document).ready(function($) {
    var searchbtn = $('#search');
    $('#search-close').on('click',  function(event) {
     $('#mynav-search').hide();
     $('#mynav').show();
   });
    $('#search').on('click',function(){
     // var navcontent =  $('#mynav').html();
     // console.log(navcontent);
     $('#mynav').hide();
     $('#mynav-search').show();
    /* $('#mynav').html('<div class="layui-logo"><img src="./images/fly.png" width="120px"></div><li class="layui-nav-item "><a href="javascript:;" id="search">首页</a></li><div style="display:inline-block;vertical-align:middle;margin-left:200px;"><i class="nav-search-icon"></i></div><div class="search" style="margin-left:8px;"><input type="text" name="title" required lay-verify="required" placeholder="搜索" autocomplete="off" style="background-color: #393D49;border:none;width:400px;font-size:20px;"></div><div class="search"><i class="nav-search-close-icon"></i></div><style type="text/css" media="screen">.nav-search-icon{display:inline-block;background-image:url("./images/global-201802071838.svg");width:16px;height:16px;cursor:pointer;background-position:40.27% 99.55000000000001%;background-size:1512.5% 1500%;background-repeat:no-repeat}.nav-search-close-icon{display:inline-block;background-image:url("./images/global-201802071838.svg");width:16px;height:16px;overflow:hidden;text-indent:10000px;outline:0;background-position:65.49000000000001% 45.09%;background-size:1512.5% 1500%;background-repeat:no-repeat}</style>');
    */
     /* layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        shadeClose: true,
        skin: 'yourclass',
        content: '<div style="width:100%;height:100%;"><input type="text"  name="" style="background-image:url(./images/face.jpg); height:50px;margin-left: 3px;width :500px; border-radius: 25px; ;"></div>'
      });*/
    })
  });
</script>


    
    
    
    <?php 
}
?>
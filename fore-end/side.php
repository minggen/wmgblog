<div class="layui-col-md4 rightside">
	<div class="sidebar-box wow <?php $animated->getanimated();?>">
		<div class="user-info">
			<h2 class="" style="text-align: center;">图标MYBlog</h2>
			<hr class="layui-bg-green">
			<div class="hcenter mt30">
				<a href="#"> <img src="./images/userface3.jpg" alt="头像"
					class="t-img"></a>
			</div>
			<div class="hcenter mt10">
				<a href="#">admin</a>
			</div>
			<div class="hcenter">每一天，发现生活之美！</div>
			<br>
			<ul class="widght">
				<li class="weixin"><span class="tipso_style"><a title="微信"><i
							class="fa fa-weixin"></i></a></span></li>
				<li class="myqq"><a target="blank" rel="external nofollow"
					href="http://wpa.qq.com/msgrd?V=3&amp;uin=919767736&amp;Site=QQ&amp;Menu=yes"
					title="QQ"><i class="fa fa-qq"></i></a></li>

				<li class="weibo"><a title=""
					href="http://weibo.com/p/1005051742516832" target="_blank"
					rel="external nofollow"><i class="fa fa-weibo"></i></a></li>

				<li class="myrss"><a title="待更新" href="" target="_blank"
					rel="external nofollow"><i class="fa fa-rss"></i></a></li>
			</ul>

		</div>
	</div>
	
	<div class="sider" style="margin-left: 44px;">
		<div class="f_calendar side-bar wow <?php $animated->getanimated();?>">
			<h3>
				<i class="fa fa-calendar"></i>&nbsp;日历
			</h3>
			<hr class="layui-bg-green">
			<div id="cal">
       				 <?php require_once 'Calendar.php';?>
				</div>
		</div>
		
		<div class="side-bar wow <?php $animated->getanimated();?>">
			热门文章
			<hr class="layui-bg-green">
			<?php require_once 'fore-end/hot_content.php';?>
		</div>
		
		
		<div class="side-bar wow <?php $animated->getanimated();?>">
			标签
			<hr class="layui-bg-green">
			<?php require_once 'fore-end/lab.php';?>
		</div>
		
	</div>

</div>

<div class="layui-col-md12"
	style="margin-top: 40px; text-align: center;">
	<div class="layui-footer footer footer-doc">&copy; 2018 wmgblog.pw</div>
</div>


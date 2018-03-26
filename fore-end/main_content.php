<?php 
if(isset($_GET['blogid'])){
    $blogid = $_GET['blogid'];
    require_once dirname(__FILE__).'/../model/log_model.php';
    require_once dirname(__FILE__).'/../model/comment_model.php';
    require_once dirname(__FILE__).'/../model/sort_model.php';
    
    $sort = new Sort_Model();
    $log = new Log_Model();
    $comment = new comment_model();
    $row = $log->getOneLogForAdmin($blogid);
    $nei = $log->neighborLog($row['gid']);
?>
<style>
.breadcrumb-wrap {
	padding: 15px;
	color: #757575;
	margin-top: 20px; 
	background-color: #fff;
}
.main-content-box{
	padding: 20px;
	margin-top: 20px; 
	background-color: #fff;
}
.main-content{
	font-size: 18px;
}
</style>

<div class="breadcrumb-wrap">
		<i class="fa fa-home"></i> <a href="#" title="首页">首页</a> <i
			class="fa fa-angle-right"></i> <a href="#"><?php echo $sort->getSortName($row['fl_id']);?></a> <i
			class="fa fa-angle-right"></i> 正文
	</div>
	<div class="main-content-box">
			<h2><b><?php echo $row['title'];?></b></h2>
		<br />
		
		<p>
		<i class="fa fa-calendar"></i>&nbsp;
				<span><?php echo date("Y-m-d",strtotime($row['date']));?></span>
				
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				<i class="layui-icon">&#xe612;</i>&nbsp;<span><?php echo $row['author'];?></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				    <a href="#">
					<i class="layui-icon">&#xe64c;</i><span><?php echo $sort->getSortName($row['fl_id']);?></span></a>
					
					&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-eye"></i>
                	<span>浏览(<?php echo $row['views']?>)</span>
                	
                	&nbsp;&nbsp;&nbsp;&nbsp;
                	
                	<a href="#"><i class="layui-icon">&#xe611;</i>&nbsp;<span>评论(<?php echo $comment->getcountbyblogid($blogid);?>)</span></a>
			</p>
						
<!-- 		</blockquote> -->
		<hr class="layui-bg-green" />
		<!--
		<p>	<blockquote class="layui-elem-quote ">
		春色远走，风情长留。爱若放手，祝福依旧
		----<?php echo $row['author'];?>
		</blockquote></p>
		  -->
	
		<p class="main-content">
			<?php echo $row['content'];?>
		</p>		

		<p>
		<br />
		<br />
		<br />
		<h3>附件</h3>
		<?php 
		//获取附件列表
		?>
		<a href="../images/git.png" download="../images/git.png" ><img src="../images/git.png" alt="" width="40px" height="40px"/></a>
		</p>
		
		
		<br />
		<hr class="layui-bg-green"/>
	<div class="" style="margin-bottom:  30px;">
	<a class="layui-btn " href="javascript:void(0)" onclick="setcontent(<?php echo $nei['prevLog']['gid']?>)" style="float: left;
    padding: 0 21px;
    text-align: left;">
	<i class="fa fa-angle-double-left"></i>
	<?php echo $nei['prevLog']['title'];?>
	</a>
	
	<a class="layui-btn" href="javascript:void(0)" onclick="setcontent(<?php echo $nei['nextLog']['gid']?>)" style="float: right;
    padding: 0 21px;
    display:inline-block;
    text-align: right;">
	<?php echo $nei['nextLog']['title'];?>
	<em><i class="fa fa-angle-double-right"></i></em></a>
	
	</div>
	<br />
	<hr class="layui-bg-green"/>	
	评论
	<hr class="layui-bg-green"/>
	
	<form action="" class="layui-form">
	<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">评论:</label>
    <input type="text" name="id" value="<?php echo $row['gid'];?>" style="display: none" />
    <div class="layui-input-block">
      <textarea name="comment" placeholder="请输入评论内容" class="layui-textarea"></textarea>
    </div>
  </div>
  
   <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="comment">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
	</form>	

<script>
//Demo
layui.use('form', function(){
  var form = layui.form;

  form.on('submit(comment2)',function(data){
	  $.post("action.php",
	    	    {
	    	      action:"commentcomment",
	    	      blogid:data.field.blogid,
	    	      id:data.field.id,
	    	      comment:data.field.comment	      
	    	    },
	    	    function(data1,status){
	    	     layer.msg(data1);
	    	     setcontent(data.field.blogid);
	    	    });

	  	return false;
	  });
  form.on('submit(comment)', function(data){
    $.post("action.php",
    	    {
    	      action:"blogcomment",
    	      blogid:data.field.id,
    	      comment:data.field.comment
    	    },
    	    function(data1,status){
    	     layer.msg(data1);
    	     setcontent(data.field.id);
    	    });
    return false;
  });
});
</script>
	评论列表：
	<hr class="layui-bg-green"/>
	<?php require_once dirname(__FILE__).'/../comment.php';?>
		</div>
		
<?php }?>
<div class="layui-col-md8 main " id="main">
			<div class="test1">
			<div class="zhiding"><a href="#"><h3>
					<span class="layui-badge">置顶</span>&nbsp;&nbsp;&nbsp;&nbsp;精华文章
				</h3></a>
			<hr></div>
			<div class="layui-carousel" id="mycarousel" style="margin: auto;">
				<div carousel-item>
					<div>
						<img src="./images/1.jpg" alt="" width="100%">
					</div>
					<div>
						<img src="./images/2.jpg" alt="" width="100%">
					</div>
					<div>
						<img src="./images/3.jpg" alt="" width="100%">
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		function comment(id,blogid){
			console.log(id+","+blogid);
			layer.open({
				  title: '评论'
				  ,content: '<form action="" class="layui-form"><div class="layui-form-item"><input type="text" name="id" value="'+id+'" style="display: none"/><input type="text" name="blogid" value="'+blogid+'" style="display: none"/><textarea name="comment" placeholder="请输入评论内容" class="layui-textarea"></textarea></div><div class="layui-form-item"><button class="layui-btn" lay-submit lay-filter="comment2">立即提交</button><button type="reset" class="layui-btn layui-btn-primary">重置</button></div></form>'
				,skin: 'layui-layer-molv' 
				,area: ['500px', '300px']
				,btn:[]
				});    
		}
		function setcontent(id){
		    res = $.ajax({url:'./fore-end/main_content.php?blogid='+id,success:function(data){
				//console.log(data);
				$(".main").html(data);
			    }});
		}


		function dianzan(id,blogid){
			$.post("action.php",
				    	    {
				    	      action:"comment",
				    	      id:id
				    	    },
				    	    function(data1,status){
					    	 layer.msg(data1);
				    	     setcontent(blogid);
				    	    });
				  
			}
		</script>
		
		<?php require_once 'model/log_model.php';
		require_once 'model/comment_model.php';
		require_once 'base.php';
		
		  $log_model = new Log_Model();
		  $rowsy = $log_model->getLogsForHome('and top="y" order by date desc');
		  $rowsn = $log_model->getLogsForHome('and top="n" order by date desc');
		  
		  $rows = array_merge($rowsy,$rowsn);
		  $comment = new comment_model();
		  foreach ($rows as $index => $value) {	   
		?>
			
		<div class="content-box wow  bounce <?php $animated->getanimated()?>">
			<a class="title" 
				href="javascript:void(0)" onclick="setcontent(<?php echo $value['gid']?>)" >
				
				<h3 style="color: black;">
					<?php if ($value['top']=='y'){?>
						<span class="layui-badge">置顶</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $value['title']?>
					<?php }else{?>
					<span class="layui-badge layui-bg-green">原创</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $value['title']?>
					<?php }?>	
				</h3> <br></a>
			<hr>
			<div>
				<?php echo subString($value['content'], 0, 270);?>
			</div>
			<p align="right" style="margin-right: 20px;">
				<i class="fa fa-calendar"></i>&nbsp;
				<span><?php echo date("Y-m-d H:i:s",$value['date']);?></span>
				
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				<i class="layui-icon">&#xe612;</i>&nbsp;<span><?php echo $value['author']?></span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				    <a href="#">
					<i class="layui-icon">&#xe64c;</i><span><?php echo '分类id:'.$value['fl_id'];?></span></a>
					
					&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-eye"></i>
                	<span>浏览(<?php echo $value['views'];?>)</span>
                	
                	&nbsp;&nbsp;&nbsp;&nbsp;
                	
                	<a href="#"><i class="layui-icon">&#xe611;</i>&nbsp;<span>评论(<?php echo $comment->getcountbyblogid($value['gid'])?>)</span></a>
			</p>
		</div>
		
		<?php }?>
</div>

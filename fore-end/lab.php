<?php 
function getrandbtn(){
    $btn = array(
         );
    $length = count($btn);
    $index = rand(0,$length-1);
    echo $btn[$index];
}
?>
<script type="text/javascript"> 
var a_idx = 0;
jQuery(document).ready(function($) {
	setInterval(function() {
		var a = new Array("富强", "民主", "文明", "和谐", "自由", "平等", "公正" ,"法治", "爱国", "敬业", "诚信", "友善");
		var colorclass = new Array(" layui-btn-primary","layui-btn-normal","layui-btn-warm","layui-btn-danger");
		
			var $i = $("<span/>").html("<a class='layui-btn  "+colorclass[a_idx%colorclass.length] +"'>"+a[a_idx]+"</a>");
	        a_idx = (a_idx + 1) % a.length;
	        if($("#lab")!=null){
	        var x = $("#lab").position().top        
			var x0  = $("#lab").offset().top;
			var y0  = $("#lab").offset().left;
	        }
	        var width = $("#lab").width();
	        var height = $("#lab").height();
	        var x = x0+width -100;
	        var y = y0+Math.random()*(width-50);
	        console.log(width,height);
	        console.log();
	        $i.css({
	            "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
	            "top": x ,
	            "left": y,
	            "position": "absolute",
	            "font-weight": "bold",
	            "color": '#'+(Math.random()*0xffffff<<0).toString(16)
	        });
	        $("body").append($i);
	        $i.animate({
	            "top": x0,
	            "opacity": 0.2
	        },
	        3000,
	        function() {
	            $i.remove();
	        });

	   }, 800);
});

</script>


<div id="lab" style="text-align: center;width: 100%;height: 250px;">
	
</div>


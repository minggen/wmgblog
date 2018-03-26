new WOW().init();

function sendinfo(record,to){
    res = $.ajax({url:'./'+to+'.php?record='+record,success:function(data){
        $('#cal').html(data);
        }});
}

layui.use('form');
layui.use('carousel', function(){
	  var carousel = layui.carousel;
	  //建造实例
	  carousel.render({
	    elem: '#mycarousel'
	    ,width: '96%' //设置容器宽度
	    ,arrow: 'always' //始终显示箭头
	    ,autoplay:true
	    //,anim: 'updown' //切换动画方式
	  });
	});

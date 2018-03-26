<?php
    require_once dirname(__FILE__).'/../model/weiyu_model.php';

    $weiyu = new weiyu_model();

    $logs =  $weiyu->getAll();

?>

<div class="layui-col-md8 main " id="main">
    <div class="breadcrumb-wrap">
        <i class="fa fa-home"></i> <a href="#" title="首页">首页</a> <i class="fa fa-angle-right"></i> 微语
    </div>




        <div class="main-content-box">
            <ul class="layui-timeline">

                <?php
                foreach ($logs as $log){
                ?>

                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                    <div class="layui-timeline-content layui-text">
                        <h3 class="layui-timeline-title"><?php echo $log['date']?></h3>

                            <div class="weiyu_box">
                                <br>

                                 <blockquote class="layui-elem-quote" style="margin-bottom: 20px;margin-top: 20px;margin-left: 20px ;margin-right: 20px;"><?php echo $log['content']?></blockquote>

                                &nbsp;&nbsp;&nbsp;&nbsp;由<?php echo $log['userid']?>发表
                            </div>

                    </div>
                </li>

                <?php } ?>

                <style>

                    .weiyu_box{
                        width: 100%;
                        height: auto;
                        //background-color: snow;
                        border: #ded8d8 2px solid;
                    }

                </style>
<!--                <li class="layui-timeline-item">-->
<!--                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>-->
<!--                    <div class="layui-timeline-content layui-text">-->
<!--                        <h3 class="layui-timeline-title">8月16日</h3>-->
<!---->
<!--                        <blockquote class="layui-elem-quote"><p>和世界交手的这许多年，你是否光彩依旧，兴致盎然。</p></blockquote>-->
<!---->
<!--                    </div>-->
<!--                </li>-->
<!--                <li class="layui-timeline-item">-->
<!--                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>-->
<!--                    <div class="layui-timeline-content layui-text">-->
<!--                        <h3 class="layui-timeline-title">8月15日</h3>-->
<!---->
<!--                        <blockquote class="layui-elem-quote"> <p>-->
<!--                            我拥有的都是侥幸，我失去的都是人生。-->
<!--                        </p></blockquote>-->
<!---->
<!--                    </div>-->
<!--                </li>-->
<!---->
<!--                <li class="layui-timeline-item">-->
<!--                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>-->
<!--                    <div class="layui-timeline-content layui-text">-->
<!--                        <h3 class="layui-timeline-title">8月15日</h3>-->
<!---->
<!--                        <blockquote class="layui-elem-quote"><p>-->
<!--                            愿无岁月可回头 且以深情共白首-->
<!--                        </p></blockquote>-->
<!---->
<!--                    </div>-->
<!--                </li>-->
<!---->
<!--                <li class="layui-timeline-item">-->
<!--                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>-->
<!--                    <div class="layui-timeline-content layui-text">-->
<!--                        <h3 class="layui-timeline-title">8月15日</h3>-->
<!---->
<!--                        <blockquote class="layui-elem-quote"><p>-->
<!--                            此时相望不相闻，愿逐月华流照君-->
<!--                        </p></blockquote>-->
<!---->
<!--                    </div>-->
<!--                </li>-->
<!---->
<!--                <li class="layui-timeline-item">-->
<!--                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>-->
<!--                    <div class="layui-timeline-content layui-text">-->
<!--                        <h3 class="layui-timeline-title">8月15日</h3>-->
<!---->
<!--                        <blockquote class="layui-elem-quote"><p>-->
<!--                                风吹走的梦，就真的到了大洋彼岸，回不来了-->
<!--                            </p></blockquote>-->
<!---->
<!--                    </div>-->
<!--                </li>-->





                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                    <div class="layui-timeline-content layui-text">
                        <div class="layui-timeline-title">过去</div>
                    </div>
                </li>
            </ul>


        </div>

</div>


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
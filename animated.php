<?php
class Animated{
    private $animated ;
    function __construct() {
        $this->animated =array("bounceInLeft","bounceInRight","fadeInUp","fadeInUpBig","zoomIn" , "tada", "fadeInDown","bounceInDown","rollIn","lightSpeedIn","pulse","flipInX","swing");
    }
    function getanimated(){
        $length =  count($this->animated);
        $index = rand(0,$length-1);
        echo $this->animated[$index];
    }
}
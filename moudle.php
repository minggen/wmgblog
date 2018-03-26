<?php
require_once 'fore-end/header.php';
require_once 'fore-end/nav.php';

$islogin = empty($_SESSION['user'])?false:true;
$user = $_SESSION['user'];
getnav($islogin,$user);
require_once 'animated.php';
$animated = new Animated();
?>
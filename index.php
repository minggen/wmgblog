    <?php
    require_once 'fore-end/header.php';
    require_once 'fore-end/nav.php';
    
    $islogin = empty($_SESSION['user'])?false:true;
    $user = $_SESSION['user'];
    getnav($islogin,$user);
    require_once 'animated.php';
    $animated = new Animated();
    ?>

<div class="layui-container">
    <?php
    require_once 'fore-end/content.php';
    require_once 'fore-end/side.php';
    ?>
</div>


<script type="text/javascript" src="js/my.js">
</script>
<?php
    require_once 'fore-end/footer.php';
?>


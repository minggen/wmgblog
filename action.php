<?php
/**
 *
 * 处理一些请求
 */

require_once dirname("__FILE__").'/model/comment_model.php';
require_once dirname("__FILE__").'/model/log_model.php';
require_once dirname("__FILE__").'/model/user_model.php';

if (isset($_POST['action'])){
    if ($_POST['action']=='blogcomment') {
        
        $blogid = isset($_POST['blogid'])?$_POST['blogid']:-1;
        $commentcontent = isset($_POST['comment'])?$_POST['comment']:'';
        $uid = 1;
        if ($commentcontent==''){
            echo '评论不能为空';
           
        }else{
        $comment = new comment_model();
        $commentdata = array(
            'content' => $commentcontent,
            'uid' => $uid,
            'forcommentid' => "0",
            'blogid' => $blogid,
            'date' =>  date("YmdHis")
        );
        $comment->addblogcomment($commentdata);
        echo '发表评论成功';
        }
    }
    
    if ($_POST['action']=='comment') {
        $id = isset($_POST['id'])?$_POST['id']:-1;
        $comment= new comment_model();
        $comment->addgoods($id);
        echo  '点赞成功';
    }
    if ($_POST['action']=='commentcomment') {
        $id = $_POST['id'];
        $gid = $_POST['blogid'];
        $commentcontent = $_POST['comment'];
        $comment= new comment_model();
        $uid = 1;
        if ($commentcontent==''){
            echo '评论不能为空';
            
        }else{
            $comment = new comment_model();
            $commentdata = array(
                'content' => $commentcontent,
                'uid' => $uid,
                'forcommentid' => $id,
                'blogid' => $gid,
                'date' => date("YmdHis")
            );
            $comment->addblogcomment($commentdata);
            echo '发表评论成功';
        }
        
    }
    
    if ($_POST['action']=='getsort') {
       // echo '11';
        $sid = $_POST['id'];
     //   echo $sid;
        $log =new Log_Model();
        echo    $log->getlogbysort($sid);
    }
    
    if ($_REQUEST['action']=='login') {
                        //处理user登陆，将其放在session中
      $usermodel = new user_model();  
      $user = $usermodel->checked($_POST['username'], $_POST['passwd']);
      if ($user['userName']==$_POST['username']){
      session_start();
      $_SESSION['user'] = true;
//       echo empty($_SESSION['user'])?'k':'n';        
      }
      else {
       echo '登录失败';  
    //   header("HTTP/1.0 400 OK");
      }
      
    }
    
    if ($_REQUEST['action']=='exit'){
//         $_SESSION['user'] = false;
//         unset($_SESSION['user']);
//         session_unset();
//         session_destroy();
        session_start();
        unset($_SESSION['user']);
        echo 'exit'.empty($_SESSION['user']);
    }
    
}

    /* 
$blogid = 1;
$commentcontent = '123';
$uid = 1;

$commentdata = array(
    'content' => $commentcontent,
    'uid' => $uid,
    'forcommentid' => "0",
    'blogid' => $blogid,
    'date' => date('YmdHis')
);
$comment = new comment_model();
$comment->addblogcomment($commentdata);

print_r($commentdata); */
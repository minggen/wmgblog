
<?php
// require_once dirname(__FILE__). '/fore-end/header.php';
require_once dirname(__FILE__). '/model/comment_model.php';
require_once dirname(__FILE__). '/model/user_model.php';
$comment_model = new comment_model();
$str =  $comment_model->getallcomment($blogid);
$str = $str == '<ul></ul>' ? '暂无评论！':$str;
echo $str;

$user = new user_model();
?>

<br />
<br />
<br />

<style>
.root {
	/* 	border: 2px solid red; */
	list-style: none;
	border-bottom: 2px solid;
	border-topL: 2px solid;
	margin-top: 4px;
	margin-bottom: 4px;
	word-wrap: break-word;
}

.comment-chridren {
	list-style: none;
	margin-left: 20px;
	margin-top: 4px;
	margin-bottom: 2px;
	margin-right: 2px;
	margin-top: 4px;
	border-top: 2px solid;
	padding-top: 10px;
	padding-bottom: 4px;
}

.comment-media {
	float: left;
	width: 40px;
	margin-right: 10px;
}

.comment-media img {
	border-radius: 20px;
}

.comment-content {
	margin-top: 3px;
	font-size: 14px;
	line-height: 24px;
	color: #303538;
	word-break: break-all;
	word-wrap: break-word;
}

.comment-nickname {
	font-size: 14px;
	color: #4d555d;
	font-weight: 700;
}

.comment-bd {
	position: relative;
	margin-left: 60px;
	margin-right: 20px;
}
.fr{
	float: right;
}
</style>
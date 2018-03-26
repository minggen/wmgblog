<?php
/**
 * 文章、页面管理
 *
 */
require_once dirname(__FILE__).'/../model/mysqlii.php';

class Log_Model
{

    private $db;

    function __construct()
    {
        $this->db = MySqlii::getInstance();
    }

    /**
     * 添加文章、页面
     *
     * @param array $logData            
     * @return int
     */
    /*
     *
     * $Log_model =new Log_Model();
     * $logData = array(
     * 'title' => "1111",
     * 'views' => "12113",
     * 'content' => "c1esi",
     * 'author' => "admin",
     * 'date' => "1725102",
     * 'top '=> "0",
     * 'fl_id' => "1",
     * 'hide' => "0",
     * 'checked' => "0",
     * 'passwd' => "-1"
     * );
     * echo $Log_model->addlog($logData);
     */
    function addlog($logData)
    {
        $kItem = array();
        $dItem = array();
        foreach ($logData as $key => $data) {
            $kItem[] = $key;
            $dItem[] = $data;
        }
        $field = implode(',', $kItem);
        $values = "'" . implode("','", $dItem) . "'";
        $this->db->query("INSERT INTO " . DB_PREFIX . "blog ($field) VALUES ($values)");
        $logid = $this->db->insert_id();
        return $logid;
    }

    /**
     * 更新文章内容
     *
     * @param array $logData            
     * @param int $blogId
     *            $Log_model =new Log_Model();
     *            $logData = array(
     *            'title' => "666",
     *            'views' => "12113",
     *            'content' => "c1esi",
     *            'author' => "admin",
     *            'date' => "1725102",
     *            'top '=> "0",
     *            'fl_id' => "1",
     *            'hide' => "0",
     *            'checked' => "0",
     *            'passwd' => "-1"
     *            );
     *            $Log_model->updateLog($logData,5,'admin');
     *            
     */
    function updateLog($logData, $blogId, $author = '')
    {
        $author = $author == '' ? '' : 'and author=\'' . $author . '\'';
        $Item = array();
        foreach ($logData as $key => $data) {
            $Item[] = "$key='$data'";
        }
        $upStr = implode(',', $Item);
        $this->db->query("UPDATE " . DB_PREFIX . "blog SET $upStr WHERE gid=$blogId $author");
    }

    /**
     * 获取指定条件的文章条数
     *
     * @param string $condition            
     * @return int 
     *         $log_model = new Log_Model();
     *         echo $log_model->getLogNum('title=666');
     */
    function getLogNum($condition = '', $author = '')
    {
        $author = $author == '' ? '' : 'and author=\'' . $author . '\'';
        
        $data = $this->db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE $condition  $author");
        
        return $data['total'];
    }

    /**
     * 后台获取单篇文章
     */
    function getOneLogForAdmin($blogId,$author='')
    {
        $author = $author == '' ? '' : 'and author=\'' . $author . '\'';
     
        $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE gid=$blogId $author";
      //  echo $sql;
        
        $res = $this->db->query($sql);
        
        if ($this->db->affected_rows() < 1) {
            emMsg('权限不足！', './');
        }
        $row = $this->db->fetch_array($res);
        if ($row) {
            $row['date'] = $row['date'] ;//更新为当前时间
            $row['title'] = htmlspecialchars($row['title']);
            //$row['content'] = htmlspecialchars($row['content']);
            $row['passwd'] = htmlspecialchars($row['passwd']);
            $logData = $row;
            return $logData;
        } else {
            return false;
        }
    }

    /**
     * 前台获取单篇文章
     */
    function getOneLogForHome($blogId)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE gid=$blogId AND hide='n' AND checked='y'";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_array($res);
        if ($row) {
            $logData = array(
                'logid' => intval($row['gid']),
                'log_title' => htmlspecialchars($row['title']),
                'date' => strtotime($row['date']),//转毫秒数
                'log_content'   => $row['content'],
                'author' => $row['author'],
                'views' => intval($row['views']),
                'top' => $row['top'],
                'hide'=> $row['hide'],
                'checked' => $row['checked'],                
                'password' => $row['password'],
                'fl_id' => $row['fl_id']
            );
            return $logData;
        } else {
            return false;
        }
    }

    function getAllLogs(){
        $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE 1";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
        $rows=array();
        $rows['newsTime'] = gmdate("Y-m-d H:i", strtotime($row['date']));
            $rows['newsName'] =htmlspecialchars($row['title']);
             $rows['newsId'] = $row['gid'];
             $rows['newsAuthor'] = $row['author'];
             $rows['abstract'] = $row['content'];
             $rows['content'] = $row['content'];
             if($row['checked']=='y'&&$row['hide']=='n'){                 
             $rows['newsStatus'] = '2';
             }elseif($row['checked']=='y'&&$row['hide']=='y'){
                 $rows['newsStatus'] = '0';
             }
             elseif ($row['checked']=='n'){
                 $rows['newsStatus'] = '1';
             }
             $rows['newsLook'] = '开放浏览';
             if($row['hide']=='y')
                 $rows['newsLook'] = '禁止浏览';
             if ($row['passwd']!='-1')
                 $rows['newsLook'] = '私密浏览';
             if ($row['top']=='y')
                 $rows['newsTop']='checked';
            $logs[] = $rows;
        }
        return $logs;
    }
    
    /**
     * 后台获取文章列表
     *
     * @param string $condition            
     * @param string $hide_state            
     * @param int $page            
     * @param string $type            
     * @return array
     */
    function getLogsForAdmin($condition = '', $hide_state = 'n',$author='')
    {
        
        $hide_state =  "and hide='$hide_state'";
        $author = $author==''?'1':'author='.$author;
        $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE  $author $hide_state $condition ";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['date'] = gmdate("Y-m-d H:i", $row['date']);
            $row['title'] =htmlspecialchars($row['title']);
            // $row['gid'] = $row['gid'];
            // $row['comnum'] = $row['comnum'];
            // $row['top'] = $row['top'];
            // $row['attnum'] = $row['attnum'];
            $logs[] = $row;
        }
        return $logs;
    }

    /**
     * 前台获取文章列表
     *
     * @param string $condition            
     * @param int $page            
     * @param int $perPageNum            
     * @return array
     */
    function getLogsForHome($condition = '')
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE   hide='n' and checked='y' $condition ";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['date'] = strtotime($row['date']);
            $row['log_title'] = htmlspecialchars(trim($row['title']));
            $row['logid'] = $row['gid'];
           /*  $cookiePassword = isset($_COOKIE['em_logpwd_' . $row['gid']]) ? addslashes(trim($_COOKIE['em_logpwd_' . $row['gid']])) : '';
            if (! empty($row['password']) && $cookiePassword != $row['password']) {
                $row['excerpt'] = '<p>[该文章已设置加密，请点击标题输入密码访问]</p>';
            } else {
                if (! empty($row['excerpt'])) {
                    $row['excerpt'] .= '<p class="readmore"><a href="' . Url::log($row['logid']) . '">阅读全文&gt;&gt;</a></p>';
                }
            }
            $row['log_description'] = empty($row['excerpt']) ? breakLog($row['content'], $row['gid']) : $row['excerpt'];
        */
            $logs[] = $row;
        }
        return $logs;
    }
    /**
     * 删除文章
     *
     * @param int $blogId            
     */
    function deleteLog($blogId,$author = '')
    {
        $author = $author == '' ? '' : 'and author=\'' . $author . '\'';
        $this->db->query("DELETE FROM " . DB_PREFIX . "blog where gid=$blogId $author");
        
        if ($this->db->affected_rows() < 1) {
            emMsg('权限不足！', './');
        }
        // 评论
        $this->db->query("DELETE FROM " . DB_PREFIX . "comment where forlogid=$blogId");
        
        // 标签
        //$this->db->query("UPDATE " . DB_PREFIX . "tag SET gid= REPLACE(gid,',$blogId,',',') WHERE gid LIKE '%" . $blogId . "%' ");
        //$this->db->query("DELETE FROM " . DB_PREFIX . "tag WHERE gid=',' ");
        // 附件
        $query = $this->db->query("select filepath from " . DB_PREFIX . "attachment where blogid=$blogId ");
        while ($attach = $this->db->fetch_array($query)) {
            if (file_exists($attach['filepath'])) {
                @unlink($attach['filepath']);
            }
        }
        $this->db->query("DELETE FROM " . DB_PREFIX . "attachment where blogid=$blogId");
    }

    /**
     * 隐藏/显示文章
     *
     * @param int $blogId            
     * @param string $state            
     */
    function hideSwitch($blogId, $state,$author ='')
    {
        //$author = ROLE == ROLE_ADMIN ? '' : 'and author=' . UID;
        $author = $author == '' ? '' : 'and author=\'' . $author . '\'';    
        $this->db->query("UPDATE " . DB_PREFIX . "blog SET hide='$state' WHERE gid=$blogId $author");
    }

    /**
     * 审核作者文章
     *
     * @param int $blogId            
     * @param string $state            
     */
    function checkSwitch($blogId, $state)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "blog SET checked='$state' WHERE gid=$blogId");
    }
    /**
     * 增加阅读次数
     *
     * @param int $blogId            
     */
    function updateViewCount($blogId)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "blog SET views=views+1 WHERE gid=$blogId");
    }


    /**
     * 获取相邻文章
     *
     * @param int $date
     *            unix时间戳
     * @return array
     */
    function neighborLog($gid)
    {
        $neighborlog = array();
        $neighborlog['nextLog'] = $this->db->once_fetch_array("SELECT title,gid FROM " . DB_PREFIX . "blog WHERE gid > $gid and hide = 'n' and checked='y'  ORDER BY gid  LIMIT 1");
        $neighborlog['prevLog'] = $this->db->once_fetch_array("SELECT title,gid FROM " . DB_PREFIX . "blog WHERE gid < $gid and hide = 'n' and checked='y'  ORDER BY gid DESC LIMIT 1");
        if ($neighborlog['nextLog']) {
            $neighborlog['nextLog']['title'] = htmlspecialchars($neighborlog['nextLog']['title']);
        }
        else {
            $neighborlog['nextLog']['title'] = '没有下一篇了';
        }
        if ($neighborlog['prevLog']) {
            $neighborlog['prevLog']['title'] = htmlspecialchars($neighborlog['prevLog']['title']);
        }
        else {
            $neighborlog['prevLog']['title'] = '没有上一篇了';
        }
        return $neighborlog;
    }

    /**
     * 获取热门文章
     */
    function getHotLog($num)
    {
        $sql ="SELECT gid,title FROM " . DB_PREFIX . "blog WHERE hide='n' and checked='y' ORDER BY views DESC LIMIT 0, $num";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['gid'] = intval($row['gid']);
            $row['title'] = htmlspecialchars($row['title']);
            $logs[] = $row;
        }
        return $logs;
    }
    
    function  getlogbysort($sid){
        $sql ="SELECT * FROM " . DB_PREFIX . "blog WHERE hide='n' and checked='y' and fl_id = $sid ORDER BY views DESC ";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['gid'] = intval($row['gid']);
            $row['title'] = htmlspecialchars($row['title']);
            $logs[] = $row;
        }
        
       ?>
		<?php 
		
		require_once 'model/comment_model.php';
		require_once 'base.php';
		require_once 'animated.php';
		$animated = new Animated();
		  $log_model = new Log_Model();

		  $rows = $logs;
		  $comment = new comment_model();
// 		  print_r($rows);
		  
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
				<i class="fa fa-calendar"></i> &nbsp;
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
       <?php
    }
}
?>
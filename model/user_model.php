<?php
require_once dirname(__FILE__).'/../model/mysqlii.php';

class user_model{
  
    private $db;
    
    function __construct()
    {
        $this->db = MySqlii::getInstance();
       new  mysqli();
    }
    /**
     * 提供所有user
     * @return string[]
     */
    function getAllUser(){
        $sql = "SELECT * FROM " . DB_PREFIX . "user WHERE 1";
       
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['userEndTime'] = gmdate("Y-m-d H:i", strtotime($row['userEndTime']));
            $logs[] = $row;
            
        }
        return $logs;
    }
    
    function getuserimgsrc($uid){
        return         '<div class="comment-media">
        <a ><img src="/images/userface2.jpg" width="40" height="40"></a>
        </div>';
    }
    
    function checked($username,$passwd){
        $sql = "select * from ". DB_PREFIX . "user WHERE userName=\"".$this->post_check($username)."\" and passwd = \"".$this->post_check($passwd)."\"";
        $res = $this->db->query($sql);
        if ($res->num_rows==1){
           $row= $this->db->fetch_array($res);
          $user = $row;
        }
        
        return $user;
    }
    
    
    function insert($username,$passwd,$picpath,$email,$sex,$status,$grade,$endtime,$desc='描述'){
        $userdata = array(
            'passwd'=>$this->post_check($passwd),
            'userName'=>$this->post_check($username),
            'picpath'=>$this->post_check($picpath),
            'userEmail'=>$this->post_check($email),
            'userSex'=>$this->post_check($sex),
            'userStatus'=>$this->post_check($status),
            'userGrade'=>$this->post_check($grade),
            'userEndTime'=>$this->post_check($endtime),
            'userDesc'=>$this->post_check($desc)
        );
        
        $kItem = array();
        $dItem = array();
        foreach ($userdata as $key => $data) {
            $kItem[] = $key;
            $dItem[] = $data;
        }
        $field = implode(',', $kItem);
        $values = "'" . implode("','", $dItem) . "'";
        $this->db->query("INSERT INTO " . DB_PREFIX . "user ($field) VALUES ($values)");
        $id = $this->db->insert_id();
        return $id;
    }
    
    function getusernickname($id){
        return '<div class="comment-nickname">
                    <a href="#">nickname</a>
                </div>';
    }
    
    function post_check($post)
    {
        if (!get_magic_quotes_gpc()) // 判断magic_quotes_gpc是否为打开
        {
            $post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤
        }
        $post = str_replace("_", "＼_", $post); // 把 '_'过滤掉
        $post = str_replace("%", "＼%", $post); // 把' % '过滤掉
        $post = nl2br($post); // 回车转换
        $post= htmlspecialchars($post); // html标记转换
        return $post;
    } 
    
}


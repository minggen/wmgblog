<?php

require_once dirname(__FILE__).'/../model/mysqlii.php';
require_once dirname(__FILE__).'/../model/user_model.php';

class  comment_model{
    private $db;
   // private $user;
    function __construct()
    {
     //   $user = new user_model();
        $this->db = MySqlii::getInstance();
    }
    /**
     * 根据blogid获取评论一级列表
     * @param int $blogid
     * @return string
     */
    function  getblogcomment($blogid){
        
//         order by date Desc

        $sql =  "SELECT * from " . DB_PREFIX . "comment where forcommentid=0 and  blogid ='$blogid' ORDER BY date  Desc ";
        $res  = $this->db->query($sql);
        $logs = array();
        
        while ($row = $this->db->fetch_array($res)) {
           
            $row['content'] =htmlspecialchars($row['content']);
            $logs[] = $row;
        }
        return $logs;
    }
    /**
     * @todo 获取评论的子评论
     * @param int $commentid
     * @return string
     */
    function getcomment($commentid) {
        $sql =  "SELECT * from " . DB_PREFIX . "comment where forcommentid ='$commentid' ORDER BY date  DESC ";
        $res  = $this->db->query($sql);
        $logs = array();
        
        while ($row = $this->db->fetch_array($res)) {
            $row['content'] =htmlspecialchars($row['content']);
            $logs[] = $row;
        }
        return $logs;
    }
    function getSonstr($id,$blogid){
        $str = "<ul>";
        $logs = $this->getcomment($id);
        if (count($logs)==0){
            return '';
        }
        $user = new user_model();
        
        foreach ($logs as $row){
           // $str = $str . "<li class='chridren'>". $this->$user->getuserimgsrc("1")."<br><div class='comment-content'  style='margin-left:20px;'>". $row['content']."</div>";
            $str =$str.
            "<li class='comment-chridren'>".
            $user->getuserimgsrc("1") .
            "<div class='comment-bd'>".
           $user->getusernickname("1").
           '<p class="comment-content">'. $row['content']."</p><div ><span title='创建时间' >时间:".date('Y-m-d H:i:s',strtotime($row['date']))."</span>
            				<a title='点赞' href='javascript:void(0)' 	onclick=\"dianzan(".$row['id'].",$blogid)\" class='fr'>&nbsp;&nbsp;<i class='fa fa-thumbs-o-up'></i> (".$row['goods'].")</a> <a href='javascript:void(0)' 	onclick=\"comment(".$row['id'].",$blogid)\"  class='fr' title='评论'><i class='fa fa-commenting-o'></i>&nbsp;&nbsp;&nbsp;</a></div></div>";
            
            $sonstr  = $this->getSonstr($row['id'],$blogid);
            $str = $str . $sonstr."</li>";
        }
        
        $str =  $str . "</ul>";
        
        return  $str;
    }
    
    function  getcountbyblogid($blogid){           
            $data = $this->db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "comment WHERE blogid = '$blogid'");
            return $data['total'];        
    }
    function  getallcomment($blogid){
        $root = $this->getblogcomment($blogid);
       $str = "<ul>";
       $user = new user_model();
        foreach ($root as $index => $row){
            $str =$str. 
            "<li class='comment-chridren'>".
            $user->getuserimgsrc("1") .
            "<div class='comment-bd'>".
            $user->getusernickname("1").
            '<p class="comment-content">'. $row['content']."</p><div ><span title='创建时间' >时间:".date('Y-m-d H:i:s',strtotime($row['date']))."</span><a title='点赞' href='javascript:void(0)' 
                onclick=\"dianzan(".$row['id'].",$blogid)\"
        	class='fr'>&nbsp;&nbsp;<i class='fa fa-thumbs-o-up'></i> (".$row['goods'].")</a> <a href='javascript:void(0)' 	onclick=\"comment(".$row['id'].",$blogid)\"   class='fr' title='评论'><i class='fa fa-commenting-o'></i>&nbsp;&nbsp;&nbsp;</a></div></div>";
            $id  = $row['id'];
            $sonstr = $this->getSonstr($id,$blogid);
            $str =  $str . $sonstr . "</li>";
       }
            $str = $str. "</ul>";
       return $str;
      }
      
      function addblogcomment($commentdata){
          $kItem = array();
          $dItem = array();
          foreach ($commentdata as $key => $data) {
              $kItem[] = $key;
              $dItem[] = $data;
          }
          $field = implode(',', $kItem);
          $values = "'" . implode("','", $dItem) . "'";
          $this->db->query("INSERT INTO " . DB_PREFIX . "comment ($field) VALUES ($values)");
      }
      
      function comment($commentdata){
          $kItem = array();
          $dItem = array();
          foreach ($commentdata as $key => $data) {
              $kItem[] = $key;
              $dItem[] = $data;
          }
          $field = implode(',', $kItem);
          $values = "'" . implode("','", $dItem) . "'";
          $this->db->query("INSERT INTO " . DB_PREFIX . "comment ($field) VALUES ($values)");      
      }
      
      function  addgoods($id)
      {
          $this->db->query("UPDATE " . DB_PREFIX . "comment SET goods=goods+1 WHERE id=$id ");
      }
}

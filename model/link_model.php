<?php
require_once dirname(__FILE__).'/../model/mysqlii.php';

class  link_model{
    private  $db;
    
    function __construct()
    {
        $this->db = MySqlii::getInstance();
    }
    
    function getAllLink(){
        $sql = "SELECT * FROM " . DB_PREFIX . "link WHERE 1";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['addTime'] = gmdate("Y-m-d H:i", strtotime($row['addTime']));
            $logs[] = $row;
        }
        return $logs;
    }
}
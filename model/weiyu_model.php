<?php
require_once dirname(__FILE__).'/../model/mysqlii.php';

class  weiyu_model{
    private  $db;
    
    function __construct()
    {
        $this->db = MySqlii::getInstance();
    }
    
    function getAll(){
        $sql = "SELECT * FROM " . DB_PREFIX . "weiyu WHERE 1";
        $res = $this->db->query($sql);
        $logs = array();
        while ($row = $this->db->fetch_array($res)) {
            $row['date'] = gmdate("Y-m-d H:i", strtotime($row['date']));
            $logs[] = $row;
        }
        return $logs;
    }
}
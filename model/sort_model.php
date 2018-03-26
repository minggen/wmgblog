<?php
/**
 * 文章分类
 * @copyright (c) Emlog All Rights Reserved
 */


require_once dirname(__FILE__).'/../model/mysqlii.php';
require_once dirname(__FILE__).'/../model/user_model.php';


class Sort_Model {

	private $db;

	function __construct() {
	    $this->db =  MySqlii::getInstance();
	}

	function getSorts() {
		$res = $this->db->query("SELECT * FROM ".DB_PREFIX."sort where 1");
		$sorts = array();
		while($row = $this->db->fetch_array($res)) {
			$row['sortname'] = htmlspecialchars($row['sortname']);
			$sorts[] = $row;
		}
		return $sorts;
	}

	function updateSort($sortname, $sid) {
	    $this->db->query("update ".DB_PREFIX."sort set sortname='$sortname' where sid=$sid");
	}

	function addSort($name, $description) {
		$sql="insert into ".DB_PREFIX."sort (sortname,description) values('$name','$description')";
		$this->db->query($sql);
	}

	function deleteSort($sid) {
		$this->db->query("update ".DB_PREFIX."blog set fl_id=-1 where sortid=$sid");
		$this->db->query("DELETE FROM ".DB_PREFIX."sort where sid=$sid");
	}

	function getOneSortById($sid) {
		$sql = "select * from ".DB_PREFIX."sort where sid=$sid";
		$res = $this->db->query($sql);
		$row = $this->db->fetch_array($res);
		$sortData = array();
		if ($row) {
			$sortData = array(
					'sortname' => htmlspecialchars(trim($row['sortname'])),
					'description' => htmlspecialchars(trim($row['description'])),
			);
		}
		return $sortData;
	}

	function getSortName($sid) {
		if ($sid > 0) {
			$res = $this->db->query("SELECT sortname FROM ". DB_PREFIX ."sort WHERE sid = $sid");
			$row = $this->db->fetch_array($res);
			$sortName = htmlspecialchars($row['sortname']);
		} else {
			$sortName = '未分类';
		}
		return $sortName;
	}
}

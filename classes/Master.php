<?php
require_once('../config.php');
Class Master extends DBCon {
	private $settings;
	
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}

	public function __destruct(){
		parent::__destruct();
	}

	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	
	function save_message(){
		$_POST['user_1'] = $this->settings->userdata('id');
		$_POST['user_2'] = $_POST['recipient_email'];
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(in_array($k,['subject','user_1','user_2'])){
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .= ", ";
				$data .= "`{$k}` = '{$v}'";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `conversation_list` set {$data}";
		}else{
			$sql = "UPDATE `conversation_list` set {$data} where id = '{$id}'";
		}
		$save = $this->conn->query($sql);
		if($save){
			$cid= empty($id) ? $this->conn->insert_id : $id ;
			$data = "conversation_id = '{$cid}'";
			$data .= ", from_user= '{$user_1}'";
			$data .= ", recipient_email= '{$user_2}'";
			$message = $this->conn->real_escape_string(htmlentities($message));
			$data .= ", message= '{$message}'";
			$sql2 = "INSERT INTO `message_list` set {$data}";
			$save_message = $this->conn->query($sql2);
			if($save_message){
				$resp['status'] = 'success';
				if(empty($id))
					$this->settings->set_flashdata('success',"Message has been sent.");
				else
					$this->settings->set_flashdata('success',"Message has been updated.");
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = 'Message sending failed';
				$resp['error'] = $this->conn->error;
				$resp['sql'] = $sql2;
				if(empty($id)){
					$this->conn->query("DELETE FROM `conversation_list` where id = {$cid}");
				}
		}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Message sending failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'find_user':
		echo $Master->find_user();
	break;
	case 'save_message':
		echo $Master->save_message();
	break;
	case 'delete_message':
		echo $Master->delete_message();
	break;
	case 'save_reply':
		echo $Master->save_reply();
	break;
	case 'mark_read':
		echo $Master->mark_read();
	break;
	case 'delete_convo':
		echo $Master->delete_convo();
	break;
	default:
		// echo $sysset->index();
		break;
}
<?php
require_once('../config.php');
Class Users extends DBCon {

	private $settings;

	public function __construct() {
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}

	public function __destruct(){
		parent::__destruct();
	}

	public function save_user() {
		if(empty($_POST['password'])) {
			unset($_POST['password']);
		} else {
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}

		extract($_POST);
		$oid = $id;
		$data = '';
		$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' ".($id>0? " and id!= '{$id}' " : ""))->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		foreach($_POST as $k => $v){
			if(!in_array($k,['id']) && !is_array($_POST[$k])){
				if(!empty($data)) $data .=" , ";
				$v = $this->conn->real_escape_string($v);
				$data .= " {$k} = '{$v}' ";
			}
		}
		
		if(empty($id)){
			$sql = "INSERT INTO users set {$data}";
		}else{
			$sql = "UPDATE users set $data where id = {$id}";
		}
		$save = $this->conn->query($sql);
		if($save) { // Save or Update user info
			$uid = empty($id) ? $this->conn->insert_id : $id;
			if(empty($id))
				$this->settings->set_flashdata('success','Your Account has been created successfully.');
			else
				$this->settings->set_flashdata('success','Your Account has been updated successfully.');

			$resp['status'] = 'success';
			if($this->settings->userdata('id') == $uid){
				foreach($_POST as $k => $v){
					if(!in_array($k,['id']) && !is_array($_POST[$k])){
						$this->settings->set_userdata($k,$v);
					}
				}
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Saving account failed.';
			$resp['error'] = $this->conn->error;
		}
		
		if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != ''){
			if(!is_dir(base_app."uploads/users"))
				mkdir(base_app."uploads/users");

			$fname = 'uploads/users/profile_photo-'.$uid.'.png';
			$dir_path = base_app.$fname;
			$upload = $_FILES['image']['tmp_name'];
			$type = mime_content_type($upload);
			$allowed = array('image/jpeg'); // 'image/png'
			if(!in_array($type,$allowed)) {
				$resp['msg'] .= " Image failed to upload due to invalid file type.";
			} else {
				$new_height = 200; 
				$new_width = 200; 
		
				list($width, $height) = getimagesize($upload);
				$t_image = imagecreatetruecolor($new_width, $new_height);
				imagealphablending( $t_image, false );
				imagesavealpha( $t_image, true );
				//$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				$gdImg = imagecreatefromjpeg($upload);
				imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				if($gdImg){
						if(is_file($dir_path))
						unlink($dir_path);
						$uploaded_img = imagepng($t_image,$dir_path);
						imagedestroy($gdImg);
						imagedestroy($t_image);
				} else {
					$resp['msg'] .= " Image failed to upload due to unkown reason.";
				}
			}
			if(isset($uploaded_img)){
				$this->conn->query("UPDATE users set `profile_photo` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}' ");
				if($uid == $this->settings->userdata('id')){
					$this->settings->set_userdata('profile_photo',$fname);
				}
			}
		}
		return  json_encode($resp);
	}
	public function delete_users(){
		extract($_POST);

		$profile_photo = $this->conn->query("SELECT profile_photo FROM users where id = '{$id}'")->fetch_array()['profile_photo'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			$profile_photo = explode("?", $profile_photo)[0];
			if(is_file(base_app.$profile_photo))
				unlink(base_app.$profile_photo);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save_user':
		echo $users->save_users();
	break;
	case 'delete_user':
		echo $users->delete_users();
	break;
	default:
		// echo 'silent';
	break;
}
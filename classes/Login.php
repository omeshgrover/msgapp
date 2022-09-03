<?php
require_once '../config.php';
class Login extends DBCon {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	public function login() {
		extract($_POST);
		if(
			($username == parent_data['email'] && $password == parent_data['password']) ||
			($username == teacher_data['email'] && $password == teacher_data['password']) ||
			($username == student_data['email'] && $password == student_data['password'])
		) {
			$type = 0;
			if($username == parent_data['email']) {
				$type = 1;
				$id = parent_data['id'];
				$firstname = parent_data['firstname'];
				$lastname = parent_data['lastname'];
				$email = parent_data['email'];
			} elseif($username == teacher_data['email']) {
				$type = 2;
				$id = teacher_data['id'];
				$firstname = teacher_data['firstname'];
				$lastname = teacher_data['lastname'];
				$email = teacher_data['email'];
			} elseif($username == student_data['email']) {
				$type = 3;
				$id = student_data['id'];
				$firstname = student_data['firstname'];
				$lastname = student_data['lastname'];
				$email = student_data['email'];
			}

			$this->settings->set_userdata('login_type',$type);
			$this->settings->set_userdata('id',$id);
			$this->settings->set_userdata('firstname',$firstname);
			$this->settings->set_userdata('lastname',$lastname);
			$this->settings->set_userdata('email',$email);
			$resp['status'] = 'success';

		/*
		$stmt = $this->conn->prepare("SELECT * from users where username = ? ");
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$data = $result->fetch_array();
			if(password_verify($password, $data['password'])){
				foreach($data as $k => $v){
					if(!is_numeric($k) && $k != 'password'){
						$this->settings->set_userdata($k,$v);
					}
				}
				$this->settings->set_userdata('login_type',1);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = 'Incorrect Username or Password';
			}*/
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = 'Incorrect Username or Password';
		}
		return json_encode($resp);
	}
	public function logout(){
		if($this->settings->sess_des()){
			redirect('login.php');
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login_user':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	default:
		echo $auth->index();
		break;
}


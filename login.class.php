<?php 
class LoginUser{
	// class properties
	private $login;
	private $password;
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;

	// class methods
	public function __construct($login, $password){
		$this->login = $login;
		$this->password = $password;
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		$this->login();
	}


	private function login(){
		foreach ($this->stored_users as $user) {
			if($user['login'] == $this->login){
				if(password_verify($this->password, $user['password'])){
					session_start();
					$_SESSION['user'] = $this->login;
					header("location: account.php"); exit();
				}
			}
		}
		return $this->error = "Неверный логин или пароль";
	}

}
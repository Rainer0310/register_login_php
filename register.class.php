<?php 


class RegisterUser{
	
	private $login;
	private $raw_password;
	private $raw_conf_pass;
	private $encrypted_password;
	private $encrypted_conf_pass;
    private $email;
	private $name;
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;
	private $new_user; 


	public function __construct($login, $password, $conf_pass, $email, $name){

		$this->login = trim($this->login = '');
		$this->login = filter_var($login, FILTER_UNSAFE_RAW);

		$this->raw_password = filter_var(trim($password), FILTER_UNSAFE_RAW);
		$this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

		$this->raw_conf_pass = filter_var(trim($password), FILTER_UNSAFE_RAW);
		$this->encrypted_conf_pass = password_hash($this->raw_password, PASSWORD_DEFAULT);

		$this->email = trim($this->email = '');
		$this->email = filter_var($email, FILTER_UNSAFE_RAW);

		$this->name = trim($this->name = '');
		$this->name = filter_var($name, FILTER_UNSAFE_RAW);

		$this->stored_users = json_decode(file_get_contents($this->storage), true);

		

		$this->new_user = [
			"login" => $this->login,
			"password" => $this->encrypted_password,
			"conf_pass" => $this->encrypted_conf_pass,
			"email" => $this->email,
			"name" => $this->name
		];

		if($this->checkFieldValues()){
			$this->insertUser();
		}
	}


	private function checkFieldValues(){
		if(empty($this->login) || empty($this->raw_password) || empty ($this->raw_conf_pass) || empty($this->email) || empty($this->name))
		{
			$this->error = "Все поля должны быть заполнены.";
			return false;
		}else{
			return true;
		}
	}


	private function usernameExists(){
		foreach($this->stored_users as $user){
			if($this->login == $user["login"]){
				$this->error = "Этот логин уже занят, пожалуйста, выберите другой";
				return true;
			}
		}
		return false;
	}




	private function insertUser(){
		if($this->usernameExists() == FALSE || $this->login_length() == FALSE ){
			array_push($this->stored_users, $this->new_user);
			if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
				return $this->success = "Регистрация прошла успешно";
				header ("location: http://localhost/login.php");
			}else{
				return $this->error = "Что-то пошло не так, попробуйте снова";
			}
			
		}
	}



} 
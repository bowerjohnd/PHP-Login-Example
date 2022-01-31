<?php

require_once 'classes/Pdo_methods.php';
		
class Register extends PdoMethods {
		
	function checkRegisterUsername() {
		
		// check if username already exists
		//	- if not, register user

		$pdo = new PdoMethods();

		$sql = 'SELECT username FROM members WHERE username = :username';

		$bindings = [
			[':username',$_POST['username'],'str']
		];

		try {
			$result = $pdo->selectBinded($sql, $bindings);

			if (count($result) > 0) {
				return 'That username is already taken.';
			}
			else {
				return $this->registerUser();
			}
		} catch (Exception $e) {
			return 'There was an error';
		}
	}

	function registerUser() {
				
		$pdo = new PdoMethods();

		$sql = "INSERT INTO members (username, email, password, login_type) VALUES (:username, :email, :password, :login_type)";

		$bindings = [
			[':username',$_POST['username'],'str'],
			[':email',$_POST['email'],'str'],
			[':password',password_hash($_POST['password'], PASSWORD_DEFAULT),'str'],
			[':login_type',"user",'str']
		];

		$result = $pdo->otherBinded($sql, $bindings);

		if ($result === 'error') {
			return 'There was an error registering';
		}
		else {
			return 'User has been added.';
		}
	}
	
	function displayRegister() {
		$display = '<p><h3>Register User</h3></p>'

			. '<p><form method="post" action="index.php?page=register">'

			. '<label for="username">Username: </label>'
			. '<input type="text" id="username" name="username"><br>'

			. '<label for="email">Email: </label>'
			. '<input type="text" id="email" name="email"><br>'

			. '<label for="password">Password: </label>'
			. '<input type="password" id="password" name="password"><br>'

			. '<input type="submit" name="submit_register" id="submit_login">'
			. '</form></p>'
			;

		return $display;
	}
}
?>




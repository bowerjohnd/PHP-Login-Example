<?php

	function displayUserInfo() {
		$userInfo = "";

		$userInfo .= '<p><h3>User Info</h3></p>'
			  . '<p>'
			  . 'User ID: ' . $_SESSION['userId'] . '<br />'
			  . 'Username: ' . $_SESSION['username'] . '<br />'
			  . 'Email: ' . $_SESSION['email'] . '<br />'
			  . 'Access: ' . $_SESSION['login_type']
			  . '</p>'
			  ;
		return $userInfo;		
	}
?>

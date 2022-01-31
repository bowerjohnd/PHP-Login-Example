<?php
session_start();

require_once 'php/nav.php';
$navc = new NavClass();
$nav = $navc->landing_nav();

$pageContent = "";

if (isset($_GET)) {
	if ($_GET['page'] === "home") {
		if (isset($_SESSION['username'])) {
			$nav = $navc->landing_nav();	// call again to update nav links

			$pageContent = "Welcome Back " . $_SESSION['username'] . "!";
		} else {
			$pageContent = "Welcome! Please login or register.";
		}
	}

	else if ($_GET['page'] === "login") {
		require_once 'php/login.php';
		$loginClass = new DBComm_Member_Login();
		
		if (isset($_POST['submit_login'])) {
			$pageContent = $loginClass->checkLoginCredentials();
		} else {
			$pageContent = $loginClass->displayLogin();
		}
	}
	
	else if ($_GET['page'] === "userInfo") {
		require_once 'php/userInfo.php';
		
		if (isset($_SESSION)) {
			$pageContent = displayUserInfo();
		} else {
			header("location: index.php?page=home");
		}
	}
	else if ($_GET['page'] === "logout") {
		header("Location: php/logout.php");
	}

	else if ($_GET['page'] === "register") {
		require_once 'php/registerUser.php';
		$registerClass = new Register();

		if (isset($_POST['submit_register'])) {
			$pageContent = $registerClass->checkRegisterUsername();
		} else {
			$pageContent = $registerClass->displayRegister();
		}
	}

	else if ($_GET['page'] === "editUser") {
		if ($_SESSION['login_type'] === "admin") {
			//require_once 'php/editUser.php';
			//$pageContent = displayEditUser();
			$pageContent = "Edit User coming soon!";
		} else {
			header("Location: index.php?page=home");
		}
	} else {
		header("Location: index.php?page=home");
	}
} else {
	header("Location: index.php?page=home");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login Example</title>
</head>
<body>
<div id="wrapper" class="container">

<a id="top"><h1>PHP Login Example</h1></a>
<p>
	<?php echo $nav; ?>
</p>

<p>
	<?php echo $pageContent; ?>
</p>

</div>
</body>
</html>

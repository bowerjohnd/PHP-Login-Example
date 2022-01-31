<?php
// landing nav does not show editing pages

Class NavClass {

// &nbsp; = 1 space
// &ensp; = 2 spaces
// &emsp; = 4 spaces

	function check_login_type() {
		if ($_SESSION['login_type'] == "admin") {
			return $this->admin_nav();
		} else if ($_SESSION['login_type'] == "user") {
			return $this->user_nav();
		} else {
			return $this->landing_nav();
		}
	}

	function landing_nav() {
		if (isset($_SESSION['login_type'])) {
		       if ($_SESSION['login_type'] == "admin") {
				return $this->admin_nav();
		       } else if ($_SESSION['login_type'] == "user") {
			       return $this->user_nav();
		       }
		}
		
		$tab = '&emsp;';

		$navDisplay = "";
		$navDisplay .= '<center>';

		$navDisplay .= '<a href="index.php">Home</a>'
			. $tab
			. '<a href="index.php?page=register">Register</a>'
			. $tab
			. '<a href="index.php?page=login">Login</a>'
			;

		$navDisplay .= '</center>';
		
		return $navDisplay;
		
	}

	function admin_nav() {

		if ($_SESSION['login_type'] != "admin") {
			return $this->landing_nav();
		} else {
		
		$tab = '&emsp;';

		$navDisplay = "";
		$navDisplay .= '<center>';

		$navDisplay .= '<a href="index.php">Home</a>'
		        . $tab	
			. '<a href="index.php?page=userInfo">My Info</a>'
			. $tab
			. '<a href="index.php?page=editUser">Edit User</a>'
			. $tab
			. '<a href="php/logout.php">Logout</a>'
			;

		$navDisplay .= '</center>';

		return $navDisplay;
		
		}
	}

	function user_nav() {

		if ($_SESSION['login_type'] != "user") {
			return $this->landing_nav();
		} else {
		
		$tab = '&emsp;';

		$navDisplay = "";
		$navDisplay .= '<center>';

		$navDisplay .= '<a href="index.php">Home</a>'
		        . $tab	
			. '<a href="index.php?page=userInfo">My Info</a>'
			. $tab
			//. '<a href="index.php?page=editSelf">Edit Self</a>'
			//. $tab
			. '<a href="php/logout.php">Logout</a>'
			;

		$navDisplay .= '</center>';

		return $navDisplay;
		
		}
	}
}

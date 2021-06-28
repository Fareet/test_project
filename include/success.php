<?php

session_start();
$success = false;
$lastPassword = "";
$serverName = 'localhost';
$userName = 'root';
$userPassword = '123123';
$dbName = 'mysql';
if (!empty($_SESSION['login'])) {
	$lastLogin = $_SESSION['login'];
}

$connection = mysqli_connect($serverName, $userName, $userPassword, $dbName);
if (mysqli_connect_errno()) {
	echo mysqli_error($connection);
} else {
	$result = mysqli_query($connection, "select login, password from lessons.users");
	while($row = mysqli_fetch_assoc($result)) {
		$logins[] = $row;
	}
}
foreach($logins as $key) {
	if (!empty ($_SESSION)) {
		if ($_SESSION['login'] == $key['login'] and $_SESSION['password'] == $key['password']) {
			$success = true;
			ini_set('session.cookie_lifetime', 1200);
		} else {
			$success = false;
		}
	}
	if (!empty ($_POST)) {
		if ($_POST['login'] == $key['login'] and $_POST['password'] == $key['password']) {
			$success = true;
			header ('Location: /');
		} else {
			$success = false;
			$lastLogin = $_POST['login'];
			$lastPassword = $_POST['password'];
		}
	}
	if ($success) {
		ini_set('session.cookie_lifetime', 1200);
		$_SESSION['login'] = $key['login'];
		$_SESSION['password'] = $key['password'];
		return $success;
		break;
	}
}
?>
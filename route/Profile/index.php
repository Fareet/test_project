<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates /header.php';
function profile($connection) {
	if (mysqli_connect_errno()) {
		echo mysqli_error($connection);
	} else {
		$result = mysqli_query($connection,

		"SELECT u.*, g.name AS group_name FROM lessons.users AS u
		LEFT JOIN lessons.groups AS g ON u.id = g.user_id;");
		while($row = mysqli_fetch_assoc($result)) {
			if($row['login'] == $_SESSION['login']){
				$login = $row['login'];
				$name = $row['name'];
				$email = $row['email'];
				$phone = $row['phone'];
				$activity = $row['activity'];
				$receiveEmail = $row['consent_to_receive_email_notifications'];
				$groups[] = $row['group_name'];
			}
		}
	}
	$strGroup ="Группы : ";
	$checkActivity = (boolval($activity) ? 'checked' : '');
	$checkReceiveEmail = (boolval($receiveEmail)? 'checked' : '');
	echo 'Login: '. $login . '<br>';
	echo 'Name: '. $name . '<br>';
	echo 'Email: '. $email . '<br>';
	echo 'Phone: '. $phone . '<br>';
	foreach ($groups as $group){
		$strGroup .= $group . ", ";
	}
	$strGroup = substr($strGroup,0,-2);
	echo($strGroup. '<br>');
	echo'<br>'.'<br>'.'<br>'.'<br>'.'<br>';
	echo 'Activity: '. "<input type='checkbox' disabled=true " . $checkActivity .">". '<br>' ;
	echo 'Consent to receive email notifications: '. "<input type='checkbox' disabled=true "  . $checkReceiveEmail .">". '<br>' ;
	
}
?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">

				<h1>Профиль</h1>
				<p><?=profile($connection)?><p>
			</td>
            <td class="right-collum-index">
				
				<div  class="project-folders-menu">
					<ul class="project-folders-v">
    					<?=Authorization()?>
				    <div class="clearfix"></div>
				</div>

			</td>
        </tr>
    </table>
<?include $_SERVER['DOCUMENT_ROOT'] . './templates /footer.php'?>
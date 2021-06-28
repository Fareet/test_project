<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';

$result = mysqli_query($connection,
	"SELECT u.*, g.name AS group_name FROM lessons.users AS u
	LEFT JOIN lessons.groups AS g ON u.id = g.user_id;");
while($row = mysqli_fetch_assoc($result)) {
	if($row['login'] == $_SESSION['login']) {
		$addressee_id = $row['id'];
		$groups[] = $row['group_name'];
	}
}
function Posts($addressee_id, $groups, $connection){
	if(in_array("Пользователь имеющий право писать сообщения", $groups)){
		$result = mysqli_query($connection,
			"SELECT m.*, s.name AS sections_name  FROM lessons.message as m
			LEFT JOIN lessons.sections AS s ON s.id = m.section_id;");
		while($row = mysqli_fetch_assoc($result)) {
			if($row['addressee_id'] == $addressee_id and $row['is_reading'] == 0) {
				echo  "<p>&#10026;<a href = '/route/Posts/write/?" . $row['id'] . "'>". $row['header'] .'  '. $row['sections_name'] . '</a></p>';
			}
		}
	} else{
	echo "Вы сможете отправлять сообщения после прохождения модерации.";	
	}
}
function Posts2($addressee_id, $groups, $connection){
	if(in_array("Пользователь имеющий право писать сообщения", $groups)){
		$result = mysqli_query($connection,
			"SELECT m.*, s.name AS sections_name  FROM lessons.message as m
			LEFT JOIN lessons.sections AS s ON s.id = m.section_id;");
		while($row = mysqli_fetch_assoc($result)) {
			if($row['addressee_id'] == $addressee_id and $row['is_reading'] == 1) {
				echo  "<p><a href = '/route/Posts/write/?" . $row['id'] . "'>". $row['header'] .'  '. $row['sections_name'] . '</a></p>';
			}
		}
	} else{
	echo "Вы сможете отправлять сообщения после прохождения модерации.";	
	}
}
include $_SERVER['DOCUMENT_ROOT'] . '/templates /header.php';


?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">
			
				<h1>Новые сообщения</h1>
				<p><?=Posts($addressee_id, $groups, $connection)?></p>
				
			</td>
			<td class="left-collum-index">
			
			<h1>Прочитанные сообщения</h1>
			<p><?=Posts2($addressee_id, $groups, $connection)?></p>
			</td>
			<td class="left-collum-index">
			
			<h1>Новое сообщение</h1>
			<button> <a href = "/route/Posts/add">Написать сообщение </a></button>
			</td>
        </tr>
        </tr>
    </table>
<? include $_SERVER['DOCUMENT_ROOT'] . '/templates /footer.php'?>
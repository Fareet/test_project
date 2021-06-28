<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
$arrKeys = array_keys($_GET);
$result = mysqli_query($connection,
	"UPDATE lessons.message SET is_reading = '1' Where id = '$arrKeys[0]'");

function profile($connection) {
	$arrKeys = array_keys($_GET);
	if (mysqli_connect_errno()) {
		echo mysqli_error($connection);
	} else {
		$result = mysqli_query($connection,

		"SELECT m.*,u.name AS sender_name, u.email AS sender_email  FROM lessons.message AS m
		LEFT JOIN lessons.users AS u ON u.id = m.sender_id;");
		while($row = mysqli_fetch_assoc($result)) {
			if($row['id'] == $arrKeys[0]){
				$header = $row['header'];
				$date = $row['date_time'];
				$text = $row['report'];
				$senderName = $row['sender_name'];
				$senderMail = $row['sender_email'];
			}
		}
	}
	echo '<h1>'. $header .'</h1><br>';
	echo '<p> Время получения: '. $date . '</p><br>';
	echo '<p> Сообщение: '. $text . '</p><br>';
	echo '<p> Отправитель: '. $senderName . "          " . $senderMail .'</p><br>';
}
include $_SERVER['DOCUMENT_ROOT'] . '/templates /header.php';
?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">
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
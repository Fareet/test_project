<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';

$result = mysqli_query($connection,
"SELECT u.* FROM lessons.users AS u
");
while($row = mysqli_fetch_assoc($result)) {
	if($row['login'] != $_SESSION['login']) {
		$addressee[] = $row['login'];
	}
}
$result = mysqli_query($connection,
	"SELECT u.*, g.name AS group_name FROM lessons.users AS u
	LEFT JOIN lessons.groups AS g ON u.id = g.user_id;");
while($row = mysqli_fetch_assoc($result)) {
	if($row['login'] == $_SESSION['login']) {
		$sender_id = $row['id'];
	}
}
$result = mysqli_query($connection,
	"SELECT s.*, c.name AS sections_color FROM lessons.sections AS s
	LEFT JOIN lessons.colors AS c ON s.color_id = c.id;");
while($row = mysqli_fetch_assoc($result)) {
	$sections[] = $row['name'];
	$colors[] = $row['sections_color'];
	
}
function addressee($addressee) {
	foreach($addressee as $key) {
		echo '<option  value = ' .$key .'>' . $key . '</option>';
	}
}
function sections($sections) {
	for($i=0; $i<count($sections); $i++) {
		echo '<option>' . $sections[$i] . '</option>';
	}
}
function colors($colors) {
	for($i=0; $i<count($colors); $i++) {
		echo '<option>' . $colors[$i] . '</option>';
	}
}
if(isset($_POST['Send'])) {
	if (!empty ($_POST)) {
		$result = mysqli_query($connection,
		"SELECT * FROM lessons.users");
		while($row = mysqli_fetch_assoc($result)) {
			if($row['login'] == $_POST['addressee']) {
				$addressee_id = $row['id'];
			}
		}
		$result = mysqli_query($connection,
		"SELECT * FROM lessons.sections");
		while($row = mysqli_fetch_assoc($result)) {
			if($row['name'] == $_POST['sections']) {
				$sectionsID = $row['id'];
			}
		}
		$text = $_POST['text'];
		$header = $_POST['header'];
		(string)$today = date("Y-m-d H:i:s");
		$sql = "INSERT INTO lessons.message (report, header, date_time, sender_id, addressee_id, section_id, is_reading) VALUES ('$text', '$header', '$today', '$sender_id', '$addressee_id', '$sectionsID', '0')";
		if (mysqli_query($connection, $sql)) {
			header("Location: /route/Posts/");
			exit;
		} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($connection);
		}	
	} else {
		echo 'Невозможно отправить сообщение';
	}
}
include $_SERVER['DOCUMENT_ROOT'] . '/templates /header.php';
?>
<html>
<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">
			
				<h1>Сообщения</h1>
			
			</td>
        </tr>

		<form action = '/route/Posts/add/' method="post" width = "100%" >
			<table border="4" cellspacing="0" cellpadding="0">
				<tr>
					<td class="iat">
						<label for="header">Заголовок</label>
						<input id="header" size="100" required  name="header"value="">
					</td>
				</tr>
				<tr>
					<td class="iat">
						<label for = "text">Текст сообщения:</label>
						<input id = "text_id" size = "50" required   name = "text"  value = "" >
					</td>
				</tr>
				<tr>
					<td class="iat">
						<label for = "password_id">Получатель:</label>
						<select name = "addressee">
						<?= addressee($addressee)?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="iat">
						<label for = "section_id">Раздел сообщения:</label>
						<select name = "sections">
						<?= sections($sections)?>
						</select>
					</td>
					<td class="iat">
						<label for = "color_id">Цвет раздела:</label>
						<select name = "color">
						<?= colors($colors)?>
						</select>
					</td>
				</tr>

				<tr>
					<td><input type="submit" value="Отправить" name="Send" float ='right'></td>
				</tr>
			</table>	
		</form>
    </table>
<? include $_SERVER['DOCUMENT_ROOT'] . '/templates /footer.php'?>
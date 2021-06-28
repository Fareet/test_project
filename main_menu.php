<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/success.php';
$url = $_SERVER['REQUEST_URI'];
$menu = [
	[
		'title' => 'Главная',
		'path' => '/',
		'sort' => 10,
	],
	[
		'title' => 'О нас',
		'path' => '/route/About/',
		'sort' => 2,
	],
	[
		'title' => 'Contacts',
		'path' => '/route/Contacts/',
		'sort' => 30,
	],
	[
		'title' => 'Новости',
		'path' => '/route/News/',
		'sort' => 4,
	],
	[
		'title' => 'Каталог',
		'path' => '/route/Catalog/',
		'sort' => 50,
	],
	[
		'title' => 'Профиль',
		'path' => '/route/Profile/',
		'sort' => 100,
	],
	[
		'title' => 'Massage',
		'path' => '/route/Posts/',
		'sort' => 90,
	],
];


function showMenu($path) {
	global $menu, $title, $url, $success;
	if( $path == 'header') {
		$menu = arraySort($menu,'sort',SORT_ASC);
		foreach($menu as $key) {
			if(strlen ($key["title"])>15) {
				$key["title"] = cutString($key["title"], 12, "...");
			}
			if(!$success) {
				$path = '/route/Autorization/';
			} else {
				$path = $key["path"];
			}		
			if($key["path"] == $url) {
				ini_set('session.cookie_lifetime', 1200);
				$title = $key["title"];
				echo '<li style = "text-decoration :underline;font-size: 16px""><a  href = ' . $path . '>' . $key["title"] . '</a></li>';
			} else {
				echo '<li style = "font-size: 16px"><a href = ' . $path . '>' . $key["title"] . '</a></li>';
			}
		}
	}
	else if($path  == 'footer') {
		$menu = arraySort($menu,'title',SORT_DESC);
		foreach ($menu as $key) {
			if(strlen($key["title"])>15){
				$key["title"] = cutString($key["title"],12,"...");
			}
			if(!$success) {
				$path = '/route/Autorization/';
			} else {
				$path = $key["path"];
			}			
			echo '<li style = "font-size: 12px"><a href = ' . $path . '>' . $key["title"] . '</a></li>';
		}
	}
}


function arraySort(array $array, $key, $sort): array
{
	$keys = array_column($array, $key);
	array_multisort($keys, $sort, $array);
	return $array;
}


function cutString($line, $length, $appends): string
{
	$str = "";
	$line = str_split($line);
	for($i=$length-1; $i< count($line);$i++){
		$line[$i] = "";
	}
	foreach($line as $words){
		$str .= $words;
	}
	return $str .= $appends;
}
?>

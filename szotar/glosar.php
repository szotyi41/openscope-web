<?php
define('GLOSAR_DATA', 'data/glosar.txt');

$glosar = array();

function read($glosar_data) {
	$glosar_data = file($glosar_data);
	foreach ($glosar_data as $entry) {
		$cells = explode("\t", $entry);
		$glosar[] = array(
			'en' => trim($cells[0]),
			'hu' => trim($cells[1]),
			'state' => trim($cells[2])
		);
	}
	return $glosar;
}

function search($glosar, $term) {
	if (!$glosar) {
		echo 'ERROR: glosar not found!';
		return array();
	}
	
	if (strlen($term) < 2) {
		return array();
	}
	
	$result = array();
	foreach ($glosar as $entry) {
		if (strpos($entry['en'], $term) !== FALSE) {
			$result[] = $entry;
		}
	}
	
	return $result;
}

// == The main program ==

$glosar = read(GLOSAR_DATA);

$action = null;
if (isset($_POST['action'])) {
	$action = $_POST['action'];
}
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if ($action) {
	switch ($action) {
		case 'search':
			if (isset($_POST['term'])) {
				echo json_encode(search($glosar, $_POST['term']));
			}
			break;
			
		case 'update':
			break;
			
		case 'add':
			break;
			
		case 'download':
			break;
			
		default:
			echo 'ERROR: unsupported action!';
	}
}

?>
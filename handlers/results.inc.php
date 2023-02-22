<?php 

include_once('../services/initDB.php');
include_once('../services/results.class.php');

$db = new InitDB();
$result_obj = new Results($db);


$parties = $result_obj->get_party();

if (isset($_POST['submit'])) {
	$party = $_POST['party'];
	$unit = $_POST['unit'];
	$score = $_POST['score'];
	$staff = $_POST['staff'];
	$ip_address = $_POST['ip_address'];
	echo $result_obj->store($unit, $party, $score, $staff, $ip_address);

}
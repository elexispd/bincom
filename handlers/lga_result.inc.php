<?php 
include_once('../services/initDB.php');
include_once('../services/results.class.php');

$db = new InitDB();
$polling_result_obj = new Results($db);


// if (isset($_GET["unique_id"])) {
// 	$polling_id = htmlspecialchars($_GET["unique_id"]);
// } else {
// 	$polling_id = 1;
// }


// $polling_results = $polling_result_obj->get_polling_results($polling_id);


// if (isset($_GET["lga"])) {
// 	$lga_id = htmlspecialchars($_GET["lga"]);
// } else {
// 	$lga_id = 1;
// }
$lga = $polling_result_obj->get_lga();


// Retrieve data from the database based on the selected option

if (isset($_POST['lga'])) {
	$lga_id = $_POST['lga'];
	$lga_results = $polling_result_obj->get_total_lga_results($lga_id);

	$table_html = '';
	$total_vote = 0;

	if ($lga_results !== false) {
		$count = 1;
		foreach ($lga_results as  $row) {
		  $table_html .= '<tr>';
		  $table_html .= '<td>' . $count++ . '</td>';
		  $table_html .= '<td>' . $row['party_abbreviation'] . '</td>';
		  $table_html .= '<td>' . $row['party_score'] . '</td>';
		  $table_html .= '</tr>';
		  $total_vote += $row['party_score'];
		}
	}
	


	$output = [
		"tag" => $table_html,
		"total_vote" => $total_vote
	];

	// Return the HTML code for the table rows
	echo json_encode($output);

} 





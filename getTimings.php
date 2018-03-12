<?php
include "login.php";

// $venue = $_POST['venue'];
$venue = "R City";
// echo "$venue";

$sql = "SELECT date_time FROM performance WHERE venue=\"$venue\"";

$conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pwd);

$venue_array = array();

foreach ($conn->query($sql) as $row) {
	$datetime = $row['date_time'];

	// array_push($venue_array, $datetime);

	$venue_array[] = array("date_time" => $datetime);
}
// $resp = null;
// $resp->length = sizeof($venue_array);
// $resp->dtlist = $venue_array;

// header('Content-Type: application/json');

echo json_encode($venue_array);
?>
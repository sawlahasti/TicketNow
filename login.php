<?php
//login details
//remote login details
//$host = 'us-cdbr-iron-east-04.cleardb.net';
//$dbname = 'heroku_61d99bfa265282c';
//$user = 'bf48dddc121d4f';
//$pwd = '64a9add4'; 

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$host = $url["host"];
$user = $url["user"];
$pwd = $url["pass"];
$dbname = substr($url["path"], 1);

// localhost login details
// $host = 'localhost';
// $dbname = 'Booking_DB';
// $user = 'root';
// $pwd = '';

?>

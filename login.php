<?php
//login details
//remote login details
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $host = $url["host"];
// $user = $url["user"];
// $pwd = $url["pass"];
// $dbname = substr($url["path"], 1);

// localhost login details
$host = 'localhost';
$dbname = 'Booking_DB';
$user = 'root';
$pwd = '';

?>

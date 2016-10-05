<?php

require 'Controller/MovieController.php';
$movieController = new MovieController();

if(isset($_POST['types'])) {
        $movieTables = $movieController->CreateMovieTable($_POST[types]);
}
else {
        $movieTables = $movieController->CreateCoffeeTables('%'); 
}

$title = 'Movie Overview';
$content = $movieController->CreateMovieDropdownList().$movieTables;

include 'template.php';
?>

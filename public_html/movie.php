<?php

require ('Controller/MovieController.php');
$movieController = new MovieController();

if(isset($_POST['types'])) {
        $movieTables = $movieController->CreateMovieTables($_POST[types]);
}
else {
        $movieTables = $movieController->CreateMovieTables('%'); 
}

$title = 'Movie Overview';
$content = $movieController->CreateMovieDropdownList().$movieTables;

include 'template.php';
?>

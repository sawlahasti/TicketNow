<?php

require ('Entities/MovieEntity.php');

class MovieModel {
        
        function GetMovieTypes() {
                require 'Credentials.php';

                mysql_connect($host,$user,$passwd) or die(mysql_error());
                mysql_select_db($database);

                $result = mysql_query("SELECT DISTINCT Description FROM Movie") or die(mysql_error());
                $types = array();

                while($row = mysql_fetch_array($result)) {
                        array_push($types, $row[0]);
                }

                mysql_close();
                return $types;
        }

        function GetMovieByType($type) {
                require 'Credentials.php';

                mysql_connect($host, $user, $passwd) or die(mysql_error());
                mysql_select_db($database);
                
                $query = "SELECT * FROM Movie WHERE Description LIKE '$type'";
                $result = mysql_query($query) or die(mysql_error());
                $movieArray = array();

                while($row = mysql_fetch_array($result)) {
                        $Name = $row[1];
                        $Description = $row[2];
                        $Date = $row[3];
                        $Language = $row[4];
                        $Rating = $row[5];
                        $Image = $row[6];

                        $movie = new MovieEntity(-1,$Name,$Description,$Date,$Language,$Rating,$Image);
                        array_push($movieArray, $movie);

                        mysql_close();
                        return $movieArray;
                }
        }
}

?>

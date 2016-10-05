<?php

require 'Model/MovieModel.php';

class MovieController {

        function CreateMovieDropdownList() {
                $movieModel = new MovieModel();
                $result = "<form action = '' method = 'post' width = '200px'>
                           Please select a type :
                           <select name = 'types' >
                                <option value = '%' >All</option>
                                ".$this->CreateOptionValues($movieModel->GetMovieTypes()).
                           "</select>
                            <input type = 'submit' value = 'Search'/>
                            </form>";
                
                return $result;
        }
        
        function CreateOptionValues(array $valueArray) {
                $result = "";

                foreach ($valueArray as $value) {
                        $result = $result . "<option value = '$value'>$value</option>";
                }
                
                return $result;
        }

        function CreateMovieTables($types) {
                $movieModel = new MovieModel();
                $movieArray = $movieModel->GetMovieByType($types);
                $result = "";

                foreach($movieArray as $kay => $movie) {
                        $result = $result.
                                "<table class = 'movieTable'>
                                        <tr>
                                                <th rowspan='6' width = '150px'><img runat = 'server' src = '$movie->Image' /></th>
                                                <th width = '75px' >Name: </th>
                                                <td>$movie->Name</td>
                                        </tr>
                                        
                                        <tr>
                                                <th>Description: </th>
                                                <td>$movie->Description</td>
                                        </tr>
                                        
                                        <tr>
                                                <th>Date of Release: </th>
                                                <td>$movie->Date</td>
                                        </tr>
                                            
                                        <tr>
                                                <th>Language: </th>
                                                <td>$movie->Language</td>
                                        </tr>
                                        
                                        <tr>
                                                <th>Rating: </th>
                                                <td>$movie->Rating</td>
                                        </tr>
                                        
                                </table>";
                }
                return $result;
        }
}


?>

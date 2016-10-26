<?php
require_once 'login.php';
$sessionId = session_id();
// include 'menu.php';
ini_set('session.cache_limiter', 'private');
echo <<<_END
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <title>TicketNow</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="css/layout.css">
  <script src="js/modernizr.js"></script>
</head>
<body>
   <header>

      <div class="row">

         <div class="twelve columns">

            <div class="logo">
               <a href="index.html"><img alt="" src="images/logo1.png"></a>
            </div>

            <nav id="nav-wrap">

               <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
              <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

               <ul id="nav" class="nav">

                 <li class="current"><a href="index.html">Home</a></li>
                 <li><span><a href="#">Movies</a></span>
                     <ul>
                        <li><a href="bookseats.php#chooseseat">In Theatres</a></li>
                        <!-- <li><a href="here.html">Coming Soon</a></li> -->
                     </ul>
                  </li>
                 <!--  <li><span><a href="#">Events</a></span>
                     <ul>
                        <li><a href="#">Live</a></li>
                        <li><a href="#">Coming Soon</a></li>
                     </ul>
                  </li>--> 
                 <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li><span><a href="#">You</a></span>
                     <ul>
                        <li><a href="log_on.php">Login</a></li>
                        <li><a href="validate_reg_input.php">Register</a></li>
                        <li><a href="view_orders.php">Bookings</a></li>
                     </ul>
                  </li>
               </ul> 
            </nav> 

         </div>
      </div>

   </header> 
<div id="page-title">

      <div class="row">

         <div class="ten columns centered text-center">
            <h1>Select Your Seat<span>.</span></h1>
            <p>Your Seat Your Choice.</p>
 </div>

      </div>
   </div>
<div class = "row">
</div>
<form method="post" action="bookseats.php">
<input type="submit" value='Change Selection'/>
  </form>
<section id="journal">

      <div class="row">
         <div class="twelve columns align-center">
            <h1>Available Seats.</h1>
         </div>
      </div>

      <div class="blog-entries">
      <article class="row entry">

            <div class="entry-header">

_END;
	
try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);

      if (checkset())
      {
         if(isset($_POST['title']) &&
     	 isset($_POST['date']) &&
		 isset($_POST['area']))
		 {
		    $title = sanitizeString($_POST['title']);    
		    $date = sanitizeString($_POST['date']); 		
		    $area= sanitizeString($_POST['area']); 
            
		   $_SESSION['title'] = $title;
		   $_SESSION['date'] = $date;
		   $_SESSION['area'] = $area;		 	
			$_SESSION['name'] = $sessionId;
		    $_SESSION['name'] == "" ? $username =$sessionId: $username=$_SESSION['name'];
		   
		   		   		   
		  
			
		 // first check number rows 
		   $sql = "SELECT COUNT(*)   
          from  seat , Performance, Production ,tarea
          where not exists (select Booking.row_no from Booking where Booking.row_no = seat.row_no) AND
          Performance.title = '$title' AND
          Performance.date_time= '$date'
          AND  seat.area_name = '$area' AND
          Production.title = Performance.title 
          AND seat.area_name = tarea.name  ";
		    
      	if ($res = $conn->query($sql)) 
		   {   
		       $count= 0;
			   $count1= 0;
			 
		      /* Check the number of rows that match the SELECT statement */
              if ($res->fetchColumn() > 0) 
			  {  
			     
				                 
		         /* actual SELECT statement */
                 $sql =  " select seat.row_no AS seat, seat.area_name AS area ,Performance.title  AS title ,DATE(Performance.date_time) AS date,TIME(Performance.date_time ) AS time ,(Production.basicPrice * tarea.price_multiplier ) AS price 
                 from  seat , Performance, Production ,tarea 
                 where not exists (select Booking.row_no from Booking where Booking.row_no = seat.row_no) AND
                 Performance.title = '$title' AND
                 Performance.date_time= '$date'
                 AND  seat.area_name = '$area' AND
                 Production.title = Performance.title 
                 AND seat.area_name = tarea.name limit 200 ";
		       
		         echo "<p><h5>Your Selection - </h5>Theatre - " .$area ." " . "<br>Movie - ".$title. "<br>Time - " . formatDate($date). '</p>';
		   //       echo "".'Seat #' .'-'. "  area  " .'  -  '."  title  ".'   -   '."  date  " .'   -   '."  time  " .' - '."  price  ". '<br />';
				 // echo"__________________________________________________________________________________________";
				 //  echo '<br />'.'<br />';
				  
                 foreach ($conn->query($sql) as $row) 
				  {
				     
                     //print $row['seat'];
                      // print $row['seat'].' - '. $row['area'].' - '. $row['title'].' - '. $row['date'] .' - '. $row['time'] .' - '.'£'.$row['price'].'<br />';
					  $count++; 
					  $count1++;
					  if($count==11) {
					  		echo "<br>";
					  	}
					  if($count>20) {
					  		echo "<br>";
					  		$count=1;
					  	}
					  //echo $count;
					  $pieces = explode(" ", $row['seat']);
					  $arr = preg_split('/(?<=[A-Z])(?=[0-9]+)/i',$pieces[0]);
					  while("0".$count!=$arr[1] || $count!=$arr[1]) {
					  	echo "<input type='submit' style='width:77.03px; height: 53.98px; padding: 0; background:#3d4145;' value='SOLD'/>  ";
					  	if($count==5 || $count==15) {
					  		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					  	}
					  	$count++;
					  	if($count>20) {
					  		echo "<br>";
					  		$count=1;
					  		break;
					  	}
					  }
					  if($count==11) {
					  		echo "<br>";
					  	}
					 echo "<form style='display: inline;' action=\"Booking.php\"  method=\"post\">".
					  "<input type=\"hidden\"  name=\"seat\" value=". $row['seat']."/>".
					  "<input type=\"hidden\"  name=\"area\" value=". $row['area']."/>".
					  "<input type=\"hidden\"  name=\"price\" value=". $row['price']."/>".
					  "<input type=\"hidden\"  name=\"title\" value=". $row['title']."/>".
					  "<input type=\"hidden\"  name=\"date\" value=". $row['date']."/>".
					  "<input type=\"hidden\"  name=\"date\" value=". $row['time']."/>".
					  "<input type=\"submit\" style='width:77.03px; height: 53.98px;' value=$pieces[0] />  </form>";
					  // $count=$count%20;
					  if($count==5 || $count==15) {
					  		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					  	}
					  // echo $arr[0];
					  // echo $arr[1];       
				}
				  
		        echo '<br />'. "There  are " .  $count1 . " seats avalaible ".'<br />';
				 	
		         }
			     else
			     {
			      print "No rows matched the query." .'<br />';				  
				  echo "<a href=bookseats.php".'>' ." please check Theater Performance Times ".'</a> ';
				  die();
			
			     }
		   	
            }
		 
         }
	
	    }
	        else
            {
                   echo "please select time date and area for the Performance" .'<br />';
	              echo "<a href=bookseats.php".'>back '.'</a> ';
				  die();
            }
  }

 catch(PDOException $e) 
 {
 echo $e->getMessage();
 }

echo <<<_END

<footer>

      <div class="row">

         <div class="twelve columns">

            <ul class="footer-nav">
					      <li><a href="#">Home</a></li>
              	<li><a href="bookseats.php#chooseseat">Movies</a></li>
              	<li><a href="about.html">About</a></li>
              	<li><a href="contact.html">Contact</a></li>
                <li><a href="view_orders.php">You</a></li>
			   </ul>

            <ul class="footer-social">
               <li><a href="#"><i class="fa fa-facebook"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter"></i></a></li>
               <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
               <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
               <li><a href="#"><i class="fa fa-skype"></i></a></li>
               <li><a href="#"><i class="fa fa-rss"></i></a></li>
            </ul>

            <ul class="copyright">
               <li>Copyright &copy; 2016 TicketNow</li> 
               <li>Design by <a target=blank href="http://www.somaiya.edu/kjsce/">DHV</a></li>               
            </ul>

         </div>

         <div id="go-top" style="display: block;"><a title="Back to Top" href="#">Go To Top</a></div>

      </div>

   </footer>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
   <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>

   <script src="js/jquery.flexslider.js"></script>
   <script src="js/doubletaptogo.js"></script>
   <script src="js/init.js"></script>

</body>

</html>


_END;
// security for sql injection
function sanitizeString($var)
{
$var = stripslashes($var);
$var = htmlentities($var);
$var = strip_tags($var);
return $var;
}
//security for sql injection
function sanitizeMySQL($var)
{
$var= mysql_real_escape_string($var);
$var= sanitizeString($var);
return $var;
}
function formatDate($date)
{

 return  date("l F jS , Y - g:ia",strtotime($date));
}

function formatBritishDate($date)
{
 
return $newDate = date("d-m-Y", strtotime($date));
}
function foo($anArray)
 {
   if(empty($anArray))
   {
   
     return "empty";
   }
   foreach($anArray as $element)
   {
     echo $element;
   }
   return true;
 }
 function emptyRows($anArray)
 {
 if(empty($anArray))
   {
     echo "empty";
   }
   return true;
 }
  function checkSet(){
  return isset($_POST['title'], $_POST['date'], $_POST['area']);
}
function queryMysql($query)
{
$result = mysql_query($query) or die (mysql_error());
return $result;
}
function getCount($count){
return $count;
}
?>
</body></html>
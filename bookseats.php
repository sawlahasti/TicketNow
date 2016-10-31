<?php
/*

This a naive theatre booking system it allow users to select from list of perfomance and theatre area which are displayed on the home page -bookseats.php
after selecting  one area and performance users are shown list of seats available in that area .The user can book as many seats as they wish but one seat at a time.
The selected seat is then added to basket and seats are shown to the user for confirmation as they are added to cart.user can then decide to cancel or confirm the booking .
if confirmed the system offers user options of printing ticket or cancelling the booking. 
if cancel is selected recorded are deleted from both the Booking table and nwBooking table .nwBooking table is temporal table that is use to store the cart before confirmation of booking selected item are stored in this table.After confirmation of booking records are updated on nwBooking and inserted into Booking table e.g names are upadated with real names suplied by user.If cancel depending on the stage the records are delected from the nwBooking table or/and Booking table.
this system is still very naive ..
*/

session_start();
require_once 'login.php';
ini_set('session.cache_limiter', 'private');
$sessionId = session_id();
if (isset($_SESSION['name']))
$username = $_SESSION['name'];
else 
$username = $sessionId ;

 //  	if (checkSession()){
 //              if  (!($_SESSION['name']== $sessionId )) {
	// 		 $username = $_SESSION['name'];
	// 		 //echo "Hi ".$_SESSION['name'].'<br />'.'<br /> '; 
	// 		 if (isset($_SESSION['validated_name']))			
	// 		 $temp1 = "Hi ".getFirword($_SESSION['validated_name'])."! "; 
	// 		 if (isset($_SESSION['validated_username']))
	// 		 $temp1 = $temp1."You are signed in as ".$_SESSION['validated_username'];
 //              if (isset($_SESSION['validated_address']))
	// 		  $cusaddress=  $_SESSION['validated_address'];			 
	// 		 }
	// }

//create temporal table for cart  
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);
      if(!$conn)
	  { 
	   die('Could not connect: ' . mysql_error());
	  }
	  $sql1 = "CREATE  TABLE IF NOT EXISTS nwBooking LIKE Booking";
       
            $st = $conn->prepare($sql1);
            $st->execute();
		    $count = $st->rowCount();
    	   // print("Number of rows afffected $count rows.\n");	  
                
			
        $sql3="Alter table nwBooking add column area_name char(12) NOT NULL ,add column title varchar(32) NOT NULL,add column price decimal(5,2) NOT NULL";
		$st = $conn->prepare($sql3);
            $st->execute();
		    $count = $st->rowCount();
    	    //print("Number of rows afffected $count rows.\n");			
			
     }
	
	 
catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
 echo<<<_END1

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
                        <!-- <li><a href="#">Coming Soon</a></li> -->
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
                        <li><a href="showcart.php">Show Cart</a></li>
                        <li><a href="view_orders.php">Bookings</a></li>
                        <li><a href="log_on.php">Logout</a></li>
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
            <h1>Book Now<span>.</span></h1>

            <p>

_END1;
if (checkSession()){
              if  (!($_SESSION['name']== $sessionId )) {
			 $username = $_SESSION['name'];
			 //echo "Hi ".$_SESSION['name'].'<br />'.'<br /> '; 
			 if (isset($_SESSION['validated_name']))			
			 echo "Hi ".getFirword($_SESSION['validated_name'])."! "; 
			 if (isset($_SESSION['validated_username']))
			 echo "You are signed in as ".$_SESSION['validated_username'];
              if (isset($_SESSION['validated_address']))
			  $cusaddress=  $_SESSION['validated_address'];			 
			 }
	}
echo <<<_END1
          </p>
         </div>

      </div>

   </div>
   <section id="works">
   <div class="row">

         <div class="twelve columns align-center">
            <h1>I Wanna Watch..</h1>
         </div> 
   <div id="portfolio-wrapper" class="bgrid-quarters s-bgrid-halves">
   <form method ="post" action="seats.php">

_END1;
//  echo <<<_END
// <html!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><head><title>Theater Booking System</title></head>
// <body align =center>
// <p><h2>Theatre Booking APP </h2></p>
//  <div class="navigation"><ul><a href = validate_reg_input.php> Register</a><tab> | </tab> <a href = log_on.php>Check Orders</a>
//  <tab> | </tab> <a href =bookseats.php#chooseseat>Book Seats</a><tab> | 
//  </tab><a href =mail.php>Contact Us</a> <tab>|</tab> 
//   <br /><br /><form method ="post" action="showcart.php"><input type ="submit"  value="Show Cart" />
// </form> </ul>
// 	</div>
// <h3>Please See Below Our Shows </h3>
// </body>
// <br /></html>
// _END;

 try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);	 
    
    $temptitles1 = "select title, embedcode from Production order by title";
	$sql = " select title ,DATE(date_time) AS DATE,TIME(date_time) AS TIME from Performance order by DATE ,TIME ";
	// echo "  Theater Perfomance Times " .'<br />';
	// echo "<table CELLPADDING=4> <tr><th>Performance</th><th>Date</th>  <th>Time</th>";

	foreach ($conn->query($temptitles1) as $row)	
	{

			$temp11 = $row['title'];
			$sql1 = "select DATE(date_time) AS DATE,TIME(date_time) AS TIME from Performance where title = '$temp11' order by DATE ,TIME ";
	
			$temp12 = $row['embedcode'];
			// echo $temp11;
			echo "<div class='columns portfolio-item'>
               <div class='item-wrap'>
    			   <iframe width='215' height='224' src='$temp12' frameborder='0' allowfullscreen></iframe>
    					<div class='portfolio-item-meta'>
    					   <h5><a name='chooseseat'>$temp11<input type='radio' name ='title'  value='$temp11' checked='checked'/></a></h5>
    					    <p>Date and Time</p>";
    					   foreach ($conn->query($sql1) as $row1) {
    					   	$originalDate = $row1['DATE'];
							$time =$row1['TIME'];
							$newDate = date("d-m-Y", strtotime($originalDate));
    
    					   	echo "<p>". formatDate($newDate)." - ".formatTime($time)." </p>";
    					   }
    					   echo "
    					</div>
               </div>
    			</div>";
	}
	echo "</div></div></section><section id='journal'>

      <div class='row'>
         <div class='twelve columns align-center'>
            <h1>Where and When?</h1>
         </div>
      </div>
      <div class='blog-entries'>";
	
	 } 
   catch (PDOException $e)
   {
	echo $e->getMessage();
  }

try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);	 
    
    $tempname = "select name from tarea order by name";
	$sql = " select title ,DATE(date_time) AS DATE,TIME(date_time) AS TIME from Performance order by DATE ,TIME ";
	// echo "  Theater Perfomance Times " .'<br />';
	// echo "<table CELLPADDING=4> <tr><th>Performance</th><th>Date</th>  <th>Time</th>";
	echo "<article class='row entry choose'>

            <div class='entry-header'>
               <div class='ten columns entry-title pull-right'>Select Venue - <select name = 'area' >";
	foreach ($conn->query($tempname) as $row)	
	{

			$tempname11 = $row['name'];
			echo "<option value='$tempname11'>$tempname11</option>";
	}
	echo "</select></div>";
	} 
   catch (PDOException $e)
   {
	echo $e->getMessage();
  }
try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);	 
    
    $sql1 = "select title ,DATE(date_time) AS DATE,TIME(date_time) AS TIME from Performance order by DATE ,TIME ";
	// echo "  Theater Perfomance Times " .'<br />';
	// echo "<table CELLPADDING=4> <tr><th>Performance</th><th>Date</th>  <th>Time</th>";
	
echo <<<_END
<!-- default to popular show large area -->
  <div class='entry-header'><div class='ten columns entry-title pull-right'>
  Select Date and Time -
  <select name ="date">
_END;
foreach ($conn->query($sql1) as $row1)	
	{

			$originalDate = $row1['DATE'];
			$time =$row1['TIME'];
			$temp = $originalDate." "." ".$time;
			echo "<option value='$temp'>".formatDate($originalDate)." - ".formatTime($time)."</option>";
	}
echo <<<_END

</select>
<input type ="submit"  value="Show Seats" />
</form><br /> <br />
</div></div></div></article></section>
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
               <li>Design by <a target=blank href="http://www.somaiya.edu/kjsce/">vedipen</a></li>               
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
}
catch (PDOException $e)
   {
	echo $e->getMessage();
  }


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
function checkSet()
{
  return isset($_POST['title'],$_POST['area'],$_POST['date']);
}
/*function destroy_session_data()
{

$_SESSION = array();
if(session_id()!="" || isset($_COOKIE[session_name()]))
setcookie(session_name(),'',time()-2592000,'/');
session_destroy();
}*/
 
function checkSession(){
return isset($_SESSION['name'] );
}
function formatDate($date)
{

 return  date("l - jS F",strtotime($date));
}
function formatTime($time)
{

 return  date("H:i",strtotime($time));
}

function getFirword($longword)
{
if (!(empty($longword))){
$var =explode(' ',trim($longword ));
return $var[0];
}
return "";
}

?>

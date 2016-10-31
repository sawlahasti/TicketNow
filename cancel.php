<?php

require_once 'login.php';
require_once 'createTemp.php';
include 'menu.php';
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
            <h1>Your Ticket<span>.</span></h1>
            <p>It all stays here</p>
             </div>

      </div>

   </div>
   <style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover{background-color:#f5f5f5}
</style>'
   <section id="works">
   <div class="row">

         <div class="twelve columns align-center">
            <h1>Tickets</h1>
         </div> 
   <div id="portfolio-wrapper" class="bgrid-quarters s-bgrid-halves">
_END1;
session_start();
$sessionId = session_id();
try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);
         if(checkSession())
		 {	
          	 
		   	
			 $_SESSION['name'] == "" ? $username =$sessionId: $username=$_SESSION['name']; 
              $username = $_SESSION['name'];
		   /*delete booking from  main booking table and delete record from temporal cart table   */
		    $sqltemp ="delete from nwBooking where customer_name = '$username' ";
            $st = $conn->prepare($sqltemp);
            $st->execute();
			$count = $st->rowCount();
			if($count>=0)
			{
			echo " Booking has been cancelled";            		    
			}
			$sql1 ="delete from Booking where customer_name ='$username' ";
            $st = $conn->prepare($sql1);
            $st->execute();
		    $count = $st->rowCount();
			//delete users record
		    
			destroy_session_data();			
		 }
			 	 		        
     else {          			    
		     	
		   /*drop cart for this booking -temporal booking table    */
		    		   
			droptable('nwBooking',$conn);
				   		
			echo " Booking has been cancelled";            		    
			
		 //   destroy_session_data();	    			    
									
		}
		
	}
	
		 
             
       
catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
 
  echo("<form method=\"post\" action=\"bookseats.php\">\n");
            
            echo("</form>\n");
  
echo <<<_END

</div></div></div></section>
<footer><footer>

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

// security for sql injection
function check_input($string)
{    $problem=' empty string entered';
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    if ($problem && strlen($string) == 0)
    {
        die($problem);
    }
    return $string;
}
function sanitizeString($var)
{
$var = stripslashes($var);
$var = htmlentities($var);
$var = strip_tags($var);
return $var;
}
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
function checkEmpty($anArray)
 {
   if(empty($anArray))
   {
   
     return "empty";
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
  function checkSession(){
return isset($_SESSION['name']);
}
 
 function checkSet(){
  return isset($_POST['name'],$_POST['address']);
}
function queryMysql($query)
{
$result = mysql_query($query) or die (mysql_error());
return $result;
}
function destroy_session_data()
{

$_SESSION = array();
if(session_id()!="" || isset($_COOKIE[session_name()]))
setcookie(session_name(),'',time()-2592000,'/');
session_destroy();
}
function droptable($table,$conn)
{
$sql1 = "drop table $table ";
             $st = $conn->prepare($sql1);
            $st->execute();		
		
 }
?>
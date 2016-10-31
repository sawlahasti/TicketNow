<?php
require_once 'login.php';
require_once 'createTemp.php';
// require_once 'booking.php';
include 'cart.php';
include 'navigation.php';
/* ini_set('session.cache_limiter', 'private'); */
session_start();
$sessionId = session_id();
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
                                                                                                                                                                                                <li><a href="index.php#chooseseat">In Theatres</a></li>
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
<form method="post" action="index.php">
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
         if (isset($_SESSION['name']))
		 {	
         $username = $_SESSION['name'];		 
		  //if ( checkGetSet())
		  
		 if(isset($_GET['seat']) && isset($_GET['area']) && isset($_GET['price']) && isset($_GET['title']) && isset($_GET['date']))
		{
		 
         $seat = $_GET['seat'];
		 $area = $_GET['area'];
		 $price =$_GET['price'];
		 $title = $_GET['title'];
		 $date =$_GET['date'];
		 $time =$_GET['time'];     
		 $datetime =$date." ".$time;
			    			 	
		   /*remove the seat booking from  cart    */
		     
			$sql1 ="delete from nwBooking where row_no ='$seat' AND title LIKE '$title%' AND date_time LIKE '%$datetime'  ";
            $st = $conn->prepare($sql1);
            $st->execute();
		    $count = $st->rowCount();
			if($count>0)
			{
			echo " Seat  No: ". $seat .  " for " . $title ."  Performance on ".formatDate($datetime). " was removed from your cart " ;
			echo "".'<br />'.'<br />';   
            showCart($username,$conn);
			//unset ($seat) ;
			}
			}
		    
						
		 }
			 	 		        
     else {          			    
		     	
		   echo " unable to delete from cart";
		}
		
		   echo " go to home page for booking ";

	  }
	
		 
             
       
catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
 
  echo("<form method=\"post\" action=\"bookseats.php\">\n");
            
            echo("</form>\n");

echo <<<_END

        <footer>

              <div class="row">
              
         <div class="twelve columns">

            <ul class="footer-nav">
      <li><a href="#">Home</a></li>
              <li><a href="index.php#chooseseat">Movies</a></li>
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

  function checkSessionName(){
return isset($_SESSION['name'],$_SESSION['address']);
}
 function checkGetSet(){
  return isset($_GET['seat'],$_GET['area'],$_GET['price'],$_GET['title'],$_GET['date']);
}

function droptable($table,$conn)
{
$sql1 = "drop table $table ";
             $st = $conn->prepare($sql1);
            $st->execute();		
		
 }


?>

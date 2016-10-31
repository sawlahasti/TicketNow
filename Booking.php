<?php
//reponsible for the booking  and update cart nwBooking table with booking details

if (!isset($_SESSION)) { session_start(); }


require_once 'login.php';
include 'cart.php';
// ini_set('session.cache_limiter', 'private'); 
$sessionId= session_id();
echo "here ".$sessionId;

// if (!isset($_SESSION['counter'])) $_SESSION['counter']=0;
// echo "Refreshed ".$_SESSION['counter']++." times.<br>
//<a href=".$_SERVER['PHP_SELF'].">refresh</a>"; 
// echo "Refreshed ".$_SESSION['counter']++." times.<br>
// <a href=".$_SERVER['PHP_SELF'].'?'.session_name().'='.session_id().">refresh</a>";

// include 'navigation.php';

 


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
            <h1>Your Cart<span>.</span></h1>
            <p>It all stays here</p>
             </div>

      </div>

   </div>
   <section id="works">
   <div class="row">

         <div class="twelve columns align-center">
            <h1>Tickets</h1>
         </div> 
   <div id="portfolio-wrapper" class="bgrid-quarters s-bgrid-halves">
_END1;

try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);
   if(isset($_SESSION['name']))
echo $_SESSION['name']."hereri   ".$_SESSION['title'];     

$_SESSION['name'] == "" ? 
   $username =$sessionId:
    $username=$_SESSION['name'];
	if(isset($_SESSION['title'])&& isset($_SESSION['date'] )&& isset($_SESSION['area'] ))	{
		 $titlev = $_SESSION['title'];
		 $datev = $_SESSION['date'];
		 $areav =$_SESSION['area'];		 
        if (isset($_POST['seat']) && isset($_POST['price']))
		  {		    
		     $seat= sanitizeString(substr($_POST['seat'],0,3));
			 
			 $price= sanitizeString(substr($_POST['price'],0,4)) . '<br /> ';
			
		     $price = sanitizeString(deep_replace_str($_POST['price'])) .' <br />';
			  
			  /*  before confirmation*/	
			  $sql = "insert into nwBooking(row_no,date_time,customer_name,area_name,title,price)
		     values('$seat','$datev','$username','$areav','$titlev','$price')";
            $st = $conn->prepare($sql);
            $st->execute();
			if (!$st)
			{
			 die("Execute query error, because: ". $conn->errorInfo());
			}
		    $count = $st->rowCount();
        	if ($count == 0)
			{
			
			echo " the seat choosen is already reserved  ,You can add more seats in this area or another area of the theatre ".'<br />'.'<br />';
			
			showCart($username,$conn);
			
		    echo("<form method=\"post\" action=\"bookseats.php#chooseseat\">\n");
            echo("<input type=\"submit\" value=\"Change Area\">\n");
            echo("</form>\n");
			
			}
			 if ($count >0)
			{
			
			print(" You have added Seat $seat for  $titlev  Showing On " . formatDate($datev)."  to your Basket ").'<br />'.'<br />';
			// display cart
			showCart($username,$conn);		
		
           }
	
	}
   }
   }
		
catch(PDOException $e) 
 {
 echo $e->getMessage();
 }



 echo <<<_END

</select>
</div></div></div></section>
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
$var = stripslashes_deep($var);
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
/*
function formatDate($date)
{

 return  date("l F jS , Y - g:ia",strtotime($date));
}
*/
function formatBritishDate($date)
{
 
return $newDate = date("d-m-Y", strtotime($date));
}
function checkEmpty($anArray)
 {
   if(empty($anArray))
   {
   
     return false; 
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
  return isset($_POST['name'],$_POST['address']);
}
function checkSession(){
return isset($_SESSION['title'],$_SESSION['date'],$_SESSION['area'] );
}
function queryMysql($query)
{
$result = mysql_query($query) or die (mysql_error());
return $result;
}

function stripslashes_deep($value)
{
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}
function calculatePrice($var)
{
return $var += $var;
}
function deep_replace_str($stringinput)
{

return str_replace( array("\n", "\r"), "", $stringinput );

}
function formatString($string,$length)
{  
    $stringx =$string;
   $lengthx = intval($length);
    $stringo ="0";
  if (strlen($stringx)<$lengthx && strlen($stringx)!=0 )
  {
    $diflength = $lengthx - strlen($stringx);
   for($i=0; $i<=$diflength;$i++)
   {
    $stringx = $stringx + $stringo;
   
   }
   }
  else if (strlen($string)>$lengthx && strlen($string)!=0 )
  {
   $string = substr($string,0,$lengthx) ;
  }
    return $stringx;
  
  }
?>

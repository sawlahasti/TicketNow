<?php
/*
responsible for booking confirmation
*/
session_start();
require_once 'login.php';
ini_set('session.cache_limiter', 'private');

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
$sessionId = session_id();

 
try { $conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);

      
if (checkset())
      {
         if(!empty($_POST['forename']) && !empty($_POST['address']))
     {
          if (isset($_POST['forename']))
          $forename = sanitizeString($_POST['forename']);

           if (isset($_POST['surname']))
           $surname = sanitizeString($_POST['surname']);
            $name = $forename ." ".$surname;
              
            if (isset($_POST['email']))
           $email =sanitizeString($_POST['email']);

             if(isset($_POST['address']))
             $address =sanitizeString($_POST['address']);
                      
      
      $_SESSION['name'] = $name;
      $_SESSION['address'] = $address ;
      $_SESSION['email'] =$email;
      $username = $_SESSION['name'] ;
             
       
        /*confirm booking commit to main database 
        update cart temptable  with name and address */
        
        $sql1 = "update nwBooking SET customer_name ='$name',address = '$address' where customer_name ='$sessionId'";      
        //echo $sql1;
            $st = $conn->prepare($sql1);
            $st->execute();
        $count = $st->rowCount();
      if($count>0 )
      {
//        echo "here3";
       /*check if customer already  known  */
       $sql="select cus_Id FROM Customer where email = '$email'";
       $statement = $conn->prepare($sql);
             $statement->execute();
             $count = $statement->rowCount();
       
      
       // user not registered
       if (!($count >0))
      {
        $spl="insert into Customer(name,address,email) values('$name ','$address','$email')";             
        $st = $conn->prepare($spl);
            $st->execute();
      }
       //generate order ID  for the transaction*/
  //    echo "here1";
       $sql="insert into Orders(cus_Id,email,trans_date) values((select cus_Id from Customer where email= '$email'),'$email',CURDATE())";
    //   echo $sql;
       $statement = $conn->prepare($sql);
             $statement->execute();
       //retrieve cusId and order Id
       $orderId="";
      // echo "here1";
       $cusId ="";
       $sqlx = "select max(order_Id) AS orderId ,cus_Id AS cusId from Orders where email='$email' group by cus_Id ";
       if ($res = $conn->query($sqlx))
      {
      foreach ($conn->query($sqlx)as $row)
      {                
       $orderId =$row['orderId'];
           $cusId = $row['cusId'];                  
            
      }
            }     
               $_SESSION['orderId'] = $orderId ;     
       
         $_SESSION['cusId'] = $cusId ;
         
          
      // update with new orderId and customer ID
      $sql1 = "update nwBooking SET order_Id ='$orderId',cus_Id = '$cusId' where customer_name = '$name' and address ='$address' ";     
            $st = $conn->prepare($sql1);
            $st->execute();     
        // insert into main booking table with new booking details 
      $spl2="insert into Booking(customer_name,address,row_no,date_time,cus_Id ,order_Id )
      select customer_name ,address ,row_no,date_time , cus_Id ,order_Id from nwBooking where customer_name = '$name'  
      and  address ='$address'";
        $st = $conn->prepare($spl2);
            $st->execute();
                                
        /* print confirmation */                
      // print name and shipping address printing booking table to ensure we have right  details stored

			echo "".'<br />';
			echo '<b>'." THEATRE BOOKING CONFIRMATION ".'</b>'.'<br />'.'<br />';
			echo "<b>Order Date: </b>" .date("d-m-Y").'<br />'.'<br />';
			$sql3 = "select customer_name AS name ,address AS address ,cus_Id AS  cusId , order_Id AS orderId from Booking
			where customer_name ='$name' and order_Id = '$orderId' group by customer_name ";
			//echo "<table CELLPADDING= 10 > <tr><th>NAME</th> <th>Shipping Address</th><th>Customer Id</th><th>Order NO</th> ";			
			if ($err = checkEmpty($conn->query($sql3)))
			 foreach ($conn->query($sql3)as $row)	
	       {$namex =$row['name'];
	        $addressx = $row['address'];
            $cusId = $row['cusId'];
            $orderId = $row['orderId'];
			 echo"<tr><b>Customer Id : </b>". $cusId."</tr>".'<br />'.'<br />';
			 echo"<tr><b>Order Id : </b>". $orderId."</tr>".'<br />'.'<br />';	
			 echo"<tr><b> Delivery  Address : ".'</b>'.'<br />';             		
             echo"<tr>". $namex ."</tr>".'<br />';
	         echo"<tr>". $addressx."</tr>".'<br />'.'<br />';
			 
			 $sqlcustomer = "select name ,address  from Customer where cus_Id ='$cusId' ";
             foreach ($conn->query($sqlcustomer)as $row)
			 {
         	 $cusnamex =$row['name'];
			 $_SESSION['validated_name']= $cusnamex;
	         $cusaddressx = $row['address'];
             $_SESSION['validated_address'] = $cusaddressx ;			 
             echo"<tr><b>Billing Address : </b>"."<tr>".'<br />';	 
        	 echo"<tr>". $cusnamex."</tr>".'<br />';
			 echo"<tr> ". $cusaddressx."</tr>".'<br />';
             }            
			}
			echo "".'<br />'.'<br />';
			
							      
			// print booking by this customer
		    $sql4="select Booking.ticket_no AS ticket ,Performance.title AS title,DATE(Performance.date_time) AS date, 
			TIME(Performance.date_time) AS time, seat.area_name AS area, Booking.row_no AS seat , 
			(Production.basicPrice * tarea.price_multiplier ) AS price  from seat  inner JOIN  Booking ON  seat.row_no = Booking.row_no  left JOIN Performance ON  Booking.date_time  = Performance.date_time  left join Production ON  Performance.title = Production.title left join tarea ON  seat.area_name =tarea.name 
			where Booking.customer_name ='$name' AND order_Id ='$orderId' 
			GROUP BY Booking.ticket_no ,Performance.date_time order by Performance.date_time,Performance.date_time,seat.area_name";           
		   			
			if ($err = checkEmpty($conn->query($sql4)))
		   {
			 echo "<table CELLPADDING=14> <tr bgcolor=gray><th>Ticket No </th><th>Show</th><th>Date</th><th>Time</th><th>Area</th><th>Seat No</th><th>Price</th> ";
			 $cost=0;
			 foreach ($conn->query($sql4)as $row)	
	       {  $ticketx =$row['ticket'];
	          $titlex = $row['title'];
			  $datex = $row['date'];
			  $timex = $row['time'];
			  $areax = $row['area'];
			  $seatx = $row['seat'];
			  $pricex = $row['price'];
			  $formatdate=formatBritishDate($datex);
			  $formatpricex= sprintf("%01.2f",$pricex);
              $cost+= $pricex;
              $formatcost= sprintf("%01.2f",$cost);			  
            echo "<tr>";
	        echo " <td> $ticketx</td> ";
	        echo " <td> $titlex</td> ";  
            echo " <td> $formatdate</td> ";
            echo " <td> $timex </td> ";
            echo " <td> $areax </td> ";
            echo " <td> $seatx </td> ";
            echo " <td>$formatpricex</td> ";			
	        echo "</tr>";
			}
			echo "</table>";
			echo "".'<br />'.'<br />';
		    echo "<table CELLPADDING=20><tr><th>Total Cost</th><th></th><th></th><th>:</th><th>Rs. </th><th>$formatcost</th> ";
		    echo "</table>";		  
			echo "".'<br />'.'<br />';
			
	         
			/*empty cart delete booking record from temporal cart table   */
		    
			$sqltemp ="delete from nwBooking where customer_name = '$username' ";
            $st = $conn->prepare($sqltemp);
            $st->execute();
			
			
			echo("<form method=\"post\" action=\"print_email_Receipt.php\">\n");
            echo("<input type=\"submit\" value=\"Print/Email Receipt\">\n");
            echo("</form>\n");		   
		    echo("<form method=\"post\" action=\"bookseats.php\">\n");
            echo("<input type=\"submit\" value=\"Home Page\">\n");
            echo("</form>\n");	
	     }
		  
		}
	      
	   }
	   	   
	}
 }
  
catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
  
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
function check_input($string)
{  
       
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string); 
    
    
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
return isset($_SESSION['name'],$_SESSION['address']);
}
 function checkSet(){
  return isset($_POST['forename'],$_POST['address']);
}
function queryMysql($query)
{
$result = mysql_query($query) or die (mysql_error());
return $result;
}
function IsNullOrEmptyString($string)
{
    return (!isset($question) || trim($question)==='');
}

 
function droptable($table,$conn)
{
$sql1 = "drop table $table ";
             $st = $conn->prepare($sql1);
            $st->execute();		
		
 }
 /*function destroy_session_data()
{

$_SESSION = array();
if(session_id()!="" || isset($_COOKIE[session_name()]))
setcookie(session_name(),'',time()-2592000,'/');
session_destroy();
}*/
function sessionName()
{ if (isset($_SESSION['name'])) {
	
	return $username= $_SESSION['name'];
}	
 
}
?>
</body>
</html> 

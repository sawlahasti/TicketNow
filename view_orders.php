<?php
require_once 'login.php';
ini_set('session.cache_limiter', 'private');
session_start();
$sessionId = session_id();
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
                        <li><a href="index.php#chooseseat">In Theatres</a></li>
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
try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);

      $email =$_SESSION['email'];
      $cus_Id= $_SESSION['cus_Id']; 
      $username =$_SESSION['username'];
      $name = $_SESSION['name'];
   if (!(empty($email)&& empty($cus_Id)))
  {
  printBooking($email,$cus_Id,$username,$name,$conn);
  }
  else{
  exit("Oops! Not valid user. Please log in again.");
  }

}

catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
function printBooking($email,$cus_Id,$username,$name,$conn)
{          echo '<br />'."<tr><td><b>  ORDERS HISTORY </b></td></tr>".'<br />'.'<br />';
           echo '<br />'."<tr><td><b>  SHOWING ALL YOUR BOOKING HISTORY MOST RECENT FIRST</b></td></tr>".'<br />'.'<br />';
           echo "<tr>Email : $email </tr>".'<br />';
       echo "<tr>Username : $username </tr>".'<br />';
       echo "<tr>Customer Name : $name </tr>".'<br />';
       echo"<tr>Customer Id : $cus_Id </tr>".'<br />'.'<br />';
           $sqlorders="select order_Id ,trans_date from Orders where cus_Id ='$cus_Id'  order by order_Id DESC ";  
         $STH = $conn->query($sqlorders); 
      $STH->setFetchMode(PDO::FETCH_ASSOC);
      while($row = $STH->fetch()) 
      
     {   $trans_date =$row['trans_date'];
         $order_Id =$row['order_Id'] ;
         echo "<tr><b>Order Date :". formatBritishDate($trans_date )."</b></tr>".'<br />'.'<br />';
         echo "<tr>Order ID : $order_Id </tr>".'<br />'.'<br />';
        
       $sqlbooking=" select Booking.ticket_no AS ticket ,Booking.order_Id AS orderId, Performance.title AS title,DATE(Performance.date_time) AS date, 
      TIME(Performance.date_time) AS time, seat.area_name AS area, Booking.row_no AS seat , 
      (Production.basicPrice * tarea.price_multiplier ) AS price  from seat  
      inner JOIN  Booking ON  seat.row_no = Booking.row_no 
      left JOIN Performance ON  Booking.date_time  = Performance.date_time 
      left join Production ON  Performance.title = Production.title left join tarea ON  seat.area_name =tarea.name 
      where Booking.cus_Id ='$cus_Id' and Booking.order_Id = '$order_Id'
      GROUP BY Booking.ticket_no ,Performance.date_time order by Performance.date_time,Performance.date_time,seat.area_name "; 
       if ($err = checkEmpty( $conn->query($sqlbooking)))
       {                    
       echo "<table CELLPADDING=14 border=0><tr bgcolor=gray border=0 ><th>Order Id </th><th>Ticket No </th><th>Show</th><th>Show Date</th><th>Time</th><th>Area</th><th>Seat No</th><th>Price</th> ";
       $cost=0;
       foreach ($conn->query($sqlbooking)as $row) 
         {  
          $orderId = $row['orderId'];
          $ticketx =$row['ticket'];
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
      echo " <td> $orderId</td> ";
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
      echo "".'<br />';
        echo "<table CELLPADDING=20><tr><th>Total Cost:</th><th></th><th></th><th>Rs. </th><th>$formatcost</th> ";
        echo "</table>";      
      echo "".'<br />'.'<br />';
      }       
     
     }        
  }
   echo <<<_END

</div></div></div></section>
<footer><footer>

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
 function formatBritishDate($date)
{
 
return $newDate = date("d-m-Y", strtotime($date));
}
function formatDate($date)
{

 return  date("l F jS , Y - g:ia",strtotime($date));
}
function checkEmpty($anArray)
 {
   if(empty($anArray))
   {
   
     return "empty ";
   }
  
   return true;
 }

?>
</body>
</html> 

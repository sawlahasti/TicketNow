<?php
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
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
	    vertical-align: middle;
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover{background-color:#f5f5f5}
</style>'
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
require_once 'login.php';
ini_set('session.cache_limiter', 'private');
$forename = $surname = $address = $email = "";

if (isset($_POST['forename']))
$forename =fix_string($_POST['forename']);

if (isset($_POST['surname']))
$surname =fix_string($_POST['surname']);

if (isset($_POST['email']))
$email =fix_string($_POST['email']);

if( isset($_POST['address']))
$address =fix_string($_POST['address']);

$fail  = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_address($address);
$fail .= validate_email($email);

echo "<html><head><title>Delivery Detail</title>";
if($fail == "")
{
echo "</head><body>Your Shipping Address correctly validated : $forename,$surname ,$address ,$email.</body></html>";
  
//$name = $forename ." ".$surname ;
exit;
 }
 // output javascript
echo <<<_END

<style>.delivery {border:1px solid #999999;
font:normal 14px heveltica; color :#444444;}</style>
<script type ="text/javascript">
function validate(form){
fail = validateForename(form.forename.value)
fail += validateSurname(form.surname.value)
fail +=validateAddress(form.address.value)
fail += validateEmail(form.email.value)
if (fail=="") return true
else { alert(fail); return false }
}
</script></head><body>
<table class="delivery" border="0" cellpadding="4"
cellspacing="10" bgcolor="#eeeeee">
<th colspan="10" align="center">Delivery Details </th>

<tr><td colspan="2">Please enter Shipping details <br />
The folowing fields are required in your form: <p><font color=red size=1>$fail<i></font></p>
</td></tr>
<form method ="post" action="booking_confirmation.php"
onSubmit="return validate(this)">
<tr><td>FirstName</td><td><input type="text" size="60" maxlength="32"
name="forename" value="$forename" /></td>
</tr><tr><td>LastName</td><td><input type="text"  size="60" maxlength="32"
name="surname" value="$surname" /></td>
</tr><tr><td>Delivery Address</td><td><input type="text"  size="120" maxlength="200"
name="address" value="$address"  /></td>
</tr><tr><td>Your Email</td><td><input type="text" size="60" maxlength="64"
name="email" value="$email" /></td>
</tr><tr><td colspan="5" align="center"><input type="submit" value="Confirm details" /></td>
</tr></form></table>

<script type="text/javascript">
function validateForename(field){
if (field == "" ) return " No Firstname entered.\\n"
return ""
}
function validateSurname(field) {
if(field == "" ) return " No Surname entered.\\n"
return ""
}
function validateAddress(field) {
if(field == "" ) return " No Address  entered.\\n"
else if (field.length < 10) return "Address must be more than 10 characters.\\n"
return ""
}
function validateEmail(field) {
if(field == "" ) return " No Email entered.\\n"
		else if (!((field.indexOf(".") > 0) &&
			     (field.indexOf("@") > 0)) ||
			    /[^a-zA-Z0-9.@_-]/.test(field))
		return "The Email address is invalid.\\n"
	return ""
}
</script></body></html>
_END;

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
// if javascript is disabled validation  will be handled by PHP functions
function validate_forename($field)
{
if ($field == "") return " Firstname  is required<br />";
return "";
}
function validate_surname($field)
{
if ($field == "") return " Lastname  is required<br />";
return "";
}
function validate_address($field)
{
if ($field == "") return "Address is required<br />";
else if (strlen($field) < 10) return "Address must be more than 10 characters <br />";
return "";
}
function validate_email($field)
{
if ($field == "") return "No Email was entered<br />";
		else if (!((strpos($field, ".") > 0) &&
			      (strpos($field, "@") > 0)) ||
			    preg_match("/[^a-zA-Z0-9.@_-]/", $field))
		return "The Email address is invalid<br />";
	return "";
}
function fix_string($string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return htmlentities($string);
}

?>

<?php
ob_start();
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
            <h1>Register<span>.</span></h1>

            <p>Explore the world of Exciting Movies</p>
         </div>

      </div>

   </div> 
</html>
_END1;

$forename = $surname = $address = $email = $cus_address = $username = $password1 = $password2="";

if (isset($_POST['forename']))
$forename =fix_string($_POST['forename']);

if (isset($_POST['surname']))
$surname =fix_string($_POST['surname']);

if (isset($_POST['email']))
$email =fix_string($_POST['email']);

if( isset($_POST['cus_address']))
$cus_address =fix_string($_POST['cus_address']);

if( isset($_POST['username']))
$username =fix_string($_POST['username']);

if( isset($_POST['password1']))
$password1 =fix_string($_POST['password1']);

if( isset($_POST['password2']))
$password2 =fix_string($_POST['password2']);


$fail  = validate_forename($forename);
$fail .= validate_username($username);
$fail .= validate_surname($surname);
$fail .= validate_address($cus_address);
$fail .= validate_email($email);
$fail .= validate_password($password1);
$fail .= validate_password($password2);
$fail .= compare_Passwords($password1,$password2);
$message= "";
$name = $forename." ".$surname;

// echo "<html><head><title>Registration</title>";
if($fail == "")
{

 try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $pwd);
  
   if  (!(check_customer_exist($username,$email,$conn)))
	  {
	 $message = register_user($name,$username,$email,$cus_address,$password1,$conn);
	  $_SESSION['validated_name'] = $name ;
     $_SESSION['validated_username']= $username;
	$_SESSION['validated_address']=$cus_address;
	 $_SESSION['valid_user']= true;
	 $_SESSION['name'] =$name;
	 $_SESSION['username']= $username;
	 $_SESSION['forename'] =$forename;
	 $_SESSION['surname'] =$surname;
	 $_SESSION['password'] =$password1;
	 
	  echo "</head><body><br /><div style ='margin:auto 41% auto 43%; color:#373131;' ><p>$message </p></div></body></html>";
	/*   echo <<<_END
	   <form method ="post" action="bookseats.php"> 
       <input type ="submit"  value="Home Page" />
        </form>
_END;*/
   exit("<div><p style ='margin:auto 41% auto 43%; color:#373131;'><a href = bookseats.php>Click here to Continue</a></p></div>");
	  }
   else
	  { 
	  // customer detail already registered
	    echo $message = check_customer_exist($username,$email,$conn);	   
	 // show login page  	 
      } 

  }
 catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
  
}
 // output javascript
echo <<<_END

<style>.registration {border:1px solid #999999;
font:normal 14px heveltica; color :#444444;}</style>
<script type ="text/javascript">
function validate(form){
fail = validateForename(form.forename.value)
fail += validateSurname(form.surname.value)
fail +=validateAddress(form.cus_address.value)
fail += validateEmail(form.email.value)
fail +=validateUsername(form.username.value)
fail +=validatePassword(form.password1.value)
fail +=validatePassword(form.password2.value)
fail +=comparePasswords(form.password1.value,form.password2.value)
if (fail=="") return true
else { alert(fail); return false }
}
</script></head><body>

<form method ="post" action="validate_reg_input.php"
onSubmit="return validate(this)">

<div class="content-outer">

      <div id="page-content" class="row page">

         <div id="primary" class="eight columns">

            <section>

              <h1>Enter your Details.</h1>

              <div id="contact-form">

                  <form name="contactForm" id="contactForm" method="post" >
      					<fieldset>

                        <div class="half">
      						   <label for="contactName">First Name <span class="required">*</span></label>
      						   <input type="text" maxlength="32" name="forename" size="35" value="$forename" />
                        </div>
						
						<div class="half pull-right">
      						   <label for="contactName">Last Name <span class="required">*</span></label>
      						   <input type="text" maxlength="32" name="surname" size="35" value="$surname"  />
                        </div>

						
						<div>
      						   <label for="contactEmail">Email <span class="required">*</span></label>
      						   <input maxlength="64" size="35" name="email" value="$email" type="email"/>
                        </div>
						
						<div>
      						   <label for="contactSubject">Address <span class="required">*</span></label>
      						   <input type="text" maxlength="200" name="cus_address" size="35" value="$cus_address" />
                        </div>
                        
                        <div>
      						   <label for="contactName">Username <span class="required">*</span></label>
      						   <input maxlength="64" name="username" value="$username" type="text" size="35"/>
                        </div>

                        <div class="half">
                           <label for="contactName">Password <span class="required">*</span></label>
                           <input maxlength="64" type="password" name="password1" value="$password1" size="35"/>
                        </div>

                        <div class="half pull-right">
                           <label  for="contactName">Confirm Password <span class="required">*</span></label>
                           <input input type="password" size="60" maxlength="64" name="password2" value="$password2" size="35"/>
                        </div>

                        <div>
                           <button class="submit">Submit</button>
                           <span id="image-loader">
                              <img src="images/loader.gif" alt="Loading" />
                           </span>
                        </div>

      					</fieldset>
      				</form> 
                  <div id="message-warning"></div>
      				<div id="message-success">
                     <i class="icon-ok"></i>Your Registration was sent, thank you!<br />
      				</div>

               </div>

            </section> 

         </div>

         

      </div>

   </div> 

<script type="text/javascript">
function validateForename(field){
if (field == "" ) return " No Firstname entered.\\n"
return ""
}
function validateSurname(field) {
if(field == "" ) return " No Surname ented.\\n"
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
function validateUsername(field) {
	if (field == "") return "No Username was entered.\\n"
	else if (field.length < 5)
		return "Usernames must be at least 5 characters.\\n"
	else if (/[^a-zA-Z0-9_-]/.test(field))
		return "Only letters, numbers, - and _ in usernames.\\n"
	return ""
}

function validatePassword(field) {
	if (field == "") return "No Password was entered.\\n"
	else if (field.length < 6)
		return "Passwords must be at least 6 characters.\\n"
	else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
		    ! /[0-9]/.test(field))
		return "Passwords require one each of a-z, A-Z and 0-9.\\n"
	return ""
}
function comparePasswords(field1,field2){
if (!( field1 == field2)) return " Passwords entered do not match.\\n"
return ""

}

</script>
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

   </body></html>
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
function validate_username($field) {
	if ($field == "") return "No Username was entered<br />";
	else if (strlen($field) < 5)
		return "Usernames must be at least 5 characters<br />";
	else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
		return "Only letters, numbers, - and _ in usernames<br />";
	return "";		
}

function validate_password($field) {
	if ($field == "") return "No Password was entered<br />";
	else if (strlen($field) < 6)
		return "Passwords must be at least 6 characters<br />";
	else if ( !preg_match("/[a-z]/", $field) ||
			!preg_match("/[A-Z]/", $field) ||
			!preg_match("/[0-9]/", $field))
		return "Passwords require 1 each of a-z, A-Z and 0-9<br />";
	return "";
}
function compare_Passwords($field1,$field2){
if (!($field1==$field2)) return "Passwords do not match <br />";
return "";

}
function check_customer_exist($username,$email,$conn)
{
 //check if customer exists
 $sql = "select * from Customer where email = '$email'";
    $res=$conn->query($sql);
	 $statement = $conn->prepare($sql);
    $statement->execute();
    $count = $statement->rowCount();
 if ($count > 0)
  {  
    return $message = " The email entered: " . $email . "  is already registered please choose another email or Log in";
  }
  //check if username is available
 $sql="select * from Logon where username ='$username'";
  $res=$conn->query($sql);
 
	$statement = $conn->prepare($sql);
    $statement->execute();
    $count = $statement->rowCount();
   if ($count > 0)
   {  
    return $message = " The username entered: " . $username . "  is already registered please choose another username or Log in ";
   } 
 
  return false;
}

function  register_user($name,$username,$email,$cus_address,$pwd1,$conn)
{
 // insert customer details and generate customer ID insert password
 $spl="insert into Customer(name,address,email) values('$name','$cus_address','$email')";			  		 
		    $st = $conn->prepare($spl);
            $st->execute();
			if (!$st){exit("Database access failed:".mysql_error()); }
			$count = $st->rowCount();
            if ($count >0)
          {		
           $salt1="qm&h*";
           $salt2="pg!@";
           $token =  md5("$salt1$pwd1$salt2");		   
           $spl="insert into Logon(email,username,pwd,cus_Id) values('$email','$username','$token',(select cus_Id from Customer where email= '$email'))";			  		 
		   $st = $conn->prepare($spl);
           $st->execute();
		   $_SESSION['validated_name'] = $name ;
		   $_SESSION['validated_username']= $username;
		   $_SESSION['validated_address']=$cus_address;
		return  $message = " Your registration was sucessful<br />" . " Your Username is ".$username.'<br />' ;
         }		
}

function fix_string($string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return htmlentities(trim($string));
}

?>
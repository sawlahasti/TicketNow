<?php
session_start();
ini_set('session.cache_limiter', 'private');
require_once 'login.php';
ob_start();
echo <<<_END2
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
            <h1>Sign In<span>.</span></h1>

            <p>Did you miss me?</p>
         </div>

      </div>

   </div> 
_END2;


//include 'view_orders.php';
$email = $password1 ="";
if (isset($_POST['email']))
$email =fix_string($_POST['email']);

if( isset($_POST['password1']))
$password1 =fix_string($_POST['password1']);
$fail = validate_email($email);
$fail .= validate_password($password1);
$message= "";
//echo "<html><head><title>Enter your details.</title>";
if (isset($_POST['email']) && isset($_POST['password1']))
if($fail == "")
{

  try {$conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pwd);
      
    
   if  (check_customer_exist($email,$password1,$conn)=="No")
   {
    
    echo $message="Invalid username/password combination";  
  }
  else {  
     $msg = check_customer_exist($email,$password1,$conn);
     echo $msg .'<br />'.'<br />';
    
    $_SESSION['valid_user'] = true;
    
   //die(printBooking($email,$cus_Id,$username,$name,$conn));   
  //die ("<p><a href=view_orders.php>Click here to view your Bookings</a></p>");
  die(header('Location: view_orders.php'));
    } 
  }
 catch(PDOException $e) 
 {
 echo $e->getMessage();
 }
  
}
 // output javascript

echo <<<_END
<style>.signIn {border:1px solid #999999;
font:normal 14px heveltica; color :#444444;}</style>
<script type ="text/javascript">
function validate(form){
fail = validateEmail(form.email.value)
fail +=validatePassword(form.password1.value)
if (fail=="") return true
else { alert(fail); return false }
}
</script></head><body>
<div class="content-outer">

      <div id="page-content" class="row page">

         <div id="primary" class="eight columns">

            <section>

              <h1>Enter Your Details.</h1>

              <div id="contact-form">

                  <form method ="post" action="log_on.php" onSubmit="return validate(this)" name="contactForm" id="contactForm" >
                <fieldset>

                        <div>
                     <label for="contactEmail">Email <span class="required">*</span></label>
                     <input type="text" size="60" maxlength="64" name="email" value="$email" size="35" value="" />
                        </div>

                <div>
                           <label for="contactName">Password <span class="required">*</span></label>
                           <input maxlength="64" type="password" maxlength="64" name="password1" value="$password1" size="35"/>
                        </div>

                        <div>
                           <button class="submit">Sign In</button>
                           <span id="image-loader">
                              <img src="images/loader.gif" alt="Loading" />
                           </span>
                        </div>

                </fieldset>
              </form> 
                  <div id="message-warning"></div>
              <div id="message-success">
                     <i class="icon-ok"></i>Your message was sent, thank you!<br />
              </div>

               </div>

            </section> 

         </div>

         

      </div>

   </div>

<script type="text/javascript">

function validateEmail(field) {
if(field == "" ) return " No Email entered.\\n"
    else if (!((field.indexOf(".") > 0) &&
           (field.indexOf("@") > 0)) ||
          /[^a-zA-Z0-9.@_-]/.test(field))
    return "The Email address is invalid.\\n"
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

</script>

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

</body></html>
_END;

// if javascript is disabled validation  will be handled by PHP functions

function validate_email($field)
{
if ($field == "") return "No Email was entered<br />";
    else if (!((strpos($field, ".") > 0) &&
            (strpos($field, "@") > 0)) ||
          preg_match("/[^a-zA-Z0-9.@_-]/", $field))
    return "The Email address is invalid<br />";
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

function check_customer_exist($email,$pwd1,$conn)
{
$salt1="qm&h*";
$salt2="pg!@";
$token =  md5("$salt1$pwd1$salt2"); 
$message=""; 
 //check if customer exists 
 $sql = "select * from Logon where email = '$email' ";
  if( $res=$conn->query($sql))
  {
  $statement = $conn->prepare($sql);
    $statement->execute();
    $count = $statement->rowCount();
  if ($count > 0)
       {   
        foreach ($conn->query($sql)as $row)
      { 
      if(substr($row['pwd'],0,25) == substr($token,0,25)) 
      {                 
       $_SESSION['email']=$row['email'];
           $_SESSION['username']= $row['username'];                  
           $_SESSION['password'] =$row['pwd'];
       $_SESSION['cus_Id'] =$row['cus_Id'];       
      }
      elseif(substr($row['pwd'] ,0,25)!= substr($token,0,25))
      {
        return "No";
       }      
         }
      //retrieve customer  details e.g name
     $sql = "select * from Customer where email = '$email'";
    $res=$conn->query($sql);
  $statement = $conn->prepare($sql);
    $statement->execute();
    $countx = $statement->rowCount();
  if ($countx > 0){
  
      foreach($conn->query($sql)as $row)
        {  
          $_SESSION['name']  = $row['name'];
          $_SESSION['cus_Id']= $row['cus_Id'];    
         
       $name =$_SESSION['name'];
     $username= $_SESSION['username'];
     $_SESSION['validated_name']=$name;
       $_SESSION['validated_username']= $username;
      $message= "Hi ".$name ." you are sign in as : ".$username;
    }
     } 
    return $message;   
   }
 }
else{
 
 }
 return "No" ;
}
function fix_string($string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return htmlentities(trim($string));
}

?>
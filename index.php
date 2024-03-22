<html>  
<head>  
    <title>Contact Form</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
</head>
<style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
 .msg{
  color:  red;
 }
</style>
<?php
include_once('connection.php');
if(isset($_REQUEST['name']))
{
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $mobile = $_REQUEST['mobile'];
  $message = $_REQUEST['msg'];

  $insert_query = mysqli_query($connection,"insert into contact_form set Name='$name', Email_Id='$email', Mobile='$mobile', Message='$message'");

  if($insert_query)
  {
$msg = '<div>
<p>'.ucfirst($name).' has submitted contact form.</p>
<p><b>Name:</b> '.($name).'</p>
<p><b>Email:</b> '.($email).'</p>
<p><b>Mobile:</b> '.($mobile).'</p>
<p><b>Message:</b> '.($message).'</p>
</div>';

include_once("smtpmail/class.phpmailer.php");
$email = ""; 
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPAuth = true;                 
$mail->SMTPSecure = "tls";      
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
$mail->Username = "";
$mail->Password = "";
$mail->FromName = "Tech Area";
$mail->AddAddress($email);
$mail->Subject = "Enquiry";
$mail->isHTML( TRUE );
$mail->Body =$msg;
if($mail->send())
   {
    $success =  "Feedback submitted successfully";
   }
 }
}
?>
<body>  
    <div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Contact Form</h3><br/>
    <div class="box">
     <form id="validate_form" method="post">  
      <div class="form-group">
       <label>Name</label>
       <input type="text" name="name" id="name" placeholder="Enter Name" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <label for="email">Email</label>
       <input type="text" name="email" id="email" placeholder="Enter Email" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <label for="mobile">Mobile No.</label>
       <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile" required  data-parsley-trigger="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <label for="msg">Message</label>
       <textarea name="msg" id="msg" placeholder="Enter your message" required  data-parsley-trigger="keyup" class="form-control"></textarea>
      </div>
       <div class="form-group">
       <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success">
       </div>
     </form>
     <div class="msg"><?php if(!empty($success)) { echo $success; }?></div>
    </div>
   </div>  
  </div>
 </body>  
</html>  

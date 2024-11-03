<?php
if(isset($_POST['submit_email']))
{
  
  include('config/koneksi.php');
  $email = $_POST['email'];
  
 $select=mysqli_query($kon, "select email,password FROM users WHERE email='$email'");
  if(mysqli_num_rows($select)==1)
  {
    while($row=mysqli_fetch_array($select))
    {
      $email=$row['email'];
      $pass=md5($row['password']);
    }
    //$link="<a href='localhost:8080/phpmailer/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require_once('phpmail/class.phpmailer.php');
    require_once('phpmail/class.smtp.php');
    $mail = new PHPMailer();
	
	$body      = "Click the following link to reset password, <a href='http://localhost/reset_password.php?reset=$pass&key=$email'>$pass<a>"; //isi dari email
				
   // $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "aplikasi.remind@gmail.com";
    // GMAIL password
    $mail->Password = "reminder123";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='aplikasi.remind@gmail.com';
    $mail->FromName='Reminder Me';
	  
	$email = $_POST['email'];
	
    $mail->AddAddress($email, 'User Sistem');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->MsgHTML($body);
	if($mail->Send())
    {
      echo "<script> alert('Email was sent, please check your inbox'); window.location = 'login.php'; </script>";//jika pesan terkirim
				
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }
else {
	echo "<script> alert('Your email is not registered in the system'); window.location = 'lupa_password.php'; </script>";//jika pesan terkirim
	
} 
}
?>
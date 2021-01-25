<?php
require './PHPMailer/PHPMailerAutoload.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<?php 
include_once('database.php');
include_once('header.php');
?>

<button onclick='history.go(-1);' id='profile_button_top'>Back</button>

<?php

if (isset($_POST['submit'])) {
	$email=$_POST['email'];
	$result=mysqli_query($db,"select * from users where email='$email'");
	
	if(mysqli_num_rows($result)==0){
		echo"<center><p style='color:tomato;margin-top:90px;margin-bottom:-80px;'><b>Email doesn't found on alloask.</b></p></center>";
	}
	while($row=mysqli_fetch_array($result)){
		$pass=$row['password'];
		$user=$row['name'];
		$email=$row['email'];

		$otp="Use this email and password to login to your PyHub Account.\nEmail: ".$email."\nPassword: ".$pass."\nUsername: ".$user."";


		######SEND EMAIL#####

		date_default_timezone_set('Etc/UTC');
		$mail = new PHPMailer;
		$mail->isSMTP();
		/*
		* Server Configuration
		*/
		echo !extension_loaded('openssl')?"Not available":"Available";
		$mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
		$mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
		$mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
		$mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
		$mail->Username = "alloasktechnologies@gmail.com"; // Your Gmail address.
		$mail->Password = "iwillwinthisworld"; // Your Gmail login password or App Specific Password.

		/*
		* Message Configuration
		*/

		$mail->setFrom('alloasktechnologies@gmail.com', 'PyHub'); // Set the sender of the message.
		$mail->addAddress($email , $username); // Set the recipient of the message.
		$mail->Subject = 'This is your password for PyHub.'; // The subject of the message.

		/*
		* Message Content - Choose simple text or HTML email
		*/
		
		// Choose to send either a simple text email...
		$mail->Body = $otp; // Set a plain text body.

		// ... or send an email with HTML.
		//$mail->msgHTML(file_get_contents('contents.html'));
		// Optional when using HTML: Set an alternative plain text message for email clients who prefer that.
		//$mail->AltBody = 'This is a plain-text message body'; 

		// Optional: attach a file
		#$mail->addAttachment('images/phpmailer_mini.png');

		if ($mail->send()) {
			echo "Your message was sent successfully!";
		} else {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		mail($email,'This is your OTP(One Time Password) for PyHub.',$otp);
	
		echo "<script>goBackFunction(2);</script>";

		exit();

		######SEND EMAIL#####

		}

	}


?>


<center>
	<div class='container'>
		<form action=<?php echo "forgot_password.php"; ?> method="POST" >
			<br>
			<p style='color:black;'>Enter Your Email. We'll send your password to your email.</p>
			<input style='width:100%;' id='search_text_field' type='text' name='email' autocomplete='off' placeholder='Your Email' required />
			<br><br>
			<input id='submit_btn' name='submit' type='submit' value='Send Password' />
		</form>
	</div>
</center><!--container-->



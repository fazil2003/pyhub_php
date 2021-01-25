<?php
require './PHPMailer/PHPMailerAutoload.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<meta name='viewport' content='user-scalable=0,width=device-width'/>
<link rel='stylesheet' href='/quesans/styles/main.css' />


<?php 
include_once('database.php');
include_once('header.php');
?>


<div class='container-form'>
<center>

		<form method="POST" action="signup.php" enctype="multipart/form-data">
				
		
		<h1>Sign up</h1>
		<p>Signup to Create Posts</p>


		<script>
		$(function(){
			$('#username_box').keyup(function()
			{
				var yourInput=$(this).val();
				//re=/[`~!@#$%^&*()_| +\-=?;:'",.<>\{\}\[\]\\\/]/gi;
				re=/[`~!@#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi;
				
				var isSplChar=re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char=yourInput.replace(/[`~!@#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi,'');
					$(this).val(no_spl_char);
					alert("You cannot enter special characters for username.");
				}
			});
		});
		</script>

		<script>
		$(function(){
			$('#username_box1').keyup(function()
			{
				var yourInput=$(this).val();
				//re=/[`~!@#$%^&*()_| +\-=?;:'",.<>\{\}\[\]\\\/]/gi;
				re=/[`~!#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi;
				
				var isSplChar=re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char=yourInput.replace(/[`~!@#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi,'');
					$(this).val(no_spl_char);
				}
			});
		});
		</script>

		<script>
		$(function(){
			$('#username_box2').keyup(function()
			{
				var yourInput=$(this).val();
				//re=/[`~!@#$%^&*()_| +\-=?;:'",.<>\{\}\[\]\\\/]/gi;
				re=/[`~!@#$%^&*()| +\=?;:'",<>\{\}\[\]\\\/]/gi;
				
				var isSplChar=re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char=yourInput.replace(/[`~!@#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi,'');
					$(this).val(no_spl_char);
					alert("You cannot enter special characters for password.");
				}
			});
		});
		</script>
		
		
		<style>
		.input{
			width:90%;
			padding:10px;
			font-size:20px;
			border:none;
			outline:none;
			border-radius:5px;
			font-family:Muli,sans-serif;
		}
		
		.div{
			position:relative;
		}
		.label{
			position:absolute;
			pointer-events:none;
			transition:0.5s;
			left:7%;
			top:13px;
			color:grey;
			font-family:Muli,sans-serif;
		}
		.input:focus{
			border-bottom:1px solid purple;
		}
		.input:focus ~ .label,
		.input:valid ~ .label{
			top:-14px;
			left:7%;
			font-size:12px;
			color:white;
			font-weight:bold;
		}
		</style>
		
		<div class='div'>
			<input class='input' type="text" name="username"  style='text-transform:lowercase' id='username_box' autocomplete='off' required >
			<label class='label'>Username</label>
		</div>
		<br>
		
		<div class='div'>
			<input class='input' type="email" name="mail"  style='text-transform:lowercase' id='username_box1' autocomplete='off' required >
			<label class='label'>Email</label>
		</div>
		<br>
		
		<div class='div'>
			<input class='input' type="password" name="password"  id='username_box2' autocomplete='off' required >
			<label class='label'>Password</label>
		</div>
		
		<br>
		<a href='forgot_password.php' style='color:white;font-weight:bold;'>Forgot Password?</a>
		<br><br>	
		
  		<button id='btn' class="subbtn" type="submit" name="upload"><b><font color="white">Sign up</font></b></button>
  
		</form>
		</div>
	
		<center>Have an account?<br><a href='login.php' style='color:white;'><b>Log in</a><br><br><br>
		<div class='footer'>&copy PyHub . </div>

		

<?php
if (isset($_POST['upload'])) {
$username=$_POST['username'];
$password=$_POST['password'];
$mail=$_POST['mail'];

$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);
$mail = mysqli_real_escape_string($db, $mail);

$username=strtolower($username);
$mail=strtolower($mail);

$result=mysqli_query($db,"select * from users where name='$username' OR email='$mail'");
$row=mysqli_num_rows($result);

$result1=mysqli_query($db,"select * from users where email='$mail'");
$row1=mysqli_num_rows($result1);
$result2=mysqli_query($db,"select * from users where name='$username'");
$row2=mysqli_num_rows($result2);
$row3=$row1+$row2;



$p=0;
if($row>0){
	if($row1>0 and $row2>0){
		echo "<center><div class='footers' >Oops ! This Username was already taken and Email was already used.</div></center>";
		$p=1;
	}
	if($row1>0 and $p!=1){
		echo "<center><div class='footers' >Oops ! This Email was already used.</div></center>";
	}
	if($row2>0 and $p!=1){
		echo "<center><div class='footers' >Oops ! This Username was already taken.</div></center>";
	}
}
else{
	$email=$mail;
	$characters='0123456789';
	$randomstring='';
	for($i=0;$i<6;$i++){
		$index=rand(0,strlen($characters)-1);
		$randomstring.=$characters[$index];
	}
	
	$otp='Enter the OTP : '.$randomstring.'';
	mysqli_query($db,"INSERT INTO email_verification(email,username,password,otp) VALUES ('$email','$username','$password','$randomstring')");
	?>
	
	
	<?php
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
	$mail->Subject = 'This is your OTP(One Time Password) for PyHub.'; // The subject of the message.

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
	header("location:verify_otp.php?mail=".$email."");
	exit();
	}
	}
?>


<style>
:root{
    --theme-color:rgb(125, 60, 152 );
	--secondary-color:rgb(165, 105, 189);
}
html{
	background:linear-gradient(to right,var(--theme-color) 0%, var(--secondary-color) 100%);
	color:white;
}
#btn{
	border:none;
	outline:none;
	background:transparent;
	border:1px solid white;
	padding:10px;
	width:80%;
	border-radius:5px;
}
#btn:active{
	transform:scale(0.9);
}
.container-form{
	margin-top:100px;
}
form{
	width:40%;
}
input{
	width:80%;
}

a{
    text-decoration:none;
}

@media screen and (max-width:980px){
	form{
		width:100%;
	}
}
</style>
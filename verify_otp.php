<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<meta name='viewport' content='user-scalable=0,width=device-width'/>
<link rel='stylesheet' href='/projects/elearn/style.css' />

<?php
##this is for database connectivity
include_once('database.php');
include_once('header.php');
?>

<center>
<div class='container'>
	<div class='heading-div'>
	<center><span>Enter the 6 digit code</span></center>
	</div>

	<?php
	if(!empty($_GET['code'])){
		$getcode=$_GET['code'];
	}
	else{
		$getcode='';
	}
	$mail=$_GET['mail'];
	?>

	<form action=<?php echo "verify_otp.php?mail=".$mail.""; ?> method="POST" >
		<p id='hint'>Please check your mail for OTP code.</p>
		<center><input type='number' placeholder='Code..' id='code' name='otp' value='<?php echo $getcode; ?>' autocomplete='off' required /></center>
		<br>
		<button type='submit' value='submit' id='btn1'  name='upload'  >Verify</button>
	</form>
</div>
</center><!--container-->

<?php

if (isset($_POST['upload'])) {
	$email=$_GET['mail'];
	
	if(!empty($_POST['otp'])){
		$otp=$_POST['otp'];
		$result=mysqli_query($db,"select * from email_verification WHERE otp='$otp' AND email='$email'");
		if(mysqli_num_rows($result)>0){
			$query_verify=mysqli_query($db,"SELECT * FROM email_verification WHERE email='$email'");
			while($row=mysqli_fetch_array($query_verify)){
				$username=$row['username'];
				$password=$row['password'];
			}
			mysqli_query($db,"DELETE FROM email_verification WHERE email='$email'");
			
			
			date_default_timezone_set('Asia/Calcutta');
			$y=date("Y");
			$m=date("m");
			$d=date("d");
			$m_name=date("F",mktime(0,0,0,$m,10));
		
			$date=$d." ".$m_name." ".$y;
			$time=date("h:i:sa");
			####################
			
			$username_capital=ucfirst($username);
	
			mysqli_query($db,"INSERT INTO users (name,password,email) VALUES ('$username','$password','$email')");
			
	
			$result=mysqli_query($db,"SELECT * FROM users WHERE name='$username'");

	
			while($row=mysqli_fetch_array($result)){
				if($row['name']==$username){
					
					$_SESSION['name']=$username;
					$_SESSION['id']=$row['id'];
					setcookie("user",$_SESSION['name'],time()+60*60*24*100,'/');
					setcookie("id",$_SESSION['id'],time()+60*60*24*100,'/');
  
  
					$url="home.php";
					header("location:".$url);
					exit();
				}
				else{
					echo"password don't match";
				}

			}
		}
		else{
			echo "<center><div id='footer'>The code you enter is invalid.</div></center>";
		}
	}

}

?>

<style>
:root{
    --theme-color:rgb(125, 60, 152 );
	--secondary-color:rgb(165, 105, 189);
}

#hint{
	color:var(--theme-color);
	font-size:16px;
}

#btn1{
	font-size:20px;
	padding:5px;
	width:120px;
	font-weight:bold;
	border-radius:5px;
	color:var(--theme-color);
	background:transparent;
	border:none;
}
#btn1:active{
	transform:scale(1.2);
}
	
#code{
	border:0.5px solid black;
	font-size:25px;
	background-color:white;
	border-radius:5px;
	padding:10px;
	width:300px;
}
#code:focus{
	border-color:var(--theme-color);
}
#container{
	width:50%;
	#text-align:left;
	margin-top:55px;
}
@media screen and (max-width:980px){
	#container{
		width:100%;
	}
}
</style>
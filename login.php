<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<meta name='viewport' content='user-scalable=0,width=device-width'/>
<link rel='stylesheet' href='/quesans/styles/main.css' />
<?php 
include_once('database.php');
include_once('header.php');
?>

<div class='container-form'>
<center>

		<form method="POST" action="login.php" enctype="multipart/form-data">
		
		<h1>Login</h1>
		<p>Login to Create Posts</p>

		<script>
		$(function(){
			$('#username_box').keyup(function()
			{
				var yourInput=$(this).val();
				
				re=/[`~!#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi;
				
				var isSplChar=re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char=yourInput.replace(/[`~!#$%^&*()| +\-=?;:'",<>\{\}\[\]\\\/]/gi,'');
					$(this).val(no_spl_char);
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
		<input class='input' type="text" name="name" style='text-transform:lowercase' id='username_box' autocomplete='off' required />
		<label class='label'>Email or Username</label>
		</div>
		<br>
		<div class='div'>
		<input class='input' type="password" name="password" autocomplete='off' required />
		<label class='label'>Password</label>
		</div>
		
		<br>
		<a href='forgot_password.php' style='color:white;font-weight:bold;'>Forgot Password?</a>
		<br><br>	
		
  		<button id='btn' class="subbtn" type="submit" name="upload"><b><font color="white">Log in</font></b></button>
  
		</form>
		
		</center>
		</div>
		
		<center>Does not have an account?<br><a href='signup.php' style='color:white;'><b>Create New Account</a><br><br><br>
		<div class='footer'>&copy PyHub . </div>
		</center>
		

<?php
if (isset($_POST['upload'])) {
$username=$_POST['name'];
$password=$_POST['password'];

$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);
$username=strtolower($username);

$result=mysqli_query($db,"select * from users where (name='$username' and password='$password') OR (email='$username' and password='$password')");
if(mysqli_num_rows($result)==0){
	echo"<center><div class='footers' >Oops ! Password and Username not match.</div></center>";
}
while($row=mysqli_fetch_array($result)){
if(($row['name']==$username and $row['password']==$password) or ($row['email']==$username and $row['password']==$password)){
	

	$_SESSION['user']=$row['name'];
	$_SESSION['id']=$row['id'];
	setcookie("user",$_SESSION['user'],time()+60*60*24*100,'/');
	setcookie("id",$_SESSION['id'],time()+60*60*24*100,'/');
  
  
	$url="home.php";
	header("location:".$url);
	exit();
	}
	else{
		echo"<center><div class='footers' >Oops ! Password and Username not match.</div></center>";
	}

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
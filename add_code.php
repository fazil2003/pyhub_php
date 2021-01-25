<?php
include_once("database.php");
include_once("header.php");
?>


<?php
if(isset($_POST['submit'])){
    $user=$_COOKIE['user'];
    $title=$_POST['title'];
	$description=$_POST['description'];
	$tags=$_POST['tags'];
	$code=$_POST['code'];
	$output=$_POST['output'];

	$title=addslashes($title);
	$description=addslashes($description);
	$tags=addslashes($tags);
	$code=addslashes($code);
	$output=addslashes($output);
		
	$user_id=0;
    $find_user_query=mysqli_query($db,"SELECT * FROM users WHERE name='$title'");
    while($find_user_row=mysqli_fetch_array($find_user_query)){
        $user_id=$find_user_row['id'];
    }
	
	
	$query=mysqli_query($db,"SELECT * FROM users WHERE name='$user'");
	while($row=mysqli_fetch_array($query)){
		$user_id=$row['id'];
		
		mysqli_query($db,"INSERT INTO posts (title,description,tags,code,output,user_id) VALUES ('$title','$description','$tags','$code','$output',$user_id)");
		echo "<script>goBackFunction(2);</script>";
	}
	
}
?>

<button onclick='history.go(-1);' id='profile_button_top'>Back</button>
<a href='logout.php'><button id='logout_button_top'>Logout</button></a>

<center>
    <div class='container'>
        <form action='add_code.php' method='post'>
		
			<input class='bold_ask' id='input_ask' type='text' placeholder='Enter Title...' name='title' required/>
            
			<textarea id='textarea_ask' name='description' placeholder='Enter Description...' required></textarea>

			<input id='input_ask' type='text' placeholder='Enter Tags...' name='tags' required/>

			<textarea id='textarea_ask' name='code' placeholder='Enter Code...'></textarea>

			<textarea id='textarea_ask' name='output' placeholder='Enter Output...'></textarea>

			<br><br>

            <input id='submit_btn' name='submit' type='submit' value='Add Code' />
        </form>
    </div>
</center>
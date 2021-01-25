<?php
include_once("database.php");
include_once("header.php");
?>

<?php
$question_id=$_GET['question_id'];
?>

<?php
if(isset($_POST['submit'])){
    $question_id=$_GET['question_id'];

    $user=$_COOKIE['user'];
    $answer=$_POST['answer'];

    $query=mysqli_query($db,"SELECT * FROM users WHERE name='$user'");
    while($row=mysqli_fetch_array($query)){
        $user_id=$row['id'];
    }

    $result=mysqli_query($db,"SELECT * FROM answers WHERE question_id=$question_id");
    if(mysqli_num_rows($result)>2){
        mysqli_query($db,"UPDATE questions SET max_answers='yes' WHERE id=$question_id");
    }
    else if(mysqli_num_rows($result)==2){
        mysqli_query($db,"UPDATE questions SET max_answers='yes' WHERE id=$question_id");
        mysqli_query($db,"INSERT INTO answers (answer,user_id,question_id) VALUES ('$answer','$user_id',$question_id)");
    }
    else{
        mysqli_query($db,"INSERT INTO answers (answer,user_id,question_id) VALUES ('$answer','$user_id',$question_id)");
    }

    echo "<script>goBackFunction(2);</script>";
}
?>

<button onclick='history.go(-1);' id='profile_button_top'>Back</button>
<a href='logout.php'><button id='logout_button_top'>Logout</button></a>

<center>
    <div class='container'>
        <form action='answer.php?question_id=<?php echo $question_id; ?>' method='post'>
            <textarea id='ask_question_box' name='answer' placeholder='Type your Answer here...' required></textarea>
            
            <br><br>

            <input id='submit_btn' name='submit' type='submit' value='Answer' />
        </form>
    </div>
</center>
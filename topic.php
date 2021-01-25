<?php
include_once("header.php");
include_once("database.php");
?>

<?php
if(isset($_POST['category'])){
    $selected_category=$_POST['category'];
}
else{
    $selected_category=$_GET['category'];
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<a href='add_code.php'><button id='ask_button_top'>Add Code</button></a>

<button onclick='history.go(-1);' id='profile_button_top'>Back</button>

<?php
    if(!isset($_COOKIE['user'])){
        echo "<a href='login.php'><button id='logout_button_top'>Login</button></a>";
    }
    else{
        echo "<a href='logout.php'><button id='logout_button_top'>Logout</button></a>";
    }
?>

<center>
    <div class='container' style='text-align:left'>
        <div class='profile'>
            <?php
            // $query_for_user=mysqli_query($db,"SELECT * FROM users WHERE id='".$_COOKIE['id']."'");
            // while($row_for_user=mysqli_fetch_array($query_for_user)){
            echo "<p id='heading_field'>".$selected_category."</p>";
            echo "Results for \"<b>".$selected_category."</b>\"";
            // }
            ?>
        </div>

        <div class='container_inner'>
            <!--content display here-->
        </div>
    </div>
    <div class='message'></div>
</center>

<?php
    if(!isset($_COOKIE['user'])){
        echo "<a href='login.php'>
                <div id='ask_question_pencil'>
                    <img src='/pyhub/images/edit.png' />
                </div>
                </a>";
    }
    else{
        echo "<a href='add_code.php'>
                <div id='ask_question_pencil'>
                    <img src='/pyhub/images/edit.png' />
                </div>
                </a>";
    }
?>

<script>
  
$(document).ready(function(){
 
 var limit = 15;
 var start = 0;
 var action = 'inactive';
 function load_country_data(limit, start)
 {
  $.ajax({
   url:"fetch_topic.php?selected_category=<?php echo $selected_category;?>",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('.container_inner').append(data);
    if(data == '')
    {
     $('.message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
     action = 'active';
    }
    else
    {
	 
     $('.message').html("");
	  action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $(".container").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
});
</script>
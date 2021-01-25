<?php
include_once("header.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<a href='add_code.php'><button id='ask_button_top'>Add Code</button></a>



<?php
    if(!isset($_COOKIE['user'])){
        echo "<a href='login.php'><button id='logout_button_top'>Login</button></a>";
        echo "";
    }
    else{
        echo "<a href='logout.php'><button id='logout_button_top'>Logout</button></a>";
        echo "<a href='profile.php'><button id='profile_button_top'>Profile</button></a>";
    }
?>


<center>
    <div class='container' style='text-align:left'>


        <div class='profile' id='searchForm'>
            <form method='get' action='topic.php'>
                <input id='search_text_field' type='text' name='category' placeholder='Search' required />
                <input id='search_button' type='submit' value='GO' />
            </form>
        </div>

        <a href='topic.php?category=data-structures'><div class='profile' id='buttonForm'>📈 Data Structures</div></a>
        <a href='topic.php?category=data-science'><div class='profile' id='buttonForm'>📊 Data Science</div></a>
        <a href='topic.php?category=gui-programming'><div class='profile' id='buttonForm'>🖼 GUI programming</div></a>
        <a href='topic.php?category=mobile-application'><div class='profile' id='buttonForm'>📱 Mobile Application</div></a>
        <a href='topic.php?category=dynamic-programming'><div class='profile' id='buttonForm'>💻 Dynamic Programming</div></a>
        <a href='topic.php?category=web-development'><div class='profile' id='buttonForm'>🌎 Web Development</div></a>
        


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
   
   $('.container_inner').load("fetch.php");

});
</script>
<?php
include_once("database.php");
?>

<?php


        $query=mysqli_query($db,"SELECT * FROM posts ORDER BY RAND() LIMIT 20");

        while($row=mysqli_fetch_array($query)){
               
            $user_id=$row['user_id'];
            $query_user=mysqli_query($db,"SELECT * FROM users WHERE id=$user_id");
            while($row_user=mysqli_fetch_array($query_user)){
                $row_user_name=$row_user['name'];
            }
            
            //Convert Date to Our Read Format
            $timestamp=strtotime($row['date']);
            $newDate=date('d-F-Y',$timestamp);
            

            echo "<div class='content'>";
           
            echo "<a href='profile.php?username=".$row_user_name."'><span id='name'><b>👤 ".$row_user_name."</b> ➔ ".$newDate."</span></a><br><br>";

            echo "<p id='title'><span style='font-size:16px;top:-2px;position:relative;'>📄</span> ".$row['title']."</p>
            <p id='description'>".$row['description']."</p>
            <span id='category'><b>#</b> ".$row['tags']."</span><br><br>";

            if(isset($_COOKIE['user'])){
                if($_COOKIE['user']==$row_user_name || $_COOKIE['user']=='admin'){
                    echo "<a href='view_code.php?post_id=".$row['id']."'><button id='edit_btn'>View</button></a> ";
                    echo "<a href='delete.php?post_id=".$row['id']."'><button id='edit_btn'>Delete</button></a>";
                }
                else{
                    echo "<a href='view_code.php?post_id=".$row['id']."'><button id='edit_btn'>View</button></a>";
                }
            }
            else{
                echo "<a href='view_code.php?post_id=".$row['id']."'><button id='edit_btn'>View</button></a>";
            }
            
            echo "</div>";
        }
        ?>
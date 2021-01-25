<?php
setcookie("user",NULL,time()+60*60*24*100,'/');
setcookie("id",NULL,time()+60*60*24*100,'/');
header("Location:index.php");
exit(0);
?>
<?php
include_once('database.php');
include_once('header.php');
?>

<?php
mysqli_query($db,"DELETE FROM posts WHERE id=".$_GET['post_id']."");

echo "<script>goBackFunction(1);</script>";
?>

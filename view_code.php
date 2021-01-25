<?php
include_once("database.php");
include_once("header.php");
?>

<!--Syntax Highlighter-->
<link rel='stylesheet' href='/pyhub/syntax_highlighter/styles/default.css'/>
<script src='/pyhub/syntax_highlighter/highlight.pack.js'></script>
<script>hljs.initHighlightingOnLoad()</script>
<!--/Syntax Highlighter-->

<?php
$question_id=$_GET['post_id'];

$query=mysqli_query($db,"SELECT * FROM posts WHERE id=$question_id");
while($row=mysqli_fetch_array($query)){
    $question=$row['title'];
    $tags=$row['tags'];
    $description=$row['description'];
    $code=$row['code'];
    $output=$row['output'];
}
?>

<button onclick='history.go(-1);' id='profile_button_top'>Back</button>

<center>
    <div class='container'>
        <p class='title-view'><?php echo $question; ?></p>
        <p class='description-view'><?php echo nl2br($description); ?></p>
        <p class='tags-view'># <?php echo $tags; ?></p>

        <?php
        if($code!=""){
            echo "<p class='head-view'>CODE</p>
                <div class='code'>
                    <pre><code class='python'>".$code."</code></pre>
                </div>";
        }

        if($output!=""){
            echo "<p class='head-view'>OUTPUT</p>
                <div class='code'>
                    <pre><code class='python'>".$output."</code></pre>
                </div>";
        }

        ?>
        
    </div>
</center>
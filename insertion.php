<?php
//insert.php
include("connect.php");
function insert()
{
    if(isset($_POST["subject"]))
    {
        $connect=connex();
        /*$subject = mysqli_real_escape_string($connect, $_POST["subject"]);
        $comment = mysqli_real_escape_string($connect, $_POST["comment"]);*/
        $subject=$_POST["subject"];
        $comment=$_POST["comment"];
        $query = "
        INSERT INTO comments(comment_subject, comment_text)
        VALUES ('".$subject."','".$comment."')
        ";
        //mysqli_query($connect, $query);
        $recipesStatement = $connect->prepare($query);
        $recipesStatement->execute();
    }
}
?>
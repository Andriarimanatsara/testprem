<?php
//fetch.php;
include("connect.php");

if(isset($_POST["view"]))
{
    $connect=connex();
    if($_POST["view"] != '')
    {
        $update_query = "UPDATE comments SET comment_status=1 WHERE comment_status=0";
        //mysqli_query($connect, $update_query);
        $recipesStatement = $connect->prepare($update_query);
        $recipesStatement->execute();
    }
    $query = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
    //$result = mysqli_query($connect, $query);
    $recipesStatement = $connect->prepare($query);
    $recipesStatement->execute();
    $result = $recipesStatement->fetchAll();
    $output = '';
    
    //if(mysqli_num_rows($result) > 0)
    if(count($result)>0)
    {
        //while($row = mysqli_fetch_array($result))
        foreach($result as $row)
        {
            $output .= '
            <li>
                <a href="#">
                <strong>'.$row["comment_subject"].'</strong><br />
                <small><em>'.$row["comment_text"].'</em></small>
                </a>
            </li>
            <li class="divider"></li>
            ';
        }
    }
    else
    {
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }
    
    $query_1 = "SELECT * FROM comments WHERE comment_status=0";
    //$result_1 = mysqli_query($connect, $query_1);
    //$count = mysqli_num_rows($result_1);
    
    // $i=0;
    // $liste=array();
    // while($row = mysqli_fetch_assoc($result_1))
    // {
    //     $liste[$i]=$row['comment_id'];
    //     $i++;
    // }
    // $countInt=count($liste);
    // $count=strval($countInt);

    $recipesStatement2 = $connect->prepare($query_1);
    $recipesStatement2->execute();
    $result_1 = $recipesStatement2->fetchAll();
    $countInt=count($result_1);
    $count=strval($countInt);
    
    $data = array(
    'notification'   => $output,
    'unseen_notification' => $count
    );
    echo json_encode($data);
}
?>
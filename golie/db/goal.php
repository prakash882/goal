<?php
session_start();
$user_id = $_SESSION['user_id'];
include('connect.php');
if(isset($_POST['goal'])){
    $goal = $_POST['goal'];
    $descriptions = $_POST['descriptions'];
    $time = date('Y-m-d');
    if($goal!=''){
        $query = "INSERT INTO goal_table(goal_title,accomplish_date,descriptions,user_id) VALUES('$goal','$time','$descriptions','$user_id')";
         if(mysqli_query($conn,$query)){
             $msg = "successfully inserted";

         }else{
             $msg = mysqli_error($conn);
         }
         header('location:../home.php?msg='.$msg);

    }else{
        $msg = "goal name required";
        header('Location:../home.php?errmsg='.$msg);
    }
}
?>
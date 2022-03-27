<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM goal_table WHERE id = '$id'";
        include('connect.php');
        if(mysqli_query($conn,$query)){
            header("Location:../home.php?msg=successfull delete");
        }else{
            header("Location:../home.php?errmsg=".mysqli_error($conn));
        }
    }
    
?>
<?php
        if(!isset($_POST['goal_title'])){
    die('cannot edit the record');
}else{
    $c=$_POST['goal_title'];
    $i=$_POST['descriptions'];
    $id=$_POST['id'];
    include('connect.php');
    $query="UPDATE goal_table SET goal_title='$c',descriptions='$i' WHERE id='$id'";
    if(mysqli_query($conn,$query)){
        header('location:../home.php?msg=succesfully updated');
    }else{
        header('location:../home.php?errmsg='.mysqli_error($conn));
    }
}
?>
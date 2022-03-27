<?php
session_start();
 if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
   header('Location:login.php');
 }
 $id = $_SESSION['user_id']; 
 $user_id = $_SESSION['user_id']; 

 include('db/connect.php');
 $query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$goalQuery="SELECT * FROM goal_table where user_id = '$user_id'";
$goalResult=mysqli_query($conn, $goalQuery);


?>

<html>

<head>
    <title>home-Goal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!-- this is navbar -->
    <?php include('include/nav.php');?>

    <div class="container">
        <div class="row">


            <div class="col-8">
                <form action="db/goal.php" method="POST">
                    <label for="" style="background-color:purple; color:white; padding:10px; width:100%;">Goal
                        Title</label>
                        <br>
                    <div class="input-group">
                        <input type="text" name="goal" class="form-control">
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="fa icon class" name="descriptions">
                    </div>
                    <hr/>
                    <button type="submit" class="btn btn-primary" style="background-color:purple;">Save</button>
                </form>
                <?php include('include/message.php'); ?>

                <div class="row justify-content-md-center">
                    <?php
                    if(mysqli_num_rows($goalResult)==0){
                      echo "<h3>No goal found</h3>";
                    }
                    else { ?>
                    <table class="table">
                        <thead>
                            <th>Title</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                         <?php while($row=mysqli_fetch_assoc($goalResult)){ ?>
                            <tr>
                                <td><?php echo $row['goal_title'] ?></td>
                                <td> <a href ="#" onclick="deleteConfirmation(<?php echo $row['id'];?>);"><i class="fas fa-trash-alt" style="color:purple"></i></a> |
                                <a href="edit-goal.php?id=<?php echo $row['id'];?>" ><i class="fas fa-edit" style="color:purple" ></i></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php  } ?>

                </div>
            </div>
        </div>
    </div>

    <script
	src="https://code.jquery.com/jquery-3.6.0.min.js"
     integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a74baea4b2.js" crossorigin="anonymous"></script>
    <script src="js/bootbox.min.js"></script>
    <script>
        function deleteConfirmation(id){
            bootbox.confirm({
    message: "Are you sure?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        if(result){
            window.location='db/delete-goal.php?id='+id;
        }
    }
});

        }
        </script>
   
</body>

</html>
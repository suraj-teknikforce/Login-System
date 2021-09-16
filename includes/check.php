<?php
    include 'connection.php';
    date_default_timezone_set("Asia/Kolkata");

    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM userlogin WHERE verificationId='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $result = mysqli_query($con, "SELECT * FROM userlogin WHERE verificationId='$id' AND active=0 AND NOW() <= DATE_ADD(createdDate, INTERVAL 24 HOUR)");
    $count = mysqli_num_rows($result);

    if(!empty($count)){
        setQuery($con, "UPDATE userlogin  SET active='1' WHERE verificationId='$id'");
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title></title>
            
            <!-- CSS Files -->
            <link rel="stylesheet" href="../assets/style.css">
        </head>
        <body>
            <div class="box">
            <center>
                <h2>You're registered successfully.</h2> <br><br>
                <a href="../" class="center">Click here to login.</a>
            </center>
            </div>
        </body>
        </html>
        <?php
    }

    else{
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title></title>
            
            <!-- CSS Files -->
            <link rel="stylesheet" href="../assets/style.css">
        </head>
        <body>
            <div class="box">
                <center>
                    <h2>Invalid Verification Id</h2> <br><br>
                    <a href="../register.php" class="center">Go to previous menu.</a>
                </center>
            </div>
        </body>
        </html>
        <?php
    }

    function setQuery($con, $sql){
        mysqli_query($con, $sql);
    }
?>
<?php
    include 'connection.php';
    date_default_timezone_set("Asia/Kolkata");

    $id = mysqli_real_escape_string($con, $_GET['id']);
    $result = mysqli_query($con, "SELECT * FROM userlogin WHERE verificationId='$id' AND active=0 AND NOW() <= DATE_ADD(createdDate, INTERVAL 15 MINUTE)");
    $count = mysqli_num_rows($result);
    ?>

    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Verification</title>
            
            <!-- CSS Files -->
            <link rel="stylesheet" href="../assets/style.css">
        </head>
        <body>
            <div class="box">
                <center>
    <?php
    if(!empty($count)){
        setQuery($con, "UPDATE userlogin  SET active='1' WHERE verificationId='$id'");
        ?>
        <h2>You're registered successfully.</h2> <br><br>
        <a href="../" class="center">Click here to login.</a>
        <?php
    }

    else{
        ?>
        <h2>Invalid Verification Id</h2> <br><br>
        <a href="../register.php" class="center">Go to previous menu.</a>
        <?php
    }

    ?>
                </center>
            </div>
        </body>
        </html>
<?php
    function setQuery($con, $sql){
        mysqli_query($con, $sql);
    }
?>
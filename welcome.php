<?php
    include 'includes/connection.php';
    session_start();

    if(isset($_POST['logout'])){
        $id = $_SESSION['id'];
        $res = mysqli_query($con, "UPDATE userlogin SET isLogin = '0' WHERE id = '$id'");
        
        session_destroy();
        echo "<script>window.close();</script>";
    }

    if(!isset($_SESSION['id'])){
        header('location: ../login-system');
        die();
    }

    else{
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <title>Welcome</title>

            <link rel="stylesheet" href="assets/style.css">
        </head>
        <body>
        <div class="box">
            <h2>Hello, welcome to Teknikforce.</h2>
            <br>
            <form method="POST">
                <p>
                    <input type="submit" name="logout" value="Logout">
                </p>
            </form>
        </div>
        </body>
        </html>
        <?php
    }
?>
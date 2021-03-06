<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/style.css">

    <!-- JQuery File -->
    <script src="assets/jquery.min.js"></script>
</head>
<body>
    <div class="box">
        <h2>Sign in</h2>
        <p>Welcome to Teknikforce</p>
        <form method="POST" id="loginForm">
            <div class="inputBox">
                <input type="email" name="email" id="email" onkeyup="this.setAttribute('value', this.value);" value="" required >
                <label>Email</label>
            </div>
            <div class="inputBox">
                <input type="password" 
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                        title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                        name="password" onkeyup="this.setAttribute('value', this.value);" 
                        value="" required >
                <label>Password</label>
                <input type="hidden" name="sign" value="1">
            </div>
            <input type="submit" name="sign-in" id="sign-in" value="Sign In">
            <a href="register.php" class="left">Register</a>
        </form>

        <br><br><div class="error-field">
            <p id="error"></p>
        </div>

    </div>

    <script>
        var error = document.getElementById("error");

        $(document).ready(function(){ error.style.display = "none"; });

        jQuery('#loginForm').on('submit', function(e){

            jQuery.ajax({
                url: 'includes/login.php',
                type: 'POST',
                data: jQuery('#loginForm').serialize(),
                success: function(result){
                    if(result == 1){
                        error.innerHTML = "";
                        window.open('welcome.php');
                    }
                    
                    else{
                        error.style.cssText = "display: block; background: #F1F0E2; padding: 5px; border: 1px solid #dadce0; -webkit-border-radius: 8px; border-radius: 8px;";
                        error.innerHTML = result;
                    }
                }
            });
            e.preventDefault();
        });

        function myFunction(){
            var email = document.getElementById("email").value;
            var id = document.getElementById("hiddenId").value;
            error.innerHTML = "Please wait.";

            jQuery.ajax({
                url: 'includes/login.php',
                type: 'POST',
                data: {email : email, sign:id},
                success: function(result){
                    error.style.cssText = "display: block; background: #F1F0E2; padding: 5px; border: 1px solid #dadce0; -webkit-border-radius: 8px; border-radius: 8px;";
                    error.innerHTML = result;
                }
            });
        }
    </script>
</body>
</html>
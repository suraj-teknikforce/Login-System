<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/jquery.min.js"></script>
</head>
<body>
    <div class="box">
        <h2>Sign Up</h2>
        <p>New to Teknikforce</p>
        <form method="POST" id="loginForm">
        <div class="inputBox">
                <input type="text" name="name" onkeyup="this.setAttribute('value', this.value);" value="" required >
                <label>Full Name</label>
            </div>
            <div class="inputBox">
                <input type="email" name="email" onkeyup="this.setAttribute('value', this.value);" value="" required >
                <label>Email</label>
            </div>
            <div class="inputBox">
                <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                name="password" onkeyup="this.setAttribute('value', this.value);" 
                value="" required >
                <label>Password</label>
                <input type="hidden" name="sign" value="2">
            </div>
            <input type="submit" name="sign-up" value="Sign Up">
            <a href="../login" class="left">Login</a>
        </form>

        <br><br><div class="error-field">
            <p id="error"></p>
        </div>
    </div>

    <script>
        var error = document.getElementById("error");

        $(document).ready(function(){ error.style.display = "none"; });
            
        jQuery('#loginForm').on('submit', function(e){
            error.style.cssText = "display: block; background: #F1F0E2; padding: 5px; border: 1px solid #dadce0; -webkit-border-radius: 8px; border-radius: 8px;";
            error.innerHTML = "Please wait.";
            
            jQuery.ajax({
                url: 'includes/login.php',
                type: 'POST',
                data: jQuery('#loginForm').serialize(),
                success: function(result){
                    error.innerHTML = result;
                }
            });
            e.preventDefault();
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification</title>

    <style>
        body {
    margin: 0;
    padding: 0;
    background-size: cover;
    font-family: sans-serif;
  }
  
  .box {
    width: 25rem;
    padding: 2.5rem;
    box-sizing: border-box;
    border: 1px solid #dadce0;
    -webkit-border-radius: 8px;
    border-radius: 8px;

  }
  
  .box h2 {
    margin: 0px 0 -0.125rem;
    padding: 0;
    color: #fff;
    text-align: center;
    color: #202124;
    font-family: 'Google Sans','Noto Sans Myanmar UI',arial,sans-serif;
    font-size: 24px;
    font-weight: 400;
  }

  .box p {
    font-size: 16px;
    font-weight: 400;
    letter-spacing: .1px;
    line-height: 1.5;
    margin-bottom: 25px;
    text-align: center;
  }

  a {
      text-decoration:none;
    border: none;
    outline: none;
    color: #fff !important;
    background-color: #1a73e8;
    padding: 0.625rem 1.25rem;
    cursor: pointer;
    border-radius: 0.312rem;
    font-size: 1rem;
  }
  
  a:hover {
    background-color: #287ae6;
    box-shadow: 0 1px 1px 0 rgba(66,133,244,0.45), 0 1px 3px 1px rgba(66,133,244,0.3);
  }
    </style>

</head>
<body>
    <center><div class='box'>
        <h2>Verification</h2>
        <p>
            Hello {TO_NAME} <br><br>
            Please confirm your account by clicking the button below. Code is valid only for 24 Hours. <br><br>
            <a href='localhost/teknikforce/Login/includes/check.php?id={VERIFICATION_ID}'>Click Here</a>
        </p>
    </div></center>
</body>
</html>
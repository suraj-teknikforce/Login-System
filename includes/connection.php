<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "teknikforce";

    $con = new mysqli($serverName, $userName, $password, $dbName);

    if (!$con) die('Connection failed: ' . $con->connect_error);
?>
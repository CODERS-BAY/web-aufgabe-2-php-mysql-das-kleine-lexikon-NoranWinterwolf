<?php
$host = "localhost";
$pw = "wolf123";
$user = "Noran";
$db = "matthias_web";

$con = new mysqli($host, $user, $pw, $db);

if ($con->connect_errno) {
    printf("Connection failed: %sn" . $con->connect_error);
    exit();
}

<?php
// start session
session_start();
//destroy session
if (session_destroy()) {
    //redirect to index.php
    header("Location: ../index.php");
}

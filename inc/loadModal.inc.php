<?php
define('SECURE', true);
session_start();
include('login.inc.php');

$entryID = $_REQUEST['lexikonID'];
$result = $con->query("SELECT title, imgpath, description FROM content WHERE id = " . $entryID);

$response = "<div class='modal-header'>";

while ($entry = $result->fetch_assoc()) {
    $response .= "<h5 class='modal-title' id='exampleModalLabel'>" . $entry['title'] . "</h5>";
    $response .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $response .= "</div>";
    $response .= "<div class='modal-body'>";
    $response .= "<img src='upload-img/" . $entry['imgpath'] . "' class='card-img-top' alt='...'>";
    $response .= $entry['description'];
    $response .= "</div>";
}
echo $response;

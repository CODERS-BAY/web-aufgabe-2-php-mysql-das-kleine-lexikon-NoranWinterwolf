<?php
define('SECURE', true);
include('../inc/login.inc.php');

if (!empty($_POST)) {
    $output = "";
    $message = "";
    if ($_POST['entry_id'] != NULL) {
        if ($_POST['deleteIMG'] != NULL) {
            $target_dir = "../upload-img/";
            $checkFile = $_POST['deleteIMG'];
            if (file_exists($target_dir . $checkFile)) {
                unlink($target_dir . $checkFile);
            }
        }
    }

    $stmt = $con->prepare("DELETE FROM content WHERE id = ?");

    if (false === $stmt) {
        die('prepare-statement failed: ' . htmlspecialchars($con->error));
    }
    $id = $_POST['entry_id'];
    $rc = $stmt->bind_param('s', $id);
    if (false === $rc) {
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }
    $result = $stmt->execute();
    $message = "Eintrag gelöscht!";
    if ($result) {
        $output .= '<label class="text-success">' . $message . '</label>';
        $result = $con->query("SELECT * FROM content ORDER BY id DESC");
        while ($entry = $result->fetch_assoc()) {
            $output = include('dataTable.inc.php');
        }
    }
    echo $message;
}

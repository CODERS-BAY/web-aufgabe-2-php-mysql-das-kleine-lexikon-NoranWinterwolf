<?php
define('SECURE', true);
include('../inc/login.inc.php');

if (!empty($_POST)) {
    $output = "";
    $message = "";
    //print_r($_POST);
    $id = $_POST['entry_id'];
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $teaser = mysqli_real_escape_string($con, $_POST["teaser"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);

    if ($_POST['entry_id'] != '') {
        if ($_FILES["imgUpdate"]["size"] != 0) {
            $file = $_FILES["imgUpdate"]["name"];
            $checkFile = $con->prepare("SELECT imgpath FROM content WHERE id = ?");
            $checkFile->bind_param('s', $id);
            $checkFile->execute();
            $checkFile->bind_result($imgpath);
            $checkFile->fetch();
            $checkFile->free_result();
            $target_dir = "../upload-img/";
            if (file_exists($target_dir . $imgpath)) {
                unlink($target_dir . $imgpath);
            }
            $uploadOK = 1;
            $target_file = $target_dir . basename($_FILES['imgUpdate']['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (isset($_POST)) {
                $check = getimagesize($_FILES["imgUpdate"]["tmp_name"]);
                if ($check !== false) {
                    //echo "File is an image - " . $check['mime'] . ".";
                    $uploadOK = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOK = 0;
                }
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOK = 0;
            }
            //Check if $uploadOK is set to 0 by an error
            if ($uploadOK == 0) {
                echo "File not uploaded";
            } else {
                //try to upload file
                if (move_uploaded_file($_FILES["imgUpdate"]["tmp_name"], $target_file)) {
                    //echo "The file " . basename($_FILES["imgUpdate"]["name"]) . " has been uploaded.";
                } else {
                    echo "An error occured.";
                }
            }
        } else {
            $file = NULL;
        }
    }

    if ($file != NULL) {
        $stmt = $con->prepare("UPDATE content SET title = ?, teaser = ?, imgpath = ?, description = ? WHERE id = ?");

        $stmt->bind_param('sssss', $title, $teaser, $file, $description, $id);
    } else {
        $stmt = $con->prepare("UPDATE content SET title = ?, teaser = ?, description = ? WHERE id = ?");
        $stmt->bind_param('ssss', $title, $teaser, $description, $id);
    }
    $result = $stmt->execute();

    if ($result) {
        $output .= include('dataTable.inc.php');
    }
    echo "Eintrag erfolgreich bearbeitet.";
}

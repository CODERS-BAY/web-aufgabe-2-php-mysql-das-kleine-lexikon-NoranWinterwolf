<?php
session_start();

require_once("../inc/login.inc.php");

if (isset($_GET['register'])) {
    $error = false;
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    $username = trim(htmlspecialchars($_POST['username']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte gib eine g&uumlltige E-Mail-Adresse ein!';
        $error = true;
    }
    if (strlen($password) == 0) {
        echo 'Bitte ein Passwort eingeben!';
        $error = true;
    }
    if ($password != $password2) {
        echo 'Die Passwörter müssen übereinstimmen!';
        $error = true;
    }

    //Nutzer schoin registriert?
    if (!$error) {
        $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p class='bg-danger text-white m-5 p-5 text-center'>Diese E-Mail-Adresse ist bereits vergeben!</p>";
            $error = true;
        }
    }

    //no errors -> register user
    if (!$error) {
        $stmt = $con->prepare("INSERT INTO user (username, email, first_name, last_name, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $firstname, $lastname, $hash);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute();
        $stmt->close();
        $con->close();
        $_SESSION['username'] = $username;
        //redirect to index.php
        header("Location: ../index.php");
    }
}

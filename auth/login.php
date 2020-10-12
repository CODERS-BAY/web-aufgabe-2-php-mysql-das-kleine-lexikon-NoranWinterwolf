<?php session_start();

require_once('../inc/login.inc.php'); ?>
<?php

/**
 * Anmeldung
 */
if (isset($_GET['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    //Benutzereingaben validieren
    if (!empty($username) && !empty($password)) {
        $query = $con->prepare("SELECT username, password FROM user WHERE username = ?");

        $query->bind_param("s", $username);
        $query->execute();
        $query->bind_result($username, $passwordDB);
        $query->store_result();


        if ($query->num_rows() == 1) {
            if ($query->fetch()) {
                if (password_verify($password, $passwordDB)) {

                    $_SESSION['username'] = $username;
                } else {
                    $_SESSION['login'] = false;
                }
                //redirect to index.php
                header("Location: ../index.php");
            }
        } else {
            $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie den Vorgang.';
        }
    } else {
        $error = "Bitte f&uuml;llen Sie alle Felder aus.";
    }
} else {
    $error = NULL;
    $username = NULL;
}
?>
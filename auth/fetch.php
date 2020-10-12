<?php
include('../inc/login.inc.php');
if (isset($_POST["entry_id"])) {

    $stmt = $con->prepare("SELECT DISTINCT * FROM content WHERE id = ? GROUP BY id");
    $stmt->bind_param('s', $id);
    $id = $_POST['entry_id'];
    $stmt->execute();
    $newData = $stmt->get_result()->fetch_assoc();
    echo json_encode($newData);
}

// switch (json_last_error()) {
//     case JSON_ERROR_NONE:
//         echo '- Keine Fehler';
//         break;
//     case JSON_ERROR_DEPTH:
//         echo ' - Maximale Stocktiefe überschritten';
//         break;
//     case JSON_ERROR_STATE_MISMATCH:
//         echo ' - Unterlauf oder Nichtübereinstimmung der Modi';
//         break;
//     case JSON_ERROR_CTRL_CHAR:
//         echo ' - Unerwartetes Steuerzeichen gefunden';
//         break;
//     case JSON_ERROR_SYNTAX:
//         echo ' - Syntaxfehler, ungültiges JSON';
//         break;
//     case JSON_ERROR_UTF8:
//         echo ' - Missgestaltete UTF-8 Zeichen, möglicherweise fehlerhaft kodiert';
//         break;
//     default:
//         echo '- Unbekannter Fehler';
// }

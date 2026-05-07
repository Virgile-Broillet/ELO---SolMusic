<?php

session_unset();      // vide les variables session
session_destroy();    // détruit la session

session_start();      // recrée une session vide

header("Location: index.php");
exit();

?>
<?php
    $_SESSION['USERNAME'] = NULL;
    @session_start();
    session_destroy();
    header("Location: portada.php?user=0&login=0");
?>

<?php   
    session_start();
    ob_start();
    session_destroy();
    header("Refresh:0");
    header("Location: ../index.php");
    ob_end_flush();

?>
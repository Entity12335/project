<?php
    session_start();
    session_unset();
    header('Location: ./main-site/główna.php');
?>
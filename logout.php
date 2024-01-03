<?php
    session_start();
    $_SESSION['zalogowany']=false;
    header('Location: ./main-site/główna.php');
?>
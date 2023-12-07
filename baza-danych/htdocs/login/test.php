<?php

session_start();

$_SESSION['err']=false;

require_once "connect.php";

$connection = @new mysqli($host,$db_user,$db_password,$db_name);

if ($connection->connect_errno!=0) {
        echo "Error: ".$connection->connect_errno . "Opis: ". $connection->connect_error;
}
else
{

    $login = $_POST['login'];
    $Password = $_POST['password'];
        
    $sql = "SELECT * FROM users WHERE Login='$login' AND Hasło='$Password'";
    if($rezultat = $connection->query($sql)){
        $ilu = $rezultat->num_rows;
        if($ilu>0){
            $_SESSION['zalogowany']=true;
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['Login'] = $wiersz['Login'];
            unset($_SESSION['blad']);
            $rezultat->free_result();


            header('Location: ../main-site/główna.php');
        }else{
            $_SESSION['blad']= '<span style="color:red">błędny Login albo Hasło</span>';
            $_SESSION['zalogowany']=false;
            header('Location: login.php');
        }
    }

    $connection->close();
}


?>
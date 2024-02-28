<?php

session_start();

$_SESSION['err']=false;

if((!isset($_POST['login']))||(!isset($_POST['password']))){
    header('Location: ./login.php');
    exit();
}

require_once "connect.php";

$connection = @new mysqli($host,$db_user,$db_password,$db_name);

if ($connection->connect_errno!=0) {
        echo "Error: ".$connection->connect_errno;
}
else
{

    $login = $_POST['login'];
    $Password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        
    if($rezultat = $connection->query(
    sprintf("SELECT * FROM users WHERE Login='%s'",
    mysqli_real_escape_string($connection,$login),))){

        $ilu = $rezultat->num_rows;
        if($ilu>0){
            $wiersz = $rezultat->fetch_assoc();
            if(password_verify($Password, $wiersz['Haslo'])){

                $_SESSION['zalogowany']=true;
        
                $_SESSION['Login'] = $wiersz['Login'];

                unset($_SESSION['blad']);
                $rezultat->free_result();


                header('Location: ../main-site/główna.php');
            }else{
                $_SESSION['blad']= '<span style="color:red">Błędny Login albo Hasło</span>';
                $_SESSION['zalogowany']=false;
                header('Location: login.php');
            }
        }else{
            $_SESSION['blad']= '<span style="color:red">Błędny Login albo Hasło</span>';
            $_SESSION['zalogowany']=false;
            header('Location: login.php');
        }
    }

    $connection->close();
}


?>
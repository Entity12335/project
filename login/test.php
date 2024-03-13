<?php

session_start();

$_SESSION['err']=false;

if((!isset($_POST['login']))||(!isset($_POST['password']))){
    header('Location: ./login.php');
    exit();
}

require_once "connect.php";

try{
    $connection = new PDO($dsn, $db_user, $db_password);
    $login = $_POST['login'];
    $Password = $_POST['password'];
        
    $rezultat = $connection->prepare('SELECT * FROM users WHERE `Login`=:login');
    $rezultat->bindParam(':login' , $login);
    $rezultat->execute();
        $ilu = $rezultat->rowCount();
        if($ilu>0){
            $rezultat->setFetchMode(PDO::FETCH_ASSOC);
            foreach($rezultat->fetchAll() as $kay => $val){
                if(password_verify($Password, $val['Haslo'])){

                    $_SESSION['zalogowany']=true;
            
                    $_SESSION['Login'] = $wiersz['Login'];

                    unset($_SESSION['blad']);
                    unset($rezultat);


                    header('Location: ../main-site/główna.php');
                }else{
                    $_SESSION['blad']= '<span style="color:red">Błędny Login albo Hasło</span>';
                    $_SESSION['zalogowany']=false;
                    header('Location: login.php');
                }
            }
        }else{
            $_SESSION['blad']= '<span style="color:red">Błędny Login albo Hasło</span>';
            $_SESSION['zalogowany']=false;
            header('Location: login.php');
        }

    unset($connection);
}catch(PDOException $e) {
    echo $e->getMessage();
}


?>
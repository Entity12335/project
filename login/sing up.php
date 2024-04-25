<?php
    session_start();
    
    require_once "connect.php";
    
    if((isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany']))){
        header('Location: ../main-site/główna.php');
        exit();
    }

    if(isset($_POST['email'])){
        //udana 
        $jest_ok=true;

        //login--------------------------------------------
        $login = $_POST['login'];
        //długość
        if((strlen($login)<5) || (strlen($login)>20)){
            $jest_ok=false;
            $_SESSION['e_login']="Login musi mieć 5-20 znaków";
        }
        //alfanumeryczne
        if(ctype_alnum($login)==false){
            $jest_ok=false;
            $_SESSION['e_login']="Login musi składać sie tylko z liter i cyfr (bez polskich znaków)";
        }
        //hasła--------------------------------------------
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        //długość
        if((strlen($password1)<8)||(strlen($password1)>20)){
            $jest_ok=false;
            $_SESSION['e_password1']="Hasło musi mieć 8-20 znaków";
        }
        if($password1!=$password2){
            $jest_ok=false;
            $_SESSION['e_password2']="Hasła nie są takie same";
        }

        $haslo_hasz = password_hash($password1,PASSWORD_DEFAULT);
        
        //regulamin----------------------------------------
        if(!isset($_POST['regulamin'])){
            $jest_ok=false;
            $_SESSION['e_regulamin']="regulamin nie zaakceptowany";
        }
        //email--------------------------------------------
        $email = $_POST['email'];
        $emailSave = filter_var($email, FILTER_SANITIZE_EMAIL);
        if((filter_var($emailSave,FILTER_VALIDATE_EMAIL)==false) || $emailSave!=$email){
            $jest_ok=false;
            $_SESSION['e_email'] = "nie poprawny email";
        }
        //captcha------------------------------------------

        $tajniak = "6LemdEwpAAAAAA8JTq6gFuSnCPRvV5RWteWtOnQc";

        if(null !==file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$tajniak.'&response='.$_POST['g-recaptcha-response'])){
        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$tajniak.'&response='.$_POST['g-recaptcha-response']);
        }else{
            $_SESSION['e_bot'] = "Potwierdź że nie jesteś botem";
        }

        $odp = json_decode($sprawdz);

        if($odp->success==false){
            if(!isset($_POST['regulamin'])){
                $jest_ok=false;
                $_SESSION['e_bot']="Potwierdź że nie jesteś botem";
            }
        }
        //powturzenia--------------------------------------


        try{
            $connection = new PDO($dsn, $db_user, $db_password);
                //email-----------------------
                $rezultat = $connection->prepare("SELECT ID FROM users WHERE `Email`=:email") ;
                $rezultat->bindParam(':email',$email);
                $rezultat->execute();
                $ile_emaili = $rezultat->rowCount();
                
                if ($ile_emaili>0){
                    $jest_ok=false;
                    $_SESSION['e_email']="Istnieje już konto na tym e-mailu";
                }
                //login-----------------------
                $rezultat = $connection->prepare("SELECT ID FROM users WHERE `Login`=:login") ;
                $rezultat->bindParam(':login',$login);
                $rezultat->execute();
                $ile_loginów = $rezultat->rowCount();
                
                if ($ile_loginów>0){
                    $jest_ok=false;
                    $_SESSION['e_login']="Istnieje już konto z takin Loginem";
                }

                //cezar--------------------------------------------
                if($jest_ok==true){
                    //jest git
                    $cezar = $connection->prepare("INSERT INTO `users` (`ID`, `Login`, `Haslo`, `Email`) VALUES (NULL, :login, :haslo_hasz, :email);");
                    $cezar->bindParam(':login',$login);
                    $cezar->bindParam(':haslo_hasz',$haslo_hasz);
                    $cezar->bindParam(':email',$email);
                    $cezar->execute();

                    $_SESSION['zalogowany']=true;
                    header('Location: ./login.php');
                    exit();

                    
                }
                unset($connection);
        }
        catch(PDOException $e){
            echo '<span class="error">Błąd servera</span>';
            echo '<br /> dev info: '.$e;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder</title>
    <link rel="stylesheet" href="./sign up.css">
    <script src="./sing up.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div>
        <header>
            <h1>
                <a href="../main-site/główna.php">Wiki smaków</a>
            </h1>
        </header>
        <div>
            <?php
                if(isset($_GET['Szukaj']) && $_GET['Szukaj']!=='')echo '<a href="./sing up.php" id=\'searchDell\'>X</a>';
            ?>
            <div id='Szukaj'>
                
                <form method="get" id='search' name="myForm" action="">

                    <input type="text" placeholder="Szukaj.." name="Szukaj">
                    <button type="submit" id="butt"><span class="icon-search"></span></button>

                </form>
                
                <div id='Szukane'>
                <?php

                    try{
                        $pdo = new PDO($dsn,$db_user,$db_password);
                    }catch(PDOException $e){
                        $e->getMessage();
                    }
                    try{               
                        $ilocs = 3;
                        $szukaj = $pdo->prepare('SELECT * FROM artykuly');
                        $szukaj->execute();
                        $szukaj->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($szukaj->fetchAll() as $_key => $_val){
                            if($ilocs>0){
                                if(isset($_GET['Szukaj'])&&$_GET['Szukaj']!=='' && str_contains($_val['Tytul'],$_GET['Szukaj'])){
                                    echo '<a href="../template przepisu/index.php?search='.$_val['Tytul'].'" class="Szukane">'.$_val['Tytul'].'</a>';
                                }
                                $ilocs=$ilocs-1;
                            }
                        }
                        // <a href="#" class="Szukane">Burger</a>
                        // <a href="#" class="Szukane">Burger</a>
                        // <a href="#" class="Szukane">Burger</a>
                
                    }catch(PDOException $e){
                        $e->getMessage();
                    }
                ?>
                </div>
            </div>
            <a href="../strona prepisu/index.php" class="anull"><i class="icon-plus"></i>new</a> <!-- link do tworzenia strony -->
            <div id="log">
                <button id="user"><i class="icon-down-open"></i>Opcje</button> 
                <div>
                <a href="login.php" class="anull">Login</a>
                <a href="sing up.php" class="anull">Sing up</a>
                </div>
            </div>
        </div>
    </div>
    <main>
        <aside id="left">
                <img src="../reklamy/loginPan.png">
        </aside>
        <article>
            <header>
                <h2>Zarejestruj Sie</h2>
            </header>
            <form method="post" action="">
                <input type="text" id="login" name="login" placeholder="Login" value="<?= (isset($_POST['login'])) ? $_POST['login'] : ""; ?>">
                <?php
                    if(isset($_SESSION['e_login'])){
                        echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                        unset($_SESSION['e_login']);
                    }
                ?>
                <input type="password" id="password1" name="password1" placeholder="Hasło">
                <?php
                    if(isset($_SESSION['e_password1'])){
                        echo '<div class="error">'.$_SESSION['e_password1'].'</div>';
                        unset($_SESSION['e_password1']);
                    }
                ?>
                <input type="password" id="password2" name="password2" placeholder="Powtórz Hasło">
                <?php
                    if(isset($_SESSION['e_password2'])){
                        echo '<div class="error">'.$_SESSION['e_password2'].'</div>';
                        unset($_SESSION['e_password2']);
                    }
                ?>
                <input type="email" id="email" name="email" placeholder="Email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : ""; ?>">
                <?php
                    if(isset($_SESSION['e_email'])){
                        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                        unset($_SESSION['e_email']);
                    }
                ?>
                <label>
                    <input type="checkbox" id="regulamin" name="regulamin">
                    <p>Regulamin</p>
                </label>
                    <?php
                    if(isset($_SESSION['e_regulamin'])){
                        echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                        unset($_SESSION['e_regulamin']);
                    }
                    ?>
                <div id="cp" class="g-recaptcha" data-sitekey="6LemdEwpAAAAADFzc66Wc0TlQjvlQnXm3CJdrlYW"></div>
                <?php
                    if(isset($_SESSION['e_bot'])){
                        echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                        unset($_SESSION['e_bot']);
                    }
                    ?>
                <div id="przy">
                    <input type="button" value="pokaż hasło" id="seepass">
                    <button type="submit" id="sub">Wyślji</button> 
                </div>
            </form>
            <div>
                <input type="button" value="Zaloguj Sie" id="loginlink"> 
            </div>
        </article>
        <aside id="right">
            <img src="../reklamy/loginPizza.png">
        </aside>
    </main>
    <footer>
        <div>
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif"><!-- placeholdery (kochamy pana Mirskiego) -->
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/552/421/72b.gif">
        </div>
    </footer>
</body>
</html>
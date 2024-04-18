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
                <a href="../main-site/główna.php">Nasza Strona ***** *** ( TAK)</a>
            </h1>
        </header>
        <div>
            <?php
                if(isset($_GET['Szukaj']) && $_GET['Szukaj']!=='')echo '<a href="./główna.php" id=\'searchDell\'>X</a>';
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
                <button id="user"><i class="icon-down-open"></i>placeholder</button> 
                <div>
                <a href="login.php" class="anull">Login</a>
                <a href="sing up.php" class="anull">Sing up</a>
                </div>
            </div>
        </div>
    </div>
    <main>
        <aside id="left">
                <img src="data:image/jpeg;base64,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">
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
            <img src="https://imagedelivery.net/9sCnq8t6WEGNay0RAQNdvQ/UUID-cl90h66k71432029tqyxmh6gqk7/public">
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
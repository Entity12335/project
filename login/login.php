<?php session_start(); 
    if((isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany']))){
    header('Location: ../main-site/główna.php');
    exit();
    }
    require_once "../login/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder</title>
    <link rel="stylesheet" href="./login.css">
    <script src="./login.js"></script>
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
                <button id="user"><i class="icon-down-open"></i>placeholder</button> <!-- nazwa użytkownika z bazy danych albo login/sineup -->
                <div>
                <a href="login.php" class="anull" id='L'>Login</a>
                <a href="sing up.php" class="anull" id='S'>Sing up</a>
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
                <h2>Zaloguj Się</h2>
            </header>
            <?php
            if(isset($_SESSION['blad'])) echo $_SESSION['blad']
            ?>
            <form action="./test.php" method="post">
                <input type="text" id="login" name="login" placeholder="Login">
                <input type="password" id="password" name="password"placeholder="Hasło">
                <div>
                    <input type="button" value="pokaż hasło" id="seepass">
                    <button type="submit">Wyślji</button> 
                </div>
            </form>
            <div>
                <input type="button" value="Stwórz konto"> 
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
<?php session_start(); 
require_once "../login/connect.php";
try {
    $pdo = new PDO($dsn, $db_user, $db_password);
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="głównacss.css">
    <script src="./głównajs.js"></script>
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
            <a href="../strona prepisu/index.php" class="anull"><span class="icon-plus"></span>new</a> <!-- link do tworzenia strony -->
            <div id="log">
                <button id="user"><span class="icon-down-open"></span>Opcje</button> <!-- nazwa użytkownika z bazy danych albo login/sineup -->
                <div>
                    <?php
                        if((isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany']))){
                            echo@'<a class=\'anull\' href="../logout.php">Wyloguj</a>';
                        }else{
                            echo '<a class=\'anull\' href="../login/login.php">Login</a><a class=\'anull\' href="../login/sing up.php">Sing up</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <main>
        <aside id="left">
            <ul>
                <li id="hasz">
                    <a href="#">########</a>
                </li>
                <li id="patreon"><a href="#">patreon</a></li>
                <li id="ad">
                    <?php
                        $rand = mt_rand(1,3);
                        switch ($rand) {
                            case 1:
                                echo '<img src="../reklamy/KuchVLOG.jpg">';
                                break;
                            case 2:
                                echo '<img src="../reklamy/Piekarnia.jpg">';
                                break;
                            case 3:
                                echo '<img src="../reklamy/pOkolicy.jpg">';
                            break;
                        }
                    ?></li>
            </ul>
        </aside>
        <article>
            <section>
                <img id="rick" src="https://media.tenor.com/x8v1oNUOmg4AAAAd/rickroll-roll.gif">
            </section>
        </article>
        <aside id="right">
                <p>Lorem, ipsum dolor.</p>
                <p>Autem, tenetur modi?</p>
                <p>Pariatur, corrupti ipsam?</p>
                <p>Fuga, dolorum iusto.</p>
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
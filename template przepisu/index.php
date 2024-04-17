<?php
    session_start();

    require_once "../login/connect.php";


    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">

</head> 
<body>
    <div>
    <header>
            <h1>
                <a id='head' href="../main-site/główna.php">Nasza Strona ***** *** ( TAK)</a>
            </h1>
        </header>
        <div>
        <?php
                if(isset($_GET['Szukaj']) && $_GET['Szukaj']!=='')echo '<a href="./główna.php" id=\'searchDell\'>X</a>';
            ?>
            <div id='Szukaj'>
            <form method="get" name="myForm" id="search" action="">
                <input type="text" name="search" value="<?php echo $_GET['search'] ?>" hidden>
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
            <a href="../strona prepisu/index.php" class="anull"><span class="icon-plus"></span>new</a><!-- link do tworzenia strony -->
            <div id="log">
                <button id="user"><span class="icon-down-open"></span>placeholder</button> <!-- nazwa użytkownika z bazy danych albo login/sineup -->
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
        <aside id="leftAside">
            <ul>
                <li id="hasz">
                    <a href="#">########</a>
                </li>
                <li id="patreon"><a href="#">patreon</a></li>
                <!-- <img src="./giphy.gif" img here alt="ad"> -->
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
        <?php
            try{
            $find = $pdo->prepare('SELECT * FROM artykuly WHERE Tytul = :tytul');
            $find->bindParam(':tytul', $_GET['search']);
            $find->execute();
            $find->setFetchMode(PDO::FETCH_ASSOC);
            foreach($find->fetchAll() as $kay => $val){
                ?>
            <article>
                
                <div id="formName" class="textarea"><h2><?php echo $val['Tytul']; ?></h2></div>
                
                <div id="formOpis" class="textarea"><h3>Opis</h3><?php echo $val['Opis']; ?></div>
                
                <div id="leftRight" class="textarea">
                    <ul class="left"><h3>Składniki</h3><?php foreach(explode("&",$val['Skladniki']) as $_k => $_v){ echo '<li>'.$_v."</li>"; }?></ul> 
                    <div class="right"><?php if(isset($val['Img'])){echo '<img id="output" src="data:image/jpeg;base64,'.base64_encode($val['Img']).'"/>'; }?></div>
                </div>
                        
                <div id="formPrzepis" class="textarea"><h3>Przepis</h3><?php echo $val['Przepis'] ?></div>                                
                        
            </article>
            <?php  }}catch(PDOException $e){ $e->getMessage(); } ?>
    </main>
    <footer>
        &copy;sfsvhgfytug
    </footer>
</body>
</html>
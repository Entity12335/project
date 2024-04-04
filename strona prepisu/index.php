<?php
    session_start();

    require_once "../login/connect.php";

    if(($_SESSION['zalogowany']!=true)){
        header('Location: ../login/login.php');
        exit();
    }

    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    if(isset($_POST['submit'])){
        $Tytul = $_POST['nazwa'];
        $Opis = $_POST['opis'];
        $Skladniki = implode('&',$_POST['składnik']);
        $Img = $_POST['Img'];
        $Przepis = $_POST['Przepis'];
        try{
            $jest_ok = true;
            $try = $pdo->prepare("SELECT IDart FROM artykuly WHERE `Tytul`=:Tytul");
            $try->bindParam(':Tytul',$Tytul);
            $try->execute();


            $ile_tytulow = $try->rowCount();

            if ($ile_tytulow>0){
                $jest_ok=false;
                $_SESSION['e_tytul']="Istnieje już przepis na tą potrawe";
            }

            if($jest_ok){
                $cezar = $pdo->prepare("INSERT INTO artykuly (`IDart`, `Tytul`, `Opis`, `Skladniki`, `Img`, `Przepis`) VALUES (NULL, :Tytul, :Opis, :Skladniki, :Img, :Przepis);");
                $cezar->bindParam(':Tytul',$Tytul);
                $cezar->bindParam(':Opis',$Opis);
                $cezar->bindParam(':Skladniki',$Skladniki);
                $cezar->bindParam(':Img',$Img);
                $cezar->bindParam(':Przepis',$Przepis);
                $cezar->execute();

                header('Location: ../main-site/główna.php');
                    exit();
            }
        }   catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
<!-- wyszukiwarka -->
    <script src="./script.js"></script>
<!-- dodawanie do listy i prewiue image -->
    <script src="./lista_image.js"></script>
<!-- resizing -->
    <script src="./resize.js"></script>
</head> 
<body>
    <div>
        <header>
            <h1>tytuł strony</h1>
        </header>
        <div>
            <form name="myForm" id="search" >
                <input type="text" placeholder="Szukaj.." name="Szukaj">
                <button type="submit" id="butt"><span class="icon-search"></span></button>
            </form>
            <label for="submit-form" tabindex="0"><span class="icon-plus"></span>Wyśli</label><!-- link do tworzenia strony -->
            <div id="log">
                <button id="user"><span class="icon-down-open"></span>placeholder</button> <!-- nazwa użytkownika z bazy danych albo login/sineup -->
                <div>
                <a href="../login/login.html">Login</a>
                <a href="../login/sing up.html">Sing up</a>
                </div>
            </div>
            <a href="../main-site/główna.php"><span class="icon-left-big"></span>return</a>
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
        <article>
            <form action="./index.php" method="post" id="myForms" name="wszystko">

                            <textarea id="formName" placeholder="Nazwa potrawy" name="nazwa" rows="1" required><?= (isset($_POST['nazwa'])) ? $_POST['nazwa'] : ""; ?></textarea>
                            <?php if(isset($_SESSION['e_tytul'])){
                                    echo '<div class="error">'.$_SESSION['e_tytul'].'</div>';
                                    unset($_SESSION['e_tytul']);
                                }?>
                
                        
                            <textarea id="formHasz" placeholder="hasze" name="hasz" rows="1" required><?= (isset($_POST['hasz'])) ? $_POST['hasz'] : ""; ?></textarea>
                            
                 

                            <textarea id="formOpis" placeholder="opis" name="opis" rows="1" required><?= (isset($_POST['opis'])) ? $_POST['opis'] : ""; ?></textarea>
                            
                            
            
                    <div id="leftRight">
                        <div class="left">
                                <input type="button" value="nowy składnik" id="przycisk">
                                <template id="liTemp"><li><input type="text" placeholder="składniki" name="składnik[]"  required><input type="button"class="remove-btn" value="ususń składnik"></li></template>
                                <ul id="ul"><li><input type="text" placeholder="składniki" name="składnik[]"  required><input type="button" class="remove-btn" value="ususń składnik"></li></ul>
                        </div> 
                        <div class="right">
                            <input name="Img" type="file" accept="image/*" onchange="loadFile(event)" required>
                            <img id="output">
                        </div>
                    </div>

                        <textarea id="formPrzepis"placeholder="Przepis" name="Przepis" rows="1"required><?= (isset($_POST['Przepis'])) ? $_POST['Przepis'] : ""; ?></textarea>
                        <input type="submit" name="submit" id="submit-form" hidden >
         
            </form>

        </article>
        <aside id="rightAside">
                <p>Lorem, ipsum dolor.</p>
                <p>Autem, tenetur modi?</p>
                <p>Pariatur, corrupti ipsam?</p>
                <p>Fuga, dolorum iusto.</p>
        </aside>
    </main>
    <footer>
        &copy;sfsvhgfytug
    </footer>
</body>
</html>
<?php session_start(); ?>

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
                <a href="../main-site/główna.php">Nasza Strona ***** *** ( TAK)</a>
            </h1>
        </header>
        <div>
            <form name="myForm" id="search" >
                <input type="text" placeholder="Szukaj.." name="Szukaj">
                <button type="submit" id="butt"><i class="icon-search"></i></button>
            </form>
            <a href="#"><i class="icon-plus"></i>new</a> <!-- link do tworzenia strony -->
            <div id="log">
                <button id="user"><i class="icon-down-open"></i>placeholder</button> <!-- nazwa użytkownika z bazy danych albo login/sineup -->
                <div>
                    <?php
                        if((isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany']))){
                            echo@'<a href="../logout.php">Wyloguj</a>';
                        }else{
                            echo '<a href="../login/login.php">Login</a><a href="../login/sing up.php">Sing up</a>';
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
                <li id="ad"><img src="./giphy.gif" img here alt="ad"></li>
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
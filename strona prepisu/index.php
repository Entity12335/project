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
                <button type="submit" id="butt"><i class="icon-search"></i></button>
            </form>
            <label for="submit-form" tabindex="0"><i class="icon-plus"></i>Wyśli</label><!-- link do tworzenia strony -->
            <div id="log">
                <button id="user"><i class="icon-down-open"></i>placeholder</button> <!-- nazwa użytkownika z bazy danych albo login/sineup -->
                <div>
                <a href="../login/login.html">Login</a>
                <a href="../login/sing up.html">Sing up</a>
                </div>
            </div>
            <a href="../main-site/główna.php"><i class="icon-left-big"></i>return</a>
        </div>
    </div>
    <main>
        <aside id="leftAside">
            <ul>
                <li id="hasz">
                    <a href="#">########</a>
                </li>
                <li id="patreon"><a href="#">patreon</a></li>
                <li id="ad"><img src="./giphy.gif" img here alt="ad"></li>
            </ul>
        </aside>
        <article>
            <form action="#" method="post" id="myForms" name="wszystko">

                            <textarea id="formName" placeholder="Nazwa potrawy" name="nazwa" rows="1" required></textarea>

                
                        
                            <textarea id="formHasz" placeholder="hasze" name="hasz" rows="1" required></textarea>
                            
                 

                            <textarea id="formOpis" placeholder="opis" name="opis" rows="1" required></textarea>
                            
                            
            
                    <div id="leftRight">
                        <div class="left">
                                <input type="button" value="nowy składnik" id="przycisk">
                                <template id="liTemp"><li><input type="text" placeholder="składniki" name="składnik"  required><input type="button"class="remove-btn" value="ususń składnik"></li></template>
                                <ul id="ul"><li><input type="text" placeholder="składniki" name="składnik"  required><input type="button" class="remove-btn" value="ususń składnik"></li></ul>
                        </div> 
                        <div class="right">
                            <input name="formImage" type="file" accept="image/*" onchange="loadFile(event)">
                            <img id="output">
                        </div>
                    </div>

                        <textarea id="formPrzepis"placeholder="Przepis" name="Przepis" rows="1"required></textarea>
                        <input type="submit" id="submit-form" hidden >
         
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
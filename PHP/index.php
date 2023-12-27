<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script type="text/javascript" src="../js/ajax.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <title>Pizzeria</title>
</head>

<body>
    <div id="content">
        <div class="main">
            <header>
                <h1>Pizzeria Lorem Ipsum</h1>
            </header>
            <nav>
                <a class="menu active" href="#" onClick="callReload('index.php', 'content', 'Trwa ładowanie strony...')">Strona główna</a>
                <a class="menu" href="#menu" onClick="callReload('menu.php', 'content', 'Trwa ładowanie strony...')" >Menu</a>
                <a class="menu" href="#kontakt" onClick="callReload('contact.php', 'content', 'Trwa ładowanie strony...')">Kontakt</a>
                <a class="menu" href="#zamowienia" onClick="callReload('orderSelect.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
                <?php
                session_start();
                if(isset($_SESSION['login']) && $_SESSION['login'] === true)
                {
                ?>
                    <a class='menu' href='#admin' onClick="callReload('admin.php', 'content', 'Trwa ładowanie strony...')" >ADMIN</a>
                <?php
                }
                ?>
            </nav>
            <div class = "opis">
                <img class = "rest" src="../assets/restauracja.jpg">
                <h3>Lorem Ipsum</h3>
                <?php
                if(isset($_SESSION['login']) && $_SESSION['login'] === true)
                {
                ?>
                <a href = '#' onClick = "Logout()"><img src='line.png'/></a>
                <?php
                }
                else
                {
                ?>
                <a href = "#" onClick="callReload('login.php', 'content', 'Trwa ładowanie strony...')"><img src='line.png'/></a>
                <?php
                }
                ?>
                <div class = "text">         
                    <p class="opis_rest">
                        Od lat tworzymy włoskie smaki w sercu Krapkowic. 
                        Znajdziecie Państwo u nas prawdziwe włoskie smaki
                        Wychodząc naprzeciw oczekiwaniom zapewniamy również dostawę do domu.
                    </p>
                    <p class="opis_rest">
                        Nasza kuchnia charakteryzuje się daniami wysokiej jakości. 
                        Wiemy co cenią sobie klienci, 
                        dlatego pracujemy na wyselekcjonowanych i certyfikowanych produktach, 
                        które pozwalają nam tworzyć prawdziwą jakość dań.
                    </p>
                    <p class="opis_rest">    
                        Bazując na wieloletnim doświadczeniu jesteśmy w stanie codziennie dostarczać nową,
                        lepszą jakość. Nasza pizzeria mieści się tuż przy rynku Krapkowic.
                    </p>
                    <br/>
                    <h4>Życzymy smacznego</h4>
                </div>
            </div>
            <footer>
                <h6>
                Strona restauracji jest wykonana na potrzeby projektu i nie ma na celu czerpania korzyści majątkowych. <br />
                Wszelkiego rodzaju towary mogące się na niej pojawić są fikcyjne. <br />
                </h6>
            </footer>
        </div>
    </div>
</body>
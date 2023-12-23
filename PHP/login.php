<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" />
    <title>Pizzeria</title>
</head>

<body>
    <div class="main">
        <header>
            <h1>Pizzeria Lorem Ipsum</h1>
        </header>
        <nav>
        <a class="menu" href="#" onClick="callReload('index.php', 'content', 'Trwa ładowanie strony...')">Strona główna</a>
            <a class="menu" href="#menu" onClick="callReload('menu.php', 'content', 'Trwa ładowanie strony...')">Menu</a>
            <a class="menu" href="#kontakt" onClick="callReload('kontakt.php', 'content', 'Trwa ładowanie strony...')">Kontakt</a>
            <a class="menu" href="#zamowienia" onClick="callReload('order.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
        </nav>
        <br/>
            <form>
                <div class = "logowanie">
                    <div class="item-login">
                    <h2>Dane logowania</h2>
                    <input class="login" type="text" name="login" id="logowanie" placeholder="Login" autocomplete="off" required="" /></br>
                    <input class="login" type="text" name="haslo" id="logowanie" placeholder="Hasło" autocomplete="off" required="" /></br>
                    <input class="button-big" type="button" onclick ="Login(login.value,haslo.value)" value="Zaloguj"/>
                    <input class="button-big" type="reset">
                    </div>
                </div>
            </form>
            <div id="error" class="error"></div>
        <footer>
            <h6>
            Strona restauracji jest wykonana na potrzeby projektu i nie ma na celu czerpania korzyści majątkowych. <br />
            Wszelkiego rodzaju towary mogące się na niej pojawić są fikcyjne. <br />
            </h6>
        </footer>
    </div>
</body>
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
            <a class="menu active" href="#kontakt" onClick="callReload('contact.php', 'content', 'Trwa ładowanie strony...')">Kontakt</a>
            <a class="menu" href="#zamowienia" onClick="callReload('order.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
        </nav>
        <br/>
            
            <div class = "kontakt">
                <div class="kontakt_child">
                    <p class="kontakt_pog">
                    Adres <br/>
                    </p>
                    <article>
                    Restauracja Lorem Ipsum <br/>
                    ul.Opolska 21 <br/>
                    Krapkowice
                    </article>
                    </p>
                    <p class="kontakt_pog">
                    Kontakt <br/>
                    </p>
                    <article>
                    +48 762 541 221 <br/>
                    <a class="mail_link" href="mailto:loremipsum@gmail.com">loremipsum@gmail.com</a> 
                    </article>
                    <p class="kontakt_pog">
                    Godziny otwarcia <br/>
                    </p>
                    <article>
                    Poniedziałek - Sobota: 11:00 - 22:00 <br/>
                    Niedziele i święta: 12:00 - 22:00
                    </article>
                    <br/>
                </div>
            </div>
        <footer>
            <h6>
            Strona restauracji jest wykonana na potrzeby projektu i nie ma na celu czerpania korzyści majątkowych. <br />
            Wszelkiego rodzaju towary mogące się na niej pojawić są fikcyjne. <br />
            </h6>
        </footer>
    </div>
</body>
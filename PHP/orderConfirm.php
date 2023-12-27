<!DOCTYPE html>

<?php
session_start();

if(!isset($_SESSION['cart']))
{
    header("Location: index.php");
}

?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <a class="menu" href="#kontakt" onClick="callReload('contact.php', 'content', 'Trwa ładowanie strony...')">Kontakt</a>
            <a class="menu active" href="#zamowienia" onClick="callReload('order.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
        </nav>
        <br/>    
            <div class="cart-container">
                <input class="button" type="button" onclick="callReload('orderSelect.php', 'content', 'Trwa ładowanie strony...')" value="Powrót"/>
                <h3>ZAMOWIENIE</h3>
                <input class="button" type="button" onclick="callReload('order.php', 'content', 'Trwa ładowanie strony...')" value="Dalej"/>
            </div>       
            <div class="sum">
                <?php
                    $sum = 0;
                    foreach($_SESSION["cart"] as $index => $pizza)
                    {
                        $sum += $pizza["price"];
                    }
                    echo "Suma za zamówienie: ${sum} zł";
                ?>
            </div>     
            <div class="zamowienie"> 
                <?php
                   foreach($_SESSION["cart"] as $index => $pizza){
                    echo"<div class='item'>
                            <div class='card'>
                                <img src='../assets/pizzaImg/${pizza['name']}.jpg' alt='tak'>
                                <h2>${pizza['name']}</h2>
                                <div class='data-container'>
                                    <div class='data-confirm'>
                                        <label>Ilość:</label>
                                        <p class='data-amount'>${pizza['quantity']}</p>
                                    </div>
                                    <div class='data-confirm'>
                                        <label>Rozmiar:</label>
                                        <p class='data-amount'>${pizza['size']}cm</p>
                                    </div>
                                </div>
                                <div class='data-confirm-price'>
                                    <label>Cena:</label>
                                    <p class='data-amount'>${pizza['price']}zł</p>
                                </div>
                                <div class='radio-container'>
                                </div>
                                <input class='btn' type='button' 
                                    onclick ='RemoveFromCart(${pizza['id']}, ${pizza['size']})' value='Usuń'/>  
                            </div>  
                        </div>";
                   }
                ?>     
            </div>    
        <footer>
            <h6>
            Strona restauracji jest wykonana na potrzeby projektu i nie ma na celu czerpania korzyści majątkowych. <br />
            Wszelkiego rodzaju towary mogące się na niej pojawić są fikcyjne. <br />
            </h6>
        </footer>
    </div>
</body>
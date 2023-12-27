<!DOCTYPE html>

<?php
session_start();

if(!isset($_SESSION['cart']))
{
    header("Location: index.php");
}

@$conn= new mysqli('localhost','root','','pizzeria');
if($conn->connect_errno){
    die($conn->connect_error);
}

$queryMenu="SELECT id, name FROM menu";
$resultMenu=$conn->query($queryMenu);

$queryCity="SELECT name FROM cities";
$resultCity=$conn->query($queryCity);
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
                <input class="button" type="button" onclick="callReload('orderConfirm.php', 'content', 'Trwa ładowanie strony...')" value="Powrót"/>
                <h3>DANE DOSTAWY</h3>
                <p></p>
            </div>     
            <form name="orderForm" id="orderForm">
                <div class="personal-data">
                    <div class="item">
                        <h2>Dane personalne</h2>
                        <input class="zamowienie" type="text" name="name"  placeholder="Imie" /></br>
                        <input class="zamowienie" type="text" name="surname"  placeholder="Nazwisko"/></br>
                        <input class="zamowienie" type="tel" name="phoneNumber"  placeholder="Telefon: 123-456-789" /></br>
                        <br/>
                    </div>

                    <div class="item">
                        <h2>Dane zamieszkania</h2>

                        <select id="miasto" name="city">
                        <?php
                            while($rowCity=$resultCity->fetch_assoc())
                            {
                                echo "<option value=${rowCity['name']}> ${rowCity['name']} </option>"; 
                            }
                        ?>
                        </select></br>

                        <input class="zamowienie" type="text" name="street" placeholder="Ulica" /></br>
                        <input class="zamowienie" type="number" name="buildingNumber"  placeholder="Numer budynku" /></br>
                        <input class="zamowienie" type="number" name="apartmentNumber" placeholder="Numer mieszkania"/></br>
                        </br>
                    </div>            
                </div>
                <div>
                    <input class="button-big" type="button"id="zatwierdz" onclick ="Validate(orderForm)" value="Zamow"/>
                </div>
                <div class="error" id="error"></div>
            </form>
             <br/>
        <footer>
            <h6>
            Strona restauracji jest wykonana na potrzeby projektu i nie ma na celu czerpania korzyści majątkowych. <br />
            Wszelkiego rodzaju towary mogące się na niej pojawić są fikcyjne. <br />
            </h6>
        </footer>
    </div>
</body>

<?php
    mysqli_close($conn);
?>
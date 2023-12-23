<!DOCTYPE html>

<?php
@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}

$queryMenu="SELECT id, nazwa FROM menu";
$resultMenu=$conn->query($queryMenu);

$queryCity="SELECT nazwa FROM miasta";
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
            
            <form name="form_zam" id = "form_zam">
                <div class="zamowienie">
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
                                echo "<option value=${rowCity['nazwa']}> ${rowCity['nazwa']} </option>"; 
                            }
                        ?>
                        </select></br>

                        <input class="zamowienie" type="text" name="street" placeholder="Ulica" /></br>
                        <input class="zamowienie" type="number" name="buildingNumber"  placeholder="Numer budynku" /></br>
                        <input class="zamowienie" type="number" name="apartmentNumber" placeholder="Numer mieszkania"/></br>
                        </br>
                    </div>
                    
                    <div class="item">
                        <h2>Dane zamowienia</h2>
                        <select class="zamowienie" name="pizzaId" onchange="CountPrice(this.value, quantity.value, size.value)">
                        <?php
                            while($rowMenu=$resultMenu->fetch_assoc())
                            {
                                echo "<option value=${rowMenu['id']}> ${rowMenu['nazwa']} </option>"; 
                            }
                        ?>
                        </select>
                        </br>
                        <input class = "zamowienie" type="number" name="quantity" onchange="CountPrice(pizzaId.value, this.value, size.value)"
                        placeholder="Ilość"/></br>
                        <input class="radio" type="radio" name="size" onchange="CountPrice(pizzaId.value, quantity.value, this.value)"
                        value = 30 checked = "checked">30 cm</input>
                        <input class ="radio" type="radio" name="size" onchange="CountPrice(pizzaId.value, quantity.value, this.value)"
                        value = 40>40 cm</input></br>

                        <div class="Cena" id="Cena">Cena: 0 zł</div>
                        
                        </br>
                        <input class="button" type="button"id="zatwierdz" onclick ="Validate(form_zam)" value="Zamow"/>
                        <input class="button" type="reset">
                    </div>
                    <div class="form-message" id = "message"></div>
                </div>
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
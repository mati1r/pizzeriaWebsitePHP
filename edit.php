<!DOCTYPE html>

<?php

session_start();
if ($_SESSION['login'] != true)
{
    header('Location: index.php');
}

@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}

$queryMenu="SELECT id, nazwa FROM menu";
$resultMenu=$conn->query($queryMenu);

$id = intval($_GET['id']) ?? null;

$queryData="SELECT zamowienia.id, Imie, Nazwisko, Telefon, id_pizzy, ilosc, rozmiar, cena_40 FROM zamowienia JOIN klient
ON (zamowienia.id_klienta = klient.id) JOIN menu ON (zamowienia.id_pizzy = menu.id) WHERE zamowienia.id = $id;";

$resultData=$conn->query($queryData);
$row=$resultData->fetch_assoc();

$selected = $row['rozmiar'];
$pizzaId = $row['id_pizzy'];
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
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
            <a class="menu " href="#zamowienia" onClick="callReload('order.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
            <a class="menu active" href="#admin" onClick="callReload('admin.php', 'content', 'Trwa ładowanie strony...')">ADMIN</a>
        </nav>
        <br/> 
            <form>
                <div class="edit">   
                    <div class="item-edit">
                        <h2>Dane klienta</h2>
                        <input class="edit" type="text" name="Name" value="<?= $row['Imie']?>"/></br>
                        <input class="edit" type="text" name="Surname"  value="<?= $row['Nazwisko']?>"/></br>
                        <input class="edit" type="tel" name="PhoneNumber"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" value="<?= $row['Telefon']?>"/>
                        </br>
                    </div>
                    
                    <div class="item-edit">
                        <h2>Dane zamowienia</h2>

                        <select class="edit" name="PizzaId">
                        <?php
                            while($rowMenu=$resultMenu->fetch_assoc())
                            {
                                if($rowMenu['id'] == $pizzaId)
                                {
                                    echo "<option value=${rowMenu['id']} selected> ${rowMenu['nazwa']} </option>"; 
                                }
                                else
                                {
                                    echo "<option value=${rowMenu['id']}> ${rowMenu['nazwa']} </option>"; 
                                }
                            }
                        ?>
                        </select>

                        <input class="edit" type="number" name="Quantity" value="<?= $row['ilosc']?>" min = "1" max = "99"/></br>
                        <select class="edit" name="Size">
                                    <option <?php if($selected == '30'){echo("selected");}?> value=30>30</option>
                                    <option <?php if($selected == '40'){echo("selected");}?> value=40>40</option>
                        </select></br>
                        <input class="button" type="button" 
                        onclick="Edit(Name.value, Surname.value, PhoneNumber.value, PizzaId.value, Quantity.value, Size.value,'<?=$id?>')" value="Zatwierdz"/>
                        <input class="button" type="button" onClick="callReload('admin.php', 'content', 'Trwa ładowanie strony...')" value="Powrot" />
                    </div>
                </div>
            </form>  
        <div id="Error"></div>
            <footer>
                <h6>
                Strona restauracji jest wykonana na potrzeby projektu i nie ma na celu czerpania korzyści majątkowych. <br />
                Wszelkiego rodzaju towary mogące się na niej pojawić są fikcyjne. <br />
                </h6>
            </footer>
        </div>
    </div>
</div>
</body>

<?php
    mysqli_close($conn);
?>
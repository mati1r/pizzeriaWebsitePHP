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

$menu="SELECT zamowienia.id, Imie, Nazwisko, Telefon, nazwa, ilosc, rozmiar, cena_40, cena_30 FROM zamowienia JOIN klient
 ON (zamowienia.id_klienta = klient.id) JOIN menu ON (zamowienia.id_pizzy = menu.id);";
$result=$conn->query($menu);

?>

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
            <a class="menu" href="#kontakt" onClick="callReload('contact.php', 'content', 'Trwa ładowanie strony...')">Kontakt</a>
            <a class="menu " href="#zamowienia" onClick="callReload('order.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
            <a class="menu active" href="#admin" onClick="callReload('admin.php', 'content', 'Trwa ładowanie strony...')">ADMIN</a>
        </nav>
        <br/>
            
            <table class="menu">
                <tr>
                    <td class = "admin"> <b> Id zamowienia </b> </td>
                    <td class = "admin"> <b> Imie </b> </td>
                    <td class = "admin"> <b> Nazwisko </b> </td>
                    <td class = "admin"> <b> Telefon </b> </td>
                    <td class = "admin"> <b> Nazwa pizzy </b> </td>
                    <td class = "admin"> <b> Ilosc </b> </td>
                    <td class = "admin"> <b> Rozmiar </b> </td>
                    <td class = "admin"> <b> Cena </b> </td>
                    <td class = "admin"> <b> Opcje </b> </td>
                </tr>   
        <?php
            while($row=$result->fetch_assoc())
            {
                if($row['rozmiar'] == 30)
                {
                    $price = $row['ilosc'] * $row['cena_30'];
                }
                else
                {
                    $price = $row['ilosc'] * $row['cena_40'];
                }

                echo "<tr>";
                echo "<td class = 'admin' name='iD'>${row['id']}</td>";
                echo "<td class = 'admin'>${row['Imie']}</td>";
                echo "<td class = 'admin'>${row['Nazwisko']}</td>";
                echo "<td class = 'admin'>${row['Telefon']}</td>";
                echo "<td class = 'admin'>${row['nazwa']}</td>";
                echo "<td class = 'admin'>${row['ilosc']}</td>";
                echo "<td class = 'admin'>${row['rozmiar']} cm</td>";
                echo "<td class = 'admin'>CENA:$price zł</td>";
                $Id = intval($row['id']);
                ?>
                
                <td class = 'admin'>

                <button onClick = "RedirectToEdit('<?=$Id?>','content', 'Trwa ładowanie strony...')">Edytuj</button>
                <button onClick = "Delete('<?=$Id?>')" >Usuń</button> </td>   

                <?php 
                echo "</tr>";
            }
        ?>
            </table>
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
<!DOCTYPE html>

<?php

session_start();
if ($_SESSION['login'] != true)
{
    header('Location: index.php');
}

@$conn= new mysqli('localhost','root','','pizzeria');

if($conn->connect_errno){
    die($conn->connect_error);
}

$menu="SELECT orders.id, name, surname, phone_number, total_price FROM orders JOIN client
 ON (orders.client_id = client.id);";
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
                    <td class = "admin"> <b> Cena </b> </td>
                    <td class = "admin"> <b> Opcje </b> </td>
                </tr>   
        <?php
            while($row=$result->fetch_assoc())
            {
                $price = 0;
                echo "<tr>";
                echo "<td class = 'admin' name='iD'>${row['id']}</td>";
                echo "<td class = 'admin'>${row['name']}</td>";
                echo "<td class = 'admin'>${row['surname']}</td>";
                echo "<td class = 'admin'>${row['phone_number']}</td>";
                echo "<td class = 'admin'>${row['total_price']} zł</td>";
                $id = intval($row['id']);
                ?>
                
                <td class = 'admin'>

                <button onClick = "RedirectToEdit('<?=$id?>','content', 'Trwa ładowanie strony...')">Edytuj</button>
                <button onClick = "Delete('<?=$id?>')" >Usuń</button> </td>   

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
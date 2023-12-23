<!DOCTYPE html>

<?php
@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}
$query="SELECT id, nazwa, skladniki, cena_30, cena_40 FROM menu";
$result=$conn->query($query);
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
            <a class="menu active" href="#menu" onClick="callReload('menu.php', 'content', 'Trwa ładowanie strony...')">Menu</a>
            <a class="menu" href="#kontakt" onClick="callReload('contact.php', 'content', 'Trwa ładowanie strony...')">Kontakt</a>
            <a class="menu" href="#zamowienia" onClick="callReload('order.php', 'content', 'Trwa ładowanie strony...')">Zamowienie</a>
        </nav>
        <br/>
            <table class="menu">
                <tr>
                    <td class="menu_nazwa"><b> Nazwa </b></td>
                    <td class="menu_cena"><b> 30 cm </b></td>
                    <td class="menu_cena"><b> 40 cm </b></td>
                </tr>   
        <?php
            while($row=$result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td class = 'menu_nazwa'><b> ${row['id']}. ${row['nazwa']} </b> 
                <br/> ${row['skladniki']}</td>";
                echo "<td class = 'menu_cena'>${row['cena_30']} zł</td>";
                echo "<td class = 'menu_cena'>${row['cena_40']} zł</td>";
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
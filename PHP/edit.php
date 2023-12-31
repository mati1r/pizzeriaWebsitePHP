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

$queryMenu="SELECT id, name FROM menu";
$resultMenu=$conn->query($queryMenu);

$id = intval($_GET['id']) ?? null;

$queryPersonData="SELECT name, surname, phone_number FROM orders JOIN client
ON (orders.client_id = client.id) WHERE orders.id = $id;";

$resultPersonData=$conn->query($queryPersonData);
$rowPersonData=$resultPersonData->fetch_assoc();

$orderData="SELECT orders.id, menu.id as menu_id, menu.name, menu_orders.quantity, menu_orders.size FROM orders 
            JOIN menu_orders ON (orders.id = menu_orders.orders_id) 
            JOIN menu ON (menu_orders.menu_id = menu.id) WHERE orders.id = $id;"; 

$resultOrderData=$conn->query($orderData);

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
        <div class="edit-container">
        <input class="button" type="button" 
                onClick="callReload('admin.php', 'content', 'Trwa ładowanie strony...')" 
                value="Powrot" />
                
        <div id="error" class="error"></div>

        <input class="button" type="button" 
                onclick="Edit(document.getElementsByName('name')[0].value, 
                            document.getElementsByName('surname')[0].value, 
                            document.getElementsByName('phoneNumber')[0].value,
                            '<?=$id?>')" 
                value="Zatwierdz"/>
        </div>
            <div class="edit">   
                <div class="item-edit">
                    <h2>Dane klienta</h2>
                    <input class="edit" type="text" name="name" placeholder="Imie" 
                            value="<?= $rowPersonData['name']?>"/></br>
                    <input class="edit" type="text" name="surname" placeholder="Nazwisko"  
                            value="<?= $rowPersonData['surname']?>"/></br>
                    <input class="edit" type="tel" name="phoneNumber" placeholder="Telefon: 123-456-789"  
                            pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" value="<?= $rowPersonData['phone_number']?>"/>
                    </br>
                </div>
                    <?php
                        while($rowOrderData=$resultOrderData->fetch_assoc())
                        {
                        echo "<div class='item-edit'>
                        <h2>Dane zamowienia</h2>
                        <p name='oldPizzaId' data-oldPizzaId=${rowOrderData['menu_id']}></p>";
                        $select = $rowOrderData['size'];
                        echo "<select class='edit' name='pizzaId'>";
                                $resultMenu->data_seek(0);
                                while($rowMenu=$resultMenu->fetch_assoc()){
                                    if($rowMenu['id'] == $rowOrderData['menu_id'])
                                    {
                                        echo "<option value=${rowMenu['id']} selected> ${rowMenu['name']} </option>"; 
                                    }
                                    else
                                    {
                                        echo "<option value=${rowMenu['id']}> ${rowMenu['name']} </option>"; 
                                    }
                                }
                            echo "</select>

                            <input class='edit' type='number' name='quantity' placeholder='Ilość' value='${rowOrderData['quantity']}' min = '1' max = '99'/></br>
                            <select class='edit' name='size'>";
                                if($select == 30){
                                        echo  "<option value=30 selected>30</option>
                                        <option value=40>40</option>";
                                }else{
                                    echo "<option value=30>30</option>
                                    <option value=40 selected>40</option>";
                                }
                            echo "</select></br>
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
    </div>
</div>
</body>

<?php
    mysqli_close($conn);
?>
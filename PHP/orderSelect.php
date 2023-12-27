<!DOCTYPE html>

<?php
@$conn= new mysqli('localhost','root','','pizzeria');
if($conn->connect_errno){
    die($conn->connect_error);
}

$queryMenu="SELECT id, name FROM menu";
$resultMenu=$conn->query($queryMenu);

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
                <div>
                    <span>Ilość elemntów w koszyku: </span>
                    <span id="cart-quantity">
                        <?php
                            session_start();

                            if(isset($_SESSION['cart'])){
                                echo count($_SESSION['cart']);
                            }else{
                                echo 0;
                            }
                        ?>
                    </span>
                </div>
                <?php
                if (!isset($_SESSION['cart'])) {
                    echo '<input class="button" type="button" id="go-next" 
                        onclick="callReload(\'orderConfirm.php\', \'content\', \'Trwa ładowanie strony...\')" 
                        disabled value="Dalej"/>';
                } else {
                    echo '<input class="button" type="button" id="go-next" 
                        onclick="callReload(\'orderConfirm.php\', \'content\', \'Trwa ładowanie strony...\')" 
                        value="Dalej"/>';
                }
                ?>

            </div>       
            <div class="zamowienie"> 
                <?php
                    while($rowMenu=$resultMenu->fetch_assoc())
                    {
                        echo "<div class='item'>
                                <div class='card'>
                                    <img src='../assets/pizzaImg/${rowMenu['name']}.jpg' alt='${rowMenu['name']}'>
                                    <h2>${rowMenu['name']}</h2>
                                    <div class='quantity-container'>
                                        <label for='quantity'>Ilość:</label>
                                        <div class='quantity-input'>
                                            <button onclick='decreaseQuantity(${rowMenu['id']})'>-</button>
                                            <input type='number' id='quantity${rowMenu['id']}' min='0' value='0' disabled>
                                            <button onclick='increaseQuantity(${rowMenu['id']})'>+</button>
                                        </div>
                                    </div>
                                    <div class='radio-container'>
                                        <div>
                                            <input class='radio' type='radio' name='size${rowMenu['id']}' value=30 checked='checked'> 30 cm</input>
                                        </div>
                                        <div>
                                            <input class='radio' type='radio' name='size${rowMenu['id']}' value=40> 40 cm</input></br>
                                        </div>
                                    </div>
                                    <input class='btn' type='button' 
                                        onclick='AddToCart(${rowMenu['id']}, quantity${rowMenu['id']}.value, \"${rowMenu['name']}\")' value='Dodaj'/>  
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

<?php
    mysqli_close($conn);
?>
<?php
$pizzaId = intval($_GET['pizzaId']);
$quantity = intval($_GET['quantity']);
$size = intval($_GET['size']);

@$conn= new mysqli('localhost','root','','pizzeria');
if($conn->connect_errno){
    die($conn->connect_error);
}

if($size == 40)
{
    $query="SELECT price_40 FROM menu WHERE id = '$pizzaId' ";

    $result = $conn->query($query);

    while($row=$result->fetch_assoc()) 
    {
        $price = $quantity * $row['price_40'];
        echo $price;
    }

}
else //gdy rozmiar = 30
{
    $query="SELECT price_30 FROM menu WHERE id = '$pizzaId' ";

    $result = $conn->query($query);

    while($row=$result->fetch_assoc()) 
    {
        $price = $quantity * $row['price_30'];
        echo $price;
    }

}
mysqli_close($conn);
?>
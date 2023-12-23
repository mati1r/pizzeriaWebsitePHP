<?php
$pizzaId = intval($_GET['pizzaId']);
$quantity = intval($_GET['quantity']);
$size = intval($_GET['size']);

@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}

if($size == 40)
{
    $query="SELECT cena_40 FROM menu WHERE id = '$pizzaId' ";

    $result = $conn->query($query);

    while($row=$result->fetch_assoc()) 
    {
        $price = $quantity * $row['cena_40'];
        echo "<p>Cena: $price zł</p>";
    }

}
else //gdy rozmiar = 30
{
    $query="SELECT cena_30 FROM menu WHERE id = '$pizzaId' ";

    $result = $conn->query($query);

    while($row=$result->fetch_assoc()) 
    {
        $price = $quantity * $row['cena_30'];
        echo "Cena: $price zł";
    }

}
mysqli_close($conn);
?>
<?php
@$conn = new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}else
{

    $name=$_GET['name'] ?? null;
    $surname=$_GET['surname'] ?? null;
    $phoneNumber=$_GET['phoneNumber'] ?? null;
    $pizzaId=intval($_GET['pizzaId']) ?? null;
    $quantity=intval($_GET['quantity']) ?? null;
    $size=intval($_GET['size']) ?? null;
    $recordId=intval($_GET['recordId']) ?? null;

    if($name == null || $surname == null || $phoneNumber == null || $pizzaId== null || $quantity == null || 
        $size == null || $recordId == null){}
    else
    {
        $updateOrder = "UPDATE zamowienia SET id_pizzy = $pizzaId, ilosc = $quantity, rozmiar = $size WHERE id = $recordId;";

        $conn->query($updateOrder);

        $select="SELECT id, id_klienta FROM zamowienia  WHERE id = $recordId;";

        $result=$conn->query($select);

        $row=$result->fetch_assoc();

        $updateClient = "UPDATE klient SET Imie = '$name', Nazwisko = '$surname', Telefon = '$phoneNumber' 
                    WHERE id = '{$row['id_klienta']}';";

        $conn->query($updateClient);
    }
}
mysqli_close($conn);
?>

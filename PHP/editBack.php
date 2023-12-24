<?php
@$conn = new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}
else
{

    $name=$_GET['name'] ?? null;
    $surname=$_GET['surname'] ?? null;
    $phoneNumber=$_GET['phoneNumber'] ?? null;
    $pizzaId=intval($_GET['pizzaId']) ?? null;
    $quantity=intval($_GET['quantity']) ?? null;
    $size=intval($_GET['size']) ?? null;
    $recordId=intval($_GET['recordId']) ?? null;

    if($name == null || $surname == null || $phoneNumber == null || $pizzaId== null || $quantity == null || 
        $size == null || $recordId == null)
    {
        http_response_code(400);
        return;
    }

    $pattern = '/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/';

    if (!preg_match($pattern, $phoneNumber)) {
        http_response_code(400);
        return;
    } 

    //All is fine here

    $updateOrder = "UPDATE zamowienia SET id_pizzy = ?, ilosc = ?, rozmiar = ? WHERE id = ?";
    $stmtUpdateOrder = $conn->prepare($updateOrder);
    $stmtUpdateOrder->bind_param('iiii', $pizzaId, $quantity, $size, $recordId);
    $stmtUpdateOrder->execute();
    $stmtUpdateOrder->close();

    $select = "SELECT id, id_klienta FROM zamowienia  WHERE id = ?";
    $stmtSelect = $conn->prepare($select);
    $stmtSelect->bind_param('i', $recordId);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $row = $result->fetch_assoc();
    $stmtSelect->close();

    $updateClient = "UPDATE klient SET Imie = ?, Nazwisko = ?, Telefon = ? WHERE id = ?";
    $stmtUpdateClient = $conn->prepare($updateClient);
    $stmtUpdateClient->bind_param('sssi', $name, $surname, $phoneNumber, $row['id_klienta']);
    $stmtUpdateClient->execute();
    $stmtUpdateClient->close();
}
mysqli_close($conn);
?>

<?php
@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}

    $name=$_GET['name'] ?? null;
    $surname=$_GET['surname'] ?? null;
    $phoneNumber=$_GET['phoneNumber'] ?? null;
    $city=$_GET['city'] ?? null;
    $street=$_GET['street'] ?? null;
    $buildingNumber=intval($_GET['buildingNumber']) ?? null;
    $apartmentNumber=intval($_GET['apartmentNumber']) ?? null;
    $pizzaId=intval($_GET['pizzaId']) ?? null;
    $quantity=intval($_GET['quantity']) ?? null;
    $size=intval($_GET['size']) ?? null;

if($name && $surname && $phoneNumber && $city &&$street && $buildingNumber && $apartmentNumber && 
    $pizzaId && $quantity && $size !=null)
{
    $queryClientCheck="SELECT id FROM klient WHERE Imie = '$name' AND Nazwisko = '$surname' AND Telefon = '$phoneNumber'";  
    $resultClientCheck = $conn->query($queryClientCheck);

        //If there is no such client insert
        if($resultClientCheck->fetch_assoc() == NULL)
        {
            $result="INSERT INTO klient VALUES (null,'$name','$surname','$phoneNumber',
            '$city','$street',$buildingNumber,$apartmentNumber)";    

            $conn->query($result);
        }

    $queryClient="SELECT id FROM klient WHERE Imie = '$name' AND Nazwisko = '$surname' AND Telefon = '$phoneNumber'";

    $resultClient = $conn->query($queryClient);
    $row=$resultClient->fetch_assoc();

    $queryPizza="INSERT INTO zamowienia VALUES (null,'{$row['id']}',$pizzaId, $quantity, $size)";

    $conn->query($queryPizza);
}
else
{
    //jeżeli nie ustawione to jesteśmy tutaj
}
mysqli_close($conn);    
    
?>
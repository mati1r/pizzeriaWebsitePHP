<?php
@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}
else
{

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

    if (empty($name)) 
    {
        http_response_code(400);
        echo "Wypełnij imie";
        return;
    } 
    elseif (strlen($name) < 3) 
    {
        http_response_code(400);
        echo "Imie musi zawierać minimum 3 znaki";
        return;
    }
    
    if (empty($surname)) 
    {
        http_response_code(400);
        echo "Wypełnij Nazwisko";
        return;
    } 
    elseif (strlen($surname) < 5) 
    {
        http_response_code(400);
        echo "Nazwisko musi zawierać minimum 5 znaków";
        return;
    }
    
    if (empty($phoneNumber)) 
    {
        http_response_code(400);
        echo "Wypełnij numer telefonu";
        return;
    } 
    elseif (!preg_match('/[0-9]{3}-[0-9]{3}-[0-9]{3}/', $phoneNumber) || strlen($phoneNumber) > 11) 
    {
        http_response_code(400);
        echo "Poprawnie wypełnij numer telefonu";
        return;
    }
    
    if (empty($city)) 
    {
        http_response_code(400);
        echo "Wypełnij miasto";
        return;
    }
    
    if (empty($street)) 
    {
        http_response_code(400);
        echo "Wypełnij ulice";
        return;
    } 
    elseif (strlen($street) < 3) 
    {
        http_response_code(400);
        echo "Ulica musi zawierać minimum 3 znaki";
        return;
    }
    
    if (empty($buildingNumber) || $buildingNumber < 1 || $buildingNumber > 999) 
    {
        http_response_code(400);
        echo "Wypełnij poprawnie numer budynku (zakres od 1 do 999)";
        return;
    }
    
    if (empty($apartmentNumber) || $apartmentNumber < 1 || $apartmentNumber > 999) 
    {
        http_response_code(400);
        echo "Wypełnij poprawnie numer mieszkania (zakres od 1 do 999)";
        return;
    }
    
    if (empty($pizzaId) || $pizzaId < 1 || $pizzaId > 29) 
    {
        http_response_code(400);
        echo "Wypełnij poprawnie numer pizzy ";
        return;
    }
    
    if (empty($quantity) || $quantity < 1 || $quantity > 99) 
    {
        http_response_code(400);
        echo "Wypełnij poprawnie ilość (można zamówić do 99 pizz)";
        return;
    }
    
    if (empty($size)) 
    {
        http_response_code(400);
        echo "Wybierz rozmiar pizzy";
        return;
    }

    // Check if client exists
    $queryClientCheck = "SELECT id FROM klient WHERE Imie = ? AND Nazwisko = ? AND Telefon = ?";
    $stmtClientCheck = $conn->prepare($queryClientCheck);
    $stmtClientCheck->bind_param('sss', $name, $surname, $phoneNumber);
    $stmtClientCheck->execute();
    $resultClientCheck = $stmtClientCheck->get_result();

    // If there is no such client, insert
    if ($resultClientCheck->num_rows == 0) {
        $queryInsertClient = "INSERT INTO klient VALUES (null, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsertClient = $conn->prepare($queryInsertClient);
        $stmtInsertClient->bind_param('sssssii', $name, $surname, $phoneNumber, $city, $street, $buildingNumber, $apartmentNumber);
        $stmtInsertClient->execute();

        // Retrieve inserted client ID
        $queryClientId = "SELECT id FROM klient WHERE Imie = ? AND Nazwisko = ? AND Telefon = ?";
        $stmtClientId = $conn->prepare($queryClientId);
        $stmtClientId->bind_param('sss', $name, $surname, $phoneNumber);
        $stmtClientId->execute();
        $resultClientId = $stmtClientId->get_result();
        $row = $resultClientId->fetch_assoc();

    }
    else //If there is such a clinet
    {
        $row = $resultClientCheck->fetch_assoc();
    }

    // Insert pizza order
    $queryPizza = "INSERT INTO zamowienia VALUES (null, ?, ?, ?, ?)";
    $stmtPizza = $conn->prepare($queryPizza);
    $stmtPizza->bind_param('iiii', $row['id'], $pizzaId, $quantity, $size);
    $stmtPizza->execute();

    $stmtClientCheck->close();
    $stmtInsertClient->close();
    $stmtClientId->close();
    $stmtPizza->close();
}
mysqli_close($conn);    
    
?>
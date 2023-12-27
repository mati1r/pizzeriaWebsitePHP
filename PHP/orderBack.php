<?php
@$conn= new mysqli('localhost','root','','pizzeria');
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

    session_start();

    // Check if client exists
    $queryClientCheck = "SELECT id FROM client WHERE name = ? AND surname = ? AND phone_number = ?";
    $stmtClientCheck = $conn->prepare($queryClientCheck);
    $stmtClientCheck->bind_param('sss', $name, $surname, $phoneNumber);
    $stmtClientCheck->execute();
    $resultClientCheck = $stmtClientCheck->get_result();

    // If there is no such client, insert
    if ($resultClientCheck->num_rows == 0) {
        $queryInsertClient = "INSERT INTO client VALUES (null, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsertClient = $conn->prepare($queryInsertClient);
        $stmtInsertClient->bind_param('sssssii', $name, $surname, $phoneNumber, $city, $street, $buildingNumber, $apartmentNumber);
        $stmtInsertClient->execute();

        // Retrieve inserted client ID
        $queryClientId = "SELECT id FROM client WHERE name = ? AND surname = ? AND phone_number = ?";
        $stmtClientId = $conn->prepare($queryClientId);
        $stmtClientId->bind_param('sss', $name, $surname, $phoneNumber);
        $stmtClientId->execute();
        $resultClientId = $stmtClientId->get_result();
        $clientId = $resultClientId->fetch_assoc();

    }
    else //If there is such a clinet
    {
        $clientId = $resultClientCheck->fetch_assoc();
    }

    $sum = 0;
    foreach ($_SESSION['cart'] as $index => $pizza) {
        $sum += $pizza['price'];
    }

    // Insert order
    $queryOrder = "INSERT INTO orders VALUES (null, ?, ?)";
    $stmtOrder = $conn->prepare($queryOrder);
    $stmtOrder->bind_param('ii', $clientId['id'], $sum);
    $stmtOrder->execute();

    //Get order id
    $orderId = $stmtOrder->insert_id;
    //echo $orderId;

    //Insert pizza from cart to order to table menu-orders
    
    foreach ($_SESSION['cart'] as $index => $pizza) {
        $queryMenuOrders = "INSERT INTO menu_orders VALUES (?, ?, ?, ?)";
        $stmtMenuOrders = $conn->prepare($queryMenuOrders);

        $pizzaId = intval($pizza["id"]);
        $quantity = intval($pizza['quantity']);
        $size = intval($pizza['size']);

        $stmtMenuOrders->bind_param('iiii', $orderId, $pizzaId, $quantity, $size);
        $stmtMenuOrders->execute();
    }

    //Unset cart after insert
    unset($_SESSION['cart']);

    //Close stmt's
    $stmtClientCheck->close();

    if ($stmtInsertClient !== null) {
        $stmtInsertClient->close();
    }
    if($stmtClientId !== null) {
        $stmtClientId->close();
    }

    $stmtOrder->close();
    $stmtMenuOrders->close();
}
mysqli_close($conn);    
    
?>
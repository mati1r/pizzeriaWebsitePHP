<?php
@$conn = new mysqli('localhost','root','','pizzeria');
if($conn->connect_errno){
    die($conn->connect_error);
}
else
{

    $name = $_GET['name'] ?? null;
    $surname = $_GET['surname'] ?? null;
    $phoneNumber = $_GET['phoneNumber'] ?? null;
    $orderId = $_GET['orderId'] ?? null;
    $orderData = $_GET['orderData'] ?? null;


    if($name == null || $surname == null || $phoneNumber == null ||  $orderData == null)
    {
        http_response_code(400);
        echo "Nieuzupełnione dane";
        return;
    }

    $pattern = '/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/';

    if (!preg_match($pattern, $phoneNumber)) {
        http_response_code(400);
        echo "Niepoprawny format danych";
        return;
    } 
    //Check for duplicates
    function CheckForDuplicates($data) {
        $uniqueCombos = array();
    
        foreach ($data as $pizza) {
            $pizzaId = $pizza['pizzaId'];
            $size = $pizza['size'];

            $comboKey = $pizzaId . '-' . $size;
    
            if (in_array($comboKey, $uniqueCombos)) {
                return true;
            } else {
                //Add to end of table
                $uniqueCombos[] = $comboKey;
            }
        }
    
        //At the end return false (no duplicates)
        return false;
    }

    if(CheckForDuplicates($orderData)) 
    {
        http_response_code(400);
        echo "Podano duplikat";
        return;
    }

    //All is fine here
    $orderId = intval($orderId);

    $select = "SELECT client_id FROM orders WHERE id = ?";
    $stmtSelect = $conn->prepare($select);
    $stmtSelect->bind_param('i', $orderId);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $row = $result->fetch_assoc();
    $stmtSelect->close();

    $updateClient = "UPDATE client SET name = ?, surname = ?, phone_number = ? WHERE id = ?";
    $stmtUpdateClient = $conn->prepare($updateClient);
    $stmtUpdateClient->bind_param('sssi', $name, $surname, $phoneNumber, $row['client_id']);
    $stmtUpdateClient->execute();
    $stmtUpdateClient->close();

    $totalPrice = 0;

    foreach ($orderData as $index => $pizza) {
        echo $pizza['pizzaId'];
        $updateMenuOrders = "UPDATE menu_orders SET menu_id = ?, quantity = ?, size = ? 
                            WHERE orders_id = ? AND menu_id = ? AND size = ?";
        $stmtUpdateMenuOrders = $conn->prepare($updateMenuOrders);

        $pizzaId = intval($pizza['pizzaId']);
        $oldPizzaId = intval($pizza['oldPizzaId']);
        $quantity = intval($pizza['quantity']);
        $size = intval($pizza['size']);

        $totalPrice += intval($pizza['price']);

        $stmtUpdateMenuOrders->bind_param('iiiiii', $pizzaId, $quantity, $size, $orderId, $oldPizzaId, $size);
        $stmtUpdateMenuOrders->execute();
        $stmtUpdateMenuOrders->close();
    }

    $updateOrders = "UPDATE orders SET total_price = ? WHERE id = ?";
    $stmtUpdateOrders = $conn->prepare($updateOrders);
    $stmtUpdateOrders->bind_param('ii', $totalPrice, $orderId);
    $stmtUpdateOrders->execute();
    $stmtUpdateOrders->close();

}
mysqli_close($conn);
?>

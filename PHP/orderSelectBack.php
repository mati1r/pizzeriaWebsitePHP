<?php
    $pizzaId=$_GET['pizzaId'] ?? null;
    $quantity=$_GET['quantity'] ?? null;
    $price=$_GET['price'] ?? null;
    $size=$_GET['size'] ?? null;
    $name=$_GET['name'] ?? null;

    if(empty($pizzaId))
    {
        http_response_code(400);
        echo "Niewybrane id pizzy";
        return;
    }

    if(empty($quantity)){
        http_response_code(400);
        echo "Brak ilości";
        return;
    }

    if($pizzaId < 1 && $pizzaId > 29){
        http_response_code(400);
        echo "Błędne id pizzy";
        return;
    }

    if($quantity < 0 && $quantity > 99){
        http_response_code(400);
        echo "Niepoprawna ilość";
        return;
    }

    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Sprawdź, czy pizza o danym id już istnieje w koszyku
    $pizzaIndex = -1;
    foreach ($_SESSION['cart'] as $index => $pizza) {
        if ($pizza['id'] == $pizzaId && $pizza['size'] == $size) {
            $pizzaIndex = $index;
            break;
        }
    }

    // Jeżeli pizza istnieje, nadpisz ilość
    if ($pizzaIndex !== -1) {
        $_SESSION['cart'][$pizzaIndex]['quantity'] = $quantity;
        $_SESSION['cart'][$pizzaIndex]['price'] = $price;
    } 
    else // Jeżeli pizza nie istnieje, dodaj nową do koszyka
    {
        $_SESSION['cart'][] = array(
            'id' => $pizzaId,
            'quantity' => $quantity,
            'price' => $price,
            'size' => $size,
            'name' => $name
        );
    }

    echo json_encode($_SESSION['cart']);
?>
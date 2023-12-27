<?php
    $pizzaId=$_GET['pizzaId'] ?? null;
    $size=$_GET['size'] ?? null;

    if(empty($pizzaId))
    {
        http_response_code(400);
        echo "Niewybrane id pizzy";
        return;
    }

    if(empty($size))
    {
        http_response_code(400);
        echo "Brak rozmiaru";
        return;
    }

    session_start();

    if (!isset($_SESSION['cart'])) {
        http_response_code(400);
        echo "Brak przedmiotów w koszyku";
        return;
    }

    foreach ($_SESSION['cart'] as $index => $pizza) {
        if ($pizza['id'] == $pizzaId && $pizza['size'] == $size) {
            unset($_SESSION['cart'][$index]);
        }
    }
?>
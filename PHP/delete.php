<?php
@$conn = new mysqli('localhost', 'root', '', 'pizzeria');
if ($conn->connect_errno) {
    die($conn->connect_error);
}

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $id = intval($id);

    //From menu_orders
    $queryDeleteMenuOrders = "DELETE FROM menu_orders WHERE orders_id = ?";
    $stmtDeleteMenuOrders = $conn->prepare($queryDeleteMenuOrders);
    $stmtDeleteMenuOrders->bind_param('i', $id);
    $stmtDeleteMenuOrders->execute();
    $stmtDeleteMenuOrders->close();

    //From orders
    $queryDeleteOrder = "DELETE FROM orders WHERE id = ?";
    $stmtDeleteOrder = $conn->prepare($queryDeleteOrder);
    $stmtDeleteOrder->bind_param('i', $id);
    $stmtDeleteOrder->execute();
    $stmtDeleteOrder->close();


}

mysqli_close($conn);
?>


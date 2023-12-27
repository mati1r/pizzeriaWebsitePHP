<?php

@$conn = new mysqli('localhost', 'root', '', 'pizzeria');
if ($conn->connect_errno) {
    die($conn->connect_error);
}

$login = $_GET['login'] ?? null;
$password = $_GET['password'] ?? null;

$query = "SELECT login, password FROM admin_account WHERE login = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $login, $password);

$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    session_start();
    $_SESSION['login'] = true;
    session_commit();
} else {
    http_response_code(401);
}

$stmt->close();
mysqli_close($conn);
?>

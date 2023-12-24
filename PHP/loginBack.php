<?php

@$conn = new mysqli('localhost', 'root', '', 'Restauracja');
if ($conn->connect_errno) {
    die($conn->connect_error);
}

$login = $_GET['login'] ?? null;
$password = $_GET['password'] ?? null;
echo "Login: $login, Password: $password<br>";
$query = "SELECT login, haslo FROM logowanie WHERE login = ? AND haslo = ?";
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
    echo "Login: $login, Password: $password<br>";
}

$stmt->close();
mysqli_close($conn);
?>

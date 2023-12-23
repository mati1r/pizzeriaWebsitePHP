<?php

@$conn= new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}
$login=$_GET['login'] ?? null;
$password=$_GET['$password'] ?? null;

$logowanie="SELECT login, haslo FROM logowanie;";
$wynik = $conn->query($logowanie);

$spr = 0;

while($wiersz=$wynik->fetch_assoc())
{
    if($login == $wiersz['login'] && $password == $wiersz['haslo']){
        $spr = 1;
    }
}

if($spr == 1){
    session_start();
    $_SESSION['login'] = true;
    session_commit();
}else
{
    http_response_code(401);
    echo "Bledne dane logowania";
}
?>
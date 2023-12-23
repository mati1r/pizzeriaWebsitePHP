<?php
@$conn = new mysqli('localhost','root','','Restauracja');
if($conn->connect_errno){
    die($conn->connect_error);
}
$id=$_GET['id'] ?? null;
if($id == null){}
else
{

$delete="DELETE FROM zamowienia WHERE id = $id";
$conn->query($delete);
}
mysqli_close($conn);
?>

<?php session_start(); 
 
if (isset($_SESSION['username'])){ 
    unset($_SESSION['username']); // xóa session login
    header('Location: home.php');
}
if (isset($_SESSION['id'])){ 
    unset($_SESSION['id']); // xóa session login
    header('Location: home.php');
}
?>

<?php
session_start();
if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    session_destroy();
    header("Location:index.php");
}

?>
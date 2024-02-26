<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['userid'])) {
    header("location:index.php");
} else {
    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];

    mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

    header("location:index.php");
}


?>
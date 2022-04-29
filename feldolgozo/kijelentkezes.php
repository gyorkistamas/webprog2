<?php
session_start();

require "connect.php";

$con = connect();

$felhasznalonev = $_SESSION['felhasznalo'];
$datum = date("Y-m-d H:i:s", time());
mysqli_query($con, "INSERT INTO log(felhasznalo, tevekenyseg, datum) VALUES('$felhasznalonev', 'kijelentkezés', '$datum')");
mysqli_close($con);


unset($_SESSION['felhasznalo']);
unset($_SESSION['jogosultsag']);
session_destroy();

header("Location: ../login.php");
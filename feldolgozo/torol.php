<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../src/other/icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Törlés</title>
</head>

<body>

<?php

session_start();

if(!isset($_SESSION['felhasznalo']))
{
    include "need_to_login.php";
}
else if ($_SESSION['jogosultsag'] != 'admin')
{
    include "nincs_jog.php";
}
else
{
    require "connect.php";
    $con = connect();

    if(!$con)
    {
        include "adatbazis_hiba.php";
    }
    else
    {

    $id = $_GET['id'];

    $file = mysqli_fetch_row(mysqli_query($con, "SELECT kep FROM software where id = '$id'"))[0];

    unlink("../src/softwares/$file");

    $query = "DELETE FROM software WHERE id = '$id'";
    mysqli_query($con, $query);

    mysqli_close($con);
    ?>

    <div class="container">
        <h1>Sikeres törlés</h1>
        <a href="../index.php"><button>Vissza</button></a>
    </div>

<?php
}
}
?>

</body>

</html>
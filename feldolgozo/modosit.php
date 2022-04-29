<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../src/other/icon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Módosítás</title>
</head>

<body>
<?php

session_start();

if (!isset($_SESSION['felhasznalo']))
{
    include "need_to_login.php";
    session_destroy();
}
else if($_SESSION['jogosultsag'] != "admin" && $_SESSION['jogosultsag'] != "moderator")
{
    include "nincs_jog.php";
}
else if (!isset($_GET['id']))
{
    echo "Nincs id megadva!";
}
else
{
    require "connect.php";

    $con = connect();

    if (!$con)
    {
        include "adatbazis_hiba.php";
    }
    else
    {

    $id = $_GET['id'];


    $nev = $_POST['nev'];
    $gyarto = $_POST['gyarto'];
    $ar = $_POST['ar'];
    $leiras = $_POST['leiras'];



    if ($_FILES['kep']['name'] != "")
    {
        $file = mysqli_fetch_row(mysqli_query($con, "SELECT kep FROM software where id = '$id'"))[0];

        unlink("../src/softwares/$file");

        $fajlnev = "$id.". pathinfo($_FILES['kep']['name'])['extension'];

        move_uploaded_file($_FILES['kep']['tmp_name'], "../src/softwares/$fajlnev");

        mysqli_query($con, "UPDATE software SET kep = '$fajlnev' WHERE id = '$id'");
    }

    $query = "UPDATE software SET nev = '$nev', fejleszto = '$gyarto', ar = '$ar', leiras = '$leiras' WHERE id = '$id'";
    mysqli_query($con, $query);

    mysqli_close($con);
    ?>

    <div class="container">
        <h1>Sikeres módosítás!</h1>
        <meta http-equiv='refresh' content='2;url=../index.php'>
    </div>


<?php
}
}
?>
</body>

</html>
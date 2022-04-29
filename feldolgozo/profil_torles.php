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
    <title>Törlés</title>
</head>

<body>
<?php

session_start();

if (!isset($_SESSION['felhasznalo']))
{
    include "need_to_login.php";
    session_destroy();
}
else if($_SESSION['jogosultsag'] != 'admin')
{
    include "nincs_jog.php";
}
else if($_SESSION['felhasznalo'] == $_GET['felhasznalo'])
{?>

    <div class="container">
        <h1>Saját magát nem törölheti!</h1>
        <a href="../index.php">Vissza a kezdőlapra</a>
    </div>


    <?php
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
    $felhasznalonev = $_GET['felhasznalo'];

    $kep = mysqli_fetch_row(mysqli_query($con, "SELECT kep FROM user WHERE felhasznalonev = '$felhasznalonev'"))[0];

    unlink("../src/users/$kep");

    mysqli_query($con, "DELETE FROM user WHERE felhasznalonev = '$felhasznalonev'");


    mysqli_close($con);
    ?>

    <div class="container">
        <h1>Sikeres törlés!</h1>
        <meta http-equiv='refresh' content='1;url=../index.php'>
    </div>


<?php
}
}
?>
</body>

</html>
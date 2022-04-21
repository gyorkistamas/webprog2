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
else if($_GET['felhasznalonev'] != $_SESSION['felhasznalo'] && $_SESSION['jogosultsag'] != 'admin')
{
    include "nincs_jog.php";
}
else
{
    require "connect.php";

    $con = connect();

    $felhasznalonev = $_GET['felhasznalonev'];


    $nev = $_POST['nev'];
    $email = $_POST['email'];
    $jelszo = md5($_POST['jelszo']);



    if ($_FILES['kep']['name'] != "")
    {
        $file = mysqli_fetch_row(mysqli_query($con, "SELECT kep FROM user where felhasznalonev = '$felhasznalonev'"))[0];

        unlink("../src/users/$file");

        $fajlnev = "$felhasznalonev.". pathinfo($_FILES['kep']['name'])['extension'];

        move_uploaded_file($_FILES['kep']['tmp_name'], "../src/users/$fajlnev");

        mysqli_query($con, "UPDATE user SET kep = '$fajlnev' WHERE felhasznalonev = '$felhasznalonev'");
    }


    if(isset($_POST['jelszo']) && $_POST['jelszo'] != "")
    {
        mysqli_query($con, "UPDATE user SET jelszo = '$jelszo' WHERE felhasznalonev = '$felhasznalonev'");
    }

    $query = "UPDATE user SET nev = '$nev', email = '$email' WHERE felhasznalonev = '$felhasznalonev'";
    mysqli_query($con, $query);

    mysqli_close($con);

    if($_SESSION['felhasznalo'] == $_GET['felhasznalonev'])
    {
        unset($_SESSION['felhasznalo']);
        session_destroy();
    }

    ?>

    <div class="container">
        <h1>Sikeres módosítás!</h1>
        <a href="../index.php"><button>Vissza</button></a>
    </div>


    <?php
}

?>
</body>

</html>
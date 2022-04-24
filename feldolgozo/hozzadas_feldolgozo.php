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
    <title>Hozzáadás</title>
</head>

<body>

<div class="container">
    <?php

    switch (add())
    {
        case 1:
            echo "<h1>Hiba az adatbázissal való kapcsolat kiépítésében!</h1>";
            echo "<a href='../hozzaadas.php'>Vissza a regisztrációhoz!</a>";
            break;

        case 2:
            echo "<h1>Adjon meg minden adatot a hozzádasához!</h1>";
            echo "<a href='../hozzaadas.php'>Vissza</a>";
            break;

        case 3:
            echo "<h1>Ez már megtalálható az adatbázisban!</h1>";
            echo"<a href='../hozzaadas.php'>Vissza</a>";
            break;

        case 4:
            echo "<h1>Sikeres hozzáadás!</h1>";
            echo "<a href='../index.php'>Vissza a főoldalra</a>";
    }

    ?>
</div>

</body>

</html>

<?php

function add()
{
    require "connect.php";

    session_start();

    $con = connect();

    if (!$con)
    {
        return 1;
    }



    if (!isset($_POST['nev']) || !isset($_POST['fejleszto']) || !isset($_POST['leiras']) || !isset($_POST['ar']))
    {
        return 2;
    }




    $nev = $_POST['nev'];
    $fejleszto = $_POST['fejleszto'];
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];
    $felhasznalo = $_SESSION['felhasznalo'];

    $query = "SELECT * FROM software WHERE nev LIKE '$nev'";

    if (mysqli_fetch_row(mysqli_query($con, $query)) != NULL)
    {
        return 3;
    }

    $fajlnev = str_replace(' ', '', $nev).".". pathinfo($_FILES['kep']['name'])['extension'];

    $query = "INSERT INTO software(nev, fejleszto, leiras, ar, hozzaadta, kep) VALUES('$nev', '$fejleszto', '$leiras', '$ar', '$felhasznalo', '$fajlnev')";

    $utvonal = "../src/softwares/$fajlnev";

    move_uploaded_file($_FILES['kep']['tmp_name'], $utvonal);

    mysqli_query($con, $query);

    mysqli_close($con);

    return 4;

}


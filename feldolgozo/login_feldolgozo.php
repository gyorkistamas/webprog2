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
    <title>Bejelentkezés</title>
</head>

<body>

<div class="container">
<?php

    switch (login())
    {
        case 1:
            echo "<h1>Hiba az adatbázissal való kapcsolat kiépítésében!</h1>";
            echo "<a href='../login.php'>Vissza a bejelentkezéshez</a>";
            break;

        case 2:
            echo "<h1>Adjon meg minden adatot a bejelentkezéshez!</h1>";
            echo "<a href='../login.php'>Vissza a bejelentkezéshez</a>";
            break;

        case 3:
            echo "<h1>Sikertelen bejelentkezés, kérem ellenőrizze az adatokat!</h1>";
            echo "<a href='../login.php'>Vissza a bejelentkezéshez</a>";
            break;

        case 4:
            echo "<h1>Sikeres bejelentkezés!</h1>";
            echo "<meta http-equiv='refresh' content='1;url=../index.php'>";
            break;
    }

?>
</div>

</body>

</html>

<?php

function login()
{
    require "connect.php";

    $con = connect();

    if (!$con)
    {
        return 1;
    }

    if (!isset($_POST['felhasznalo']) || !isset($_POST['jelszo']))
    {
        return 2;
    }


    $felhasznalonev = $_POST['felhasznalo'];
    $jelszo = md5($_POST['jelszo']);

    $query = "SELECT * FROM user WHERE user.felhasznalonev = '$felhasznalonev' and user.jelszo = '$jelszo'";

    $sendquery = mysqli_query($con, $query);

    $row = mysqli_fetch_row($sendquery);

    if ($row == NULL)
    {
        return 3;
    }

    session_start();

    $_SESSION['felhasznalo'] = $row[0];
    $_SESSION['nev'] = $row[1];
    $_SESSION['jogosultsag'] = $row[4];
    $_SESSION['kep'] = $row[5];

    mysqli_close($con);
    return 4;
}


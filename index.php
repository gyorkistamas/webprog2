<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" href="src/other/icon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Főoldal</title>
</head>

<body>
<?php

    session_start();

    if (!isset($_SESSION['felhasznalo']))
    {
        include "nincs_bejelentkezve.php";
        session_destroy();
    }
    else
    {
        include "menu.php";

        include "softwaremegjelenit.php";
    }

?>
</body>

</html>
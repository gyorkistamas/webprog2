<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="icon" href="src/other/icon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Keresés</title>
</head>

<body>
<?php

session_start();

if (!isset($_SESSION['felhasznalo']))
{
    include "need_to_login.php";
    session_destroy();
}
else
{
    include "menu.php";

    if(isset($_GET['szoveg']))
    {
        include "showsoftware.php";
    }
    else
    {?>

        <div class="container">
            <form action="kereses.php" method="GET">
                <table>
                    <tr>
                        <td><label for="search">Keresett Szöveg:</label></td>
                        <td><input type="text" name="szoveg"></td>
                        <td><button type="submit">Keresés</button></td>
                    </tr>
                </table>
            </form>
        </div>

<?php
    }
}

?>
</body>

</html>
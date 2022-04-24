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
    <title>Hozzáadás</title>
</head>

<body>
<?php

session_start();

if (!isset($_SESSION['felhasznalo']))
{
    include "nincs_bejelentkezve.php";
    session_destroy();
}
else if($_SESSION['jogosultsag'] != 'admin' && $_SESSION['jogosultsag'] != 'moderator')
{
    include "nincs_jog.php";
}
else
{
    include "menu.php";
    ?>

    <div class="container">
        <form action="feldolgozo/hozzadas_feldolgozo.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="nev">Név:</label></td>
                    <td><input type="text" name="nev" required></td>
                </tr>

                <tr>
                    <td><label for="fejleszto">Fejlesztő:</label></td>
                    <td><input type="text" name="fejleszto" required></td>
                </tr>

                <tr>
                    <td><label for="leiras">Leírás:</label></td>
                    <td><textarea rows="5" cols="40" name="leiras" required></textarea></td>
                </tr>

                <tr>
                    <td><label for="ar">Ár:</label></td>
                    <td><input type="number" name="ar" required></td>
                </tr>

                <tr>
                    <td><label for="kep">Kép:</label></td>
                    <td><input type="file" name="kep" required></td>
                </tr>
            </table>

            <button type="submit">Hozzáadás</button>
        </form>
    </div>

<?php
}
?>
</body>

</html>
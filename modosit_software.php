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
    require "feldolgozo/connect.php";

    include "menu.php";
    $con = connect();

    $id = $_GET['id'];
    $query = "SELECT * FROM software WHERE id= '$id'";

    $result = mysqli_fetch_row(mysqli_query($con, $query));
    ?>

    <div class="container">
        <form action="feldolgozo/modosit.php?id=<?=$id?>" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="kep">Kép:</label></td>
                <td><input type="file" name="kep"></td>
            </tr>

            <tr>
                <td><label for="nev">Név:</label></td>
                <td><input type="text" name="nev" value="<?= $result[1] ?>"></td>
            </tr>

            <tr>
                <td><label for="gyarto">Gyártó:</label></td>
                <td><input type="text" name="gyarto" value="<?= $result[2] ?>"></td>
            </tr>

            <tr>
                <td><label for="ar">Ár:</label></td>
                <td><input type="number" name="ar" value="<?= $result[4] ?>"></td>
            </tr>

            <tr>
                <td><label for="leiras">Leírás:</label></td>
                <td><textarea rows="5" cols="40" name="leiras"><?= $result[3] ?></textarea></td>
            </tr>
        </table>

        <button type="submit">Módosítás</button>
        </form>
    </div>

<?php
}

?>
</body>

</html>
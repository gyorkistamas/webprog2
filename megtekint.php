<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="src/other/icon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Megtekintés</title>
</head>

<body>
<?php

session_start();
include "menu.php";
require "feldolgozo/connect.php";

if(!isset($_SESSION['felhasznalo']))
{
    include "need_to_login.php";
}
else if (!isset($_GET['id']))
{
    die("Adjon meg egy értéket!<br><a href='index.php'>Vissza a kezdőlapra</a>");
}
else
{
    $con = connect();
    $id = $_GET['id'];
    $query = "SELECT * FROM software WHERE id = '$id'";

    $software = mysqli_fetch_row(mysqli_query($con, $query));
    ?>

    <div class="container">
        <img src="src/softwares/<?= $software[6] ?>" id="softwarepic">
        <hr>
        <h4>Név: <?= $software[1] ?></h4>
        <h4>Fejlesztő: <?= $software[2] ?></h4>
        <h3>Leírás:</h3>
        <p><?= $software[3] ?></p>
        <hr>
        <h4>Ár: <?= $software[4] ?> Ft</h4>
        <hr>
        <?php

        if($_SESSION['jogosultsag'] == 'admin' || $_SESSION['jogosultsag'] == 'moderator')
        {
            echo "<a href='modosit_software.php?id=$software[0]'><button>Szerkesztés</button></a>";
        }

        if ($_SESSION['jogosultsag'] == 'admin')
        {
            echo "<a href='feldolgozo/torol.php?id=$software[0]'><button>Törlés</button></a>";
        }
        ?>

        <a href="index.php"><button>Vissza</button></a>
    </div>



<?php
}
?>
</body>

</html>
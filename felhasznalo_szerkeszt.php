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
    <title>Felhasználók szerkesztése</title>
</head>

<body>
<?php

session_start();

if (!isset($_SESSION['felhasznalo']))
{
    include "nincs_bejelentkezve.php";
    session_destroy();
}
else if($_SESSION['jogosultsag'] != 'admin')
{
    include "nincs_jog.php";
}
else
{
    include "menu.php";

    require "feldolgozo/connect.php";

    $con = connect();

    if(!$con)
    {
        include "adatbazis_hiba.php";
    }
    else
    {

    $query = "SELECT * FROM user";

    $result = mysqli_fetch_all(mysqli_query($con, $query));
    ?>

<div class="container">
    <table>
        <tr>
            <td class="leftborder rightborder topandbottomborder"><h3>Profilkép</h3></td>
            <td class="rightborder topandbottomborder"><h3>Felhasználónév</h3></td>
            <td class="rightborder topandbottomborder"><h3>Név</h3></td>
            <td class="rightborder topandbottomborder"><h3>E-mail cím</h3></td>
            <td class="rightborder topandbottomborder"><h3>Jogosultság</h3></td>
        </tr>

<?php
    foreach ($result as $user)
    {?>

        <tr>
            <td class="leftborder rightborder topandbottomborder"><img src="src/users/<?=$user[5]?>" class="miniature" alt="kép"> </td>
            <td class="rightborder topandbottomborder"><h3><?= $user[0] ?></h3></td>
            <td class="rightborder topandbottomborder"><h3><?= $user[1] ?></h3></td>
            <td class="rightborder topandbottomborder"><h3><?= $user[2] ?></h3></td>
            <td class="rightborder topandbottomborder"><h3><?= $user[4] ?></h3></td>
            <td class="topandbottomborder"><a href="profil.php?felhasznalonev=<?=$user[0]?>"><button>Szerkesztés</button></a></td>
            <td class="topandbottomborder rightborder"><a href="feldolgozo/profil_torles.php?felhasznalo=<?= $user[0] ?>"><button>Törlés</button></a></td>
        </tr>


    <?php
    }
    mysqli_close($con);
?>

    </table>
</div>

<?php
}
}
?>
</body>

</html>
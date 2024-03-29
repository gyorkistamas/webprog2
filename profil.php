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
    <title>Profil Módosítás</title>
</head>

<body>
<?php

session_start();

if (!isset($_SESSION['felhasznalo']))
{
    include "nincs_bejelentkezve.php";
    session_destroy();
}
else if($_GET['felhasznalonev'] != $_SESSION['felhasznalo'] && $_SESSION['jogosultsag'] != 'admin')
{
    include "nincs_jog.php";
}
else
{
    require "feldolgozo/connect.php";

    include "menu.php";
    $con = connect();

    if (!$con)
    {
        include "adatbazis_hiba.php";
    }
    else
    {

    $felhasznalonev = $_GET['felhasznalonev'];
    $query = "SELECT * FROM user WHERE felhasznalonev= '$felhasznalonev'";

    $result = mysqli_fetch_row(mysqli_query($con, $query));
    ?>

    <div class="container">
        <form action="feldolgozo/profil_modosit.php?felhasznalonev=<?=$felhasznalonev?>" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="kep">Profilkép:</label></td>
                    <td><input type="file" name="kep"></td>
                </tr>

                <tr>
                    <td><label for="nev">Név:</label></td>
                    <td><input type="text" name="nev" value="<?= $result[1] ?>"></td>
                </tr>

                <tr>
                    <td><label for="email">Email cím:</label></td>
                    <td><input type="email" name="email" value="<?= $result[2] ?>"></td>
                </tr>

                <tr>
                    <td><label for="jelszo">Jelszó:</label></td>
                    <td><input type="password" name="jelszo"></td>
                </tr>

                <?php

                if ($_GET['felhasznalonev'] != $_SESSION['felhasznalo'] && $_SESSION['jogosultsag'] == 'admin')
                {?>

                    <tr>
                        <td><label for="jog">Jogosultság:</label></td>
                        <td><select name="jog" id="cars">
                                <option value="admin" <?php if($result[4] == "admin") echo "selected";?>>Admin</option>
                                <option value="moderator" <?php if($result[4] == "moderator") echo "selected";?>>Moderátor</option>
                                <option value="felhasznalo" <?php if($result[4] == "felhasznalo") echo "selected";?>>Felhasználó</option>
                            </select></td>
                    </tr>

                    <?php
                }

                ?>
            </table>

            <button type="submit">Módosítás</button>
        </form>
    </div>

    <?php
        mysqli_close($con);
}
}

?>
</body>

</html>
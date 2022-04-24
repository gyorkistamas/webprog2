<div id="navbar">
    <ul>
        <li><a href="index.php">Kezdőlap | </a></li>
        <li><a href="kereses.php">Keresés | </a></li>

        <li><a href="profil.php?felhasznalonev=<?=$_SESSION['felhasznalo']?>">Profil szerkesztése | </a></li>

        <?php

        if ($_SESSION['jogosultsag'] == "admin" || $_SESSION['jogosultsag'] == "moderator")
        {
            echo "<li><a href='hozzaadas.php'>Hozzáadás | </a></li>";
        }

        if ($_SESSION['jogosultsag'] == "admin")
        {
            echo "<li><a href='felhasznalo_szerkeszt.php'>Felhasználók szerkesztése | </a></li>";
        }

        ?>

        <li><a href="feldolgozo/letoltes.php">Adatbázis letöltése | </a></li>
        <li id="logout">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="src/users/<?=$_SESSION['kep']?>" id="profilpic" alt="profilkép"> <?= $_SESSION['nev']?><a href="feldolgozo/kijelentkezes.php"> | Kijelentkezés</a></li>


    </ul>
</div>
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
            echo "<li><a>Felhasználó hozzáadása | </a></li>";
            echo "<li><a>Felhasználók szerkesztése | </a></li>";
        }

        ?>

        <li id="logout">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="src/users/<?=$_SESSION['kep']?>" id="profilpic"> <?= $_SESSION['nev']?><a href="feldolgozo/logout.php"> | Kijelentkezés</a></li>


    </ul>
</div>
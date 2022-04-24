<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="src/other/icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Regisztráció</title>
</head>

<body>

<div class="container">
    <form action="feldolgozo/register_feldolgozo.php" method="POST" enctype="multipart/form-data">
        <h1>Regisztráció</h1>
        <hr>

        <table>
            <tr>
                <td><label for="felhasznalo">Felhasználónév:</label></td>
                <td><input type="text" name="felhasznalo" required></td>
            </tr>

            <tr>
                <td><label for="kep">Profilkép: </label></td>
                <td><input type="file" name="kep" required></td>
            </tr>

            <tr>
                <td><label for="nev">Név: </label></td>
                <td><input type="text" name="nev" required></td>
            </tr>

            <tr>
                <td><label for="email">E-mail cím:</label></td>
                <td><input type="email" name="email" required></td>
            </tr>

            <tr>
                <td><label for="jelszo">Jelszó:</label></td>
                <td><input type="password" name="jelszo" required pattern=".{7,}" placeholder="Legalább 7 karakter"></td>
            </tr>
        </table>

        <div class="g-recaptcha" data-sitekey="6LfOTY4fAAAAAFIihuhi5zsYvPWYoNgPeluxhkJ8"></div>
        <button type="submit">Regisztráció</button>
    </form>

    <br>
    <a href="login.php">Vissza a bejelentkezéshez</a>
</div>

</body>

</html>
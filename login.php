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
    <title>Bejelentkezés</title>
</head>

<body>

<div class="container">
    <form action="feldolgozo/login_feldolgozo.php" method="POST">

        <h1>Bejelentkezés</h1>
        <hr>
        <table>
            <tr>
                <td><label for="felhasznalo">Felhasználónév:</label></td>
                <td><input type="text" name="felhasznalo" required></td>
            </tr>

            <tr>
                <td><label for="jelszo">Jelszó:</label></td>
                <td><input type="password" name="jelszo" required></td>
            </tr>
        </table>

        <button type="submit">Bejelentkezés</button>
    </form>

    <br>
    <a href="regisztracio.php">A regisztráláshoz kattintson ide</a>
</div>

</body>

</html>
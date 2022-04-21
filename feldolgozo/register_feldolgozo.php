<!DOCTYPE html>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../src/other/icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Regisztráció</title>
</head>

<body>

<div class="container">
<?php

    switch (register())
    {
        case 1:
            echo "<h1>Hiba az adatbázissal való kapcsolat kiépítésében!</h1>";
            echo "<a href='../login.php'>Vissza a regisztrációhoz!</a>";
            break;

        case 2:
            echo "<h1>Adjon meg minden adatot a regisztrációhoz!</h1>";
            echo "<a href='../register.php'>Vissza a regisztrációhoz!</a>";
            break;

        case 3:
            echo "<h1>Már létezik ilyen felhasználónév!</h1>";
            echo "<a href='../register.php'>Vissza a regisztrációhoz</a>";
            break;

        case 4:
            echo "<h1>Ezzel az e-mail címmel már regisztráltak!</h1>";
            echo "<a href='../register.php'>Vissza a regisztrációhoz</a>";
            break;

        case 5:
            echo "<h1>Sikertelen captcha validáció</h1>";
            echo "<a href='../register.php'>Vissza a regisztrációhoz</a>";
            break;

        case 6:
            echo "<h1>Sikeres regisztráció</h1>";
            echo"<a href='../login.php'>Tovább a bejelentkezéshez</a>";
    }

?>
</div>

</body>

</html>

<?php

function register()
{
    require "connect.php";

    $con = connect();

    if (!$con)
    {
        return 1;
    }



    if (!isset($_POST['felhasznalo']) || !isset($_POST['jelszo']) || !isset($_POST['nev']) || !isset($_POST['email']))
    {
        return 2;
    }


    $felhasznalonev = $_POST['felhasznalo'];
    $query = "SELECT * FROM user WHERE user.felhasznalonev = '$felhasznalonev'";

    if (mysqli_fetch_row(mysqli_query($con, $query)) != NULL)
    {
        return 3;
    }

    $email = $_POST['email'];

    $query = "SELECT * FROM user WHERE user.email = '$email'";

    if (mysqli_fetch_row(mysqli_query($con, $query)) != NULL)
    {
        return 4;
    }



    if(!isset($_POST['g-recaptcha-response']))
    {
        return 5;
    }

    $key = "6LfOTY4fAAAAAHE8j_zA3kH_VJDc1EmxItkMtt6q";
    $response = $_POST['g-recaptcha-response'];

    $data = array('secret' => $key, 'response' => $response);

    $url = "https://www.google.com/recaptcha/api/siteverify";

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = json_decode(file_get_contents($url, false, $context));

    if (!($result -> success))
    {
        return 5;
    }


    $nev = $_POST['nev'];
    $jelszo = md5($_POST['jelszo']);

    $fajlnev = "$felhasznalonev.". pathinfo($_FILES['kep']['name'])['extension'];

    $query = "INSERT INTO user(felhasznalonev, nev, email, jelszo, csoport, kep) VALUES('$felhasznalonev', '$nev', '$email', '$jelszo', 'felhasznalo', '$fajlnev')";

    $utvonal = "../src/users/$fajlnev";

    move_uploaded_file($_FILES['kep']['tmp_name'], $utvonal);

    mysqli_query($con, $query);

    mysqli_close($con);

    return 6;

}


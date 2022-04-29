<?php

require "connect.php";

$con = connect();

if(!$con)
{
    die("Hiba az adatbázissal való kapcsolat létrehozása során!<br><a href='../index.php'>Vissza a kezdőlapra</a>");
}

$query = "SELECT * FROM software";

$result = mysqli_fetch_all(mysqli_query($con, $query));

$file = fopen("../src/temp.csv", "w");

fwrite($file, 'id;nev;fejleszto;leiras;ar;hozzaadta;kep');

foreach ($result as $software)
{
    fwrite($file, "\n$software[0];$software[1];$software[2];$software[3];$software[4];$software[5];$software[6]");
}

fclose($file);
mysqli_close($con);

$file = "../src/temp.csv";

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="adatbazis.csv"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);

unlink($file);


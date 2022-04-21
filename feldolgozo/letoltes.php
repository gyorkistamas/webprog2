<?php

require "connect.php";

$con = connect();

$query = "SELECT * FROM software";

$result = mysqli_fetch_all(mysqli_query($con, $query));

$file = fopen("../src/temp.txt", "w");

fwrite($file, 'id;nev;fejleszto;leiras;ar;hozzaadta;kep');

foreach ($result as $software)
{
    fwrite($file, "\n$software[0];$software[1];$software[2];$software[3];$software[4];$software[5];$software[6]");
}

fclose($file);
mysqli_close($con);

$file = "../src/temp.txt";

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($file).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);

unlink($file);


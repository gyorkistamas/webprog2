<?php


function connect($hostname = "localhost", $username = "root", $jelszo = "", $adatbazis = "gy_beadando")
{
    $con = "";

    try {
        $con = mysqli_connect($hostname, $username, $jelszo, $adatbazis, 3306);

    }
    catch (Exception $e)
    {
        return false;
    }

    return $con;
}
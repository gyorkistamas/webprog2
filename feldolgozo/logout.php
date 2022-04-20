<?php
session_start();
unset($_SESSION['felhasznalo']);
unset($_SESSION['jogosultsag']);
session_destroy();

header("Location: ../login.php");
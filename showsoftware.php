<?php


if (!isset($_SESSION['felhasznalo']))
{
    header("Location: need_to_login.php");
}


require "feldolgozo/connect.php";

$con = connect();

$query = "SELECT * FROM software";

$name = "";
if(isset($_GET['szoveg']))
{
    $name = $_GET['szoveg'];
    $query = "SELECT * FROM software WHERE software.nev LIKE '%$name%'";
}

$result = mysqli_fetch_all(mysqli_query($con, $query));

mysqli_close($con);

if (count($result) == 0)
{
    ?>

    <div class="container">
        <h1>Nincs találat!</h1>
    </div>

<?php
}
else
{

    if(!isset($_GET['page']))
    {
        $page = 0;
    }
    else
    {
        $page = $_GET['page'] - 1;
    }

    $oldalszam = ceil(count($result) / 6);
    if (($page * 6) + 6 >= count($result))
    {
        $max = count($result);
    }
    else
    {
        $max = ($page * 6) + 6;
    }
    ?>
        <div class="container">
    <table>
        <tr>
<?php
    for ($i = $page * 6; $i < $max; $i++)
    {?>
        <td>
            <table>
                <tr>
                    <td><img src="src/softwares/<?=$result[$i][6]?>" class="miniature"></td>
                </tr>
                <tr>
                    <td><p><?= $result[$i][1] ?></p></td>
                </tr>
                <tr>
                    <td><a href="megtekint.php?id=<?= $result[$i][0] ?>"><button>Megtekintés</button></a></td>
                </tr>
            </table>
        </td>
<?php
    }?>

        </tr>
    </table>
        </div>

<?php

    if ($oldalszam > 1)
    {?>

        <div class="container">

       <?php
        for ($j = 1; $j <= $oldalszam; $j++)
        {?>
            <a href="index.php?page=<?= $j ?>&szoveg=<?=$name?>"><button><?= $j ?></button></a>

            <?php
        }?>
        </div>
            <?php
    }

    ?>


<?php
}

?>



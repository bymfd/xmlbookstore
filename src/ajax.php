<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "vendor/autoload.php";
$dba = new DbPg();
$db = $dba->interface();

$author = isset($_GET["author"]) ? $_GET["author"] : "";
$q = "SELECT * FROM books INNER JOIN authors
ON authors.author = books.author where authors.anames LIKE '%$author%' ORDER BY authors.anames ";

$reta = pg_query($db, $q);
//$row = json_encode(pg_fetch_row($reta));
//echo $row;
echo "<table class='table table-striped table-hover'> ";
while ($row = pg_fetch_row($reta)) {

    echo "<tr>";
    echo "<td>" . $row[3] . "</td>";
    echo "<td>" . $row[1] . "</td>";

    echo "</tr>";

}
echo "</table>";
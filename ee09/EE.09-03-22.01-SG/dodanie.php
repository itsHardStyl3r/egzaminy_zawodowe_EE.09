<?php
$numer = $_POST['numer'];
$r1 = $_POST['r1'];
$r2 = $_POST['r2'];
$r3 = $_POST['r3'];

$mysqli = mysqli_connect("127.0.0.1", "root", "", "ee09");

$sql = "INSERT INTO `ratownicy`(`nrKaretki`, `ratownik1`, `ratownik2`, `ratownik3`) VALUES ($numer, '$r1', '$r2', '$r3');";
$query = mysqli_query($mysqli, $sql);
echo "Do bazy zostało wysłane zapytanie: $sql";

mysqli_close($mysqli);

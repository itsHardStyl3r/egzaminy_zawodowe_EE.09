<?php
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$adres = $_POST['adres'];

$mysqli = mysqli_connect("127.0.0.1", "root", "", "wedkowanie");
mysqli_query($mysqli, "INSERT INTO `karty_wedkarskie`(`imie`, `nazwisko`, `adres`, `data_zezwolenia`, `punkty`) VALUES($imie, $nazwisko, $adres, NULL, NULL);");

$mysqli->close();

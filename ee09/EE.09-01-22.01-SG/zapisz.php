<?php
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$adres = $_POST['adres'];

$mysqli = new mysqli("127.0.0.1", "root", "", "wedkowanie");

$query = $mysqli->prepare("INSERT INTO `karty_wedkarskie`(`imie`, `nazwisko`, `adres`, `data_zezwolenia`, `punkty`) VALUES(?, ?, ?, NULL, NULL);");
$query->bind_param("sss", $imie, $nazwisko, $adres);
$query->execute();

$query->close();
$mysqli->close();

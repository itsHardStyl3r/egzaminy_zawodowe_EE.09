<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Port Lotniczy</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "", "egzamin");
?>
<body>
<div class="flex">
    <div class="baner1">
        <img src="zad5.png" alt="logo lotnisko">
    </div>
    <div class="baner2">
        <h1>Przyloty</h1>
    </div>
    <div class="baner3">
        <h3>Przydatne linki</h3>
        <a href="kwerendy.txt" target="_blank">Pobierz...</a>
    </div>
</div>
<div class="glowny">
    <table>
        <tr>
            <th>czas</th>
            <th>kierunek</th>
            <th>numer rejsu</th>
            <th>status</th>
        </tr>
        <?php
        $query = mysqli_query($mysqli, "SELECT `czas`, `kierunek`, `nr_rejsu`, `status_lotu` FROM `przyloty` ORDER BY `czas` ASC;");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $row['czas'] . "</td>";
            echo "<td>" . $row['kierunek'] . "</td>";
            echo "<td>" . $row['nr_rejsu'] . "</td>";
            echo "<td>" . $row['status_lotu'] . "</td>";
            echo "</tr>";
        }
        mysqli_close($mysqli);
        ?>
    </table>
</div>
<div class="flex">
    <div class="stopka1">
        <?php
        if (isset($_COOKIE["wizyta"])) {
            echo "<p><i>Witaj ponownie na stronie lotniska</i></p>";
        } else {
            setcookie("wizyta", "wizyta", time() + (60 * 60 * 2));
            echo "<p><b>Dzień dobry! Strona lotniska używa ciasteczek</b></p>";
        }
        ?>
    </div>
    <div class="stopka2">
        Autor: <a href="https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09" target="_blank">itsHardStyl3r</a>
    </div>
</div>
</body>
</html>
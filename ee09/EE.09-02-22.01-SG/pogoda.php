<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Prognoza pogody Wrocław</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
<div class="banerlewy">
    <img src="logo.png" alt="meteo">
</div>
<div class="banersrodkowy">
    <h1>Prognoza dla Wrocławia</h1>
</div>
<div class="banerprawy">
    <p>maj, 2019 r.</p>
</div>
<div class="glowny">
    <table>
        <tr>
            <th>DATA</th>
            <th>TEMPERATURA W NOCY</th>
            <th>TEMPERATURA W DZIEŃ</th>
            <th>OPADY [mm/h]</th>
            <th>CIŚNIENIE [hPa]</th>
        </tr>
        <?php
        $mysqli = new mysqli("127.0.0.1", "root", "", "prognoza");
        $query = $mysqli->query("SELECT * FROM `pogoda` WHERE `miasta_id`=1 ORDER BY `data_prognozy` ASC;");
        while($row = $query->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['data_prognozy'] . "</td>";
            echo "<td>" . $row['temperatura_noc'] . "</td>";
            echo "<td>" . $row['temperatura_dzien'] . "</td>";
            echo "<td>" . $row['opady'] . "</td>";
            echo "<td>" . $row['cisnienie'] . "</td>";
        }
        $mysqli->close();
        ?>
    </table>
</div>
<div class="lewy">
    <img src="obraz.jpg" alt="Polska, Wrocław">
</div>
<div class="prawy">
    <a href="kwerendy.txt">Pobierz kwerendy</a>
</div>
<div class="stopka">
    <p>Stronę wykonał: <a href="https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09"
                          target="_blank">itsHardStyl3r</a></p>
</div>
</body>
</html>
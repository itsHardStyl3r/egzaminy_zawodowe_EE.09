<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Twoje BMI</title>
    <link rel="stylesheet" href="styl3-simplified.css">
</head>
<?php
$mysqli = mysqli_connect("127.0.0.1", "root", "", "egzamin");
?>
<body>
<div class="flex">
    <div class="logo">
        <img src="wzor.png" alt="wzór BMI">
    </div>
    <div class="baner">
        <h1>Oblicz swoje BMI</h1>
    </div>
</div>
<div class="glowny">
    <table>
        <tr>
            <th>Interpretacja BMI</th>
            <th>Wartość minimalna</th>
            <th>Wartość maksymalna</th>
        </tr>
        <?php
        $query = mysqli_query($mysqli, "SELECT `informacja`, `wart_min`, `wart_max` FROM `bmi`;");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $row["informacja"] . "</td>";
            echo "<td>" . $row["wart_min"] . "</td>";
            echo "<td>" . $row["wart_max"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<div class="flex">
    <div class="lewy">
        <h2>Podaj wagę i wzrost</h2>
        <form method="POST">
            <label>Waga: <input type="number" id="waga" name="waga"></label><br>
            <label>Wzrost w cm: <input type="number" id="wzrost" name="wzrost"></label><br>
            <input type="submit" id="submit" name="submit" value="Oblicz i zapamiętaj wynik">
        </form>
        <?php
        if (!empty($_POST['waga']) && !empty($_POST['wzrost'])) {
            $waga = $_POST['waga'];
            $wzrost = $_POST['wzrost'];
            $bmi = ($waga / pow($wzrost, 2)) * 10000;
            echo "Twoja waga: $waga; Twój wzrost: $wzrost<br>BMI wynosi: $bmi";

            $bmi_id = 0;
            if ($bmi <= 18) $bmi_id = 1;
            else if ($bmi <= 25) $bmi_id = 2;
            else if ($bmi <= 30) $bmi_id = 3;
            else $bmi_id = 4;
            mysqli_query($mysqli, "INSERT INTO `wynik` (`bmi_id`, `data_pomiaru`, `wynik`) VALUES (" . $bmi_id . ", '" . date("Y-m-d") . "', " . $bmi . ");");
        }
        ?>
    </div>
    <div class="prawy">
        <img src="rys1.png" alt="ćwiczenia">
    </div>
</div>
<div class="stopka">
    Autor: 00000000000
    <a href="kwerendy.txt">Zobacz kwerendy</a>
</div>
</body>
</html>
<?php
mysqli_close($mysqli);
?>
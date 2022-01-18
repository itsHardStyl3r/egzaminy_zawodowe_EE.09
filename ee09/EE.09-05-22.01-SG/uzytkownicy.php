<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Portal społecznościowy</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<body>
<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "portal");
?>
<div class="banerlewy">
    <h2>Nasze osiedle</h2>
</div>
<div class="banerprawy">
    <?php
    echo "Liczba użytkowników portalu: " . $mysqli->query("SELECT COUNT(*) FROM `dane`;")->fetch_row()[0];
    ?>
</div>
<div class="lewy">
    <h3>Logowanie</h3>
    <form method="POST">
        <label>login<br><input type="text" id="login" name="login"></label><br>
        <label>haslo<br><input type="password" id="haslo" name="haslo"></label><br>
        <input type="submit" value="Zaloguj" id="submit" name="submit">
    </form>
</div>
<div class="prawy">
    <h3>Wizytówka</h3>
    <?php
    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        $message = "";

        if (!(empty($login) || empty($haslo))) {
            $query = $mysqli->prepare("SELECT `haslo` FROM `uzytkownicy` WHERE `login`=?;");
            $query->bind_param("s", $login);
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows != 1) $message = "login nie istnieje";
            if (empty($message)) {
                $password = sha1($haslo);
                $sqlhaslo = $result->fetch_assoc()['haslo'];
                if ($password == $sqlhaslo) {
                    $query = $mysqli->prepare("SELECT `uzytkownicy`.`login`, `dane`.`rok_urodz`, `dane`.`przyjaciol`, `dane`.`hobby`, `dane`.`zdjecie` FROM `uzytkownicy` INNER JOIN `dane` ON `uzytkownicy`.`id`=`dane`.`id` WHERE `login`=?;");
                    $query->bind_param("s", $login);
                    $query->execute();
                    $result = $query->get_result()->fetch_assoc();
                    $year = +date("Y");
                    echo "<div class='wizytowka'>";
                    echo "<img src='" . $result['zdjecie'] . "' alt='osoba'>";
                    echo "<h4>" . $login . " (" . ($year - +$result['rok_urodz']) . ")</h4>";
                    echo "<p>hobby: " . $result['hobby'] . "</p>";
                    echo "<h1><img src='icon-on.png'> " . $result['przyjaciol'] . "</h1>";
                    echo "<a href='dane.html'><button>Więcej informacji</button></a>";
                    echo "</div>";
                } else {
                    $message = "hasło nieprawidłowe";
                }
            }
            $query->close();
            echo $message;
        }
    }
    ?>
</div>
<div class="stopka">
    Stronę wykonał: <a href="https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09" target="_blank">itsHardStyl3r</a>
</div>
<?php
$mysqli->close();
?>
</body>
</html>
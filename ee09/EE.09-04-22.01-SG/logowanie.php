<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl4.css">
</head>
<body>
<div class="baner">
    <h1>Forum wielbicieli psów</h1>
</div>
<div class="lewy">
    <img src="obraz.jpg" alt="foksterier">
</div>
<div class="prawy1">
    <h2>Zapisz się</h2>
    <form method="POST">
        <label>login: <input type="text" id="login" name="login"></label><br>
        <label>hasło: <input type="text" id="haslo" name="haslo"></label><br>
        <label>powtórz hasło: <input type="text" id="phaslo" name="phaslo"></label><br>
        <input type="submit" value="Zapisz" id="submit" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        $phaslo = $_POST['phaslo'];
        $message = "";

        if (empty($login) || empty($haslo) || empty($phaslo)) {
            $message = "wypełnij wszystkie pola";
        } else if ($haslo != $phaslo) {
            $message = "hasła nie są takie same, konto nie zostało dodane";
        } else {
            $mysqli = new mysqli("127.0.0.1", "root", "", "psy");
            $query = $mysqli->query("SELECT `login` FROM `uzytkownicy`;");
            while ($row = $query->fetch_assoc()) {
                if ($row['login'] == $login) {
                    $message = "login występuje w bazie danych, konto nie zostało dodane";
                    break;
                }
            }
            $query->close();
            if (empty($message)) {
                $password = sha1($haslo);
                $query = $mysqli->prepare("INSERT INTO `uzytkownicy`(`login`, `haslo`) VALUES (?, ?);");
                $query->bind_param("ss", $login, $password);
                $query->execute();
                $message = "Konto zostało dodane";
                $query->close();
            }
            $mysqli->close();
        }
        echo "<p>$message</p>";
    }
    ?>
</div>
<div class="prawy2">
    <h2>Zapraszamy wszystkich</h2>
    <ol>
        <li>właścicieli psów</li>
        <li>weterynarzy</li>
        <li>tych, co chcą kupić psa</li>
        <li>tych, co lubią psy</li>
    </ol>
    <a href="regulamin.html">Przeczytaj regulamin forum</a>
</div>
<div class="stopka">
    Stronę wykonał: <a href="https://github.com/itsHardStyl3r/egzaminy_zawodowe_EE.09" target="_blank">itsHardStyl3r</a>
</div>
</body>
</html>

<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'school';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['naam'];
    $klas = $_POST['klas'];


    if (empty($naam) || empty($klas)) {
        echo "<p style='color: red;'>naam en klas zijn verplicht!</p>";
    } else {

        $sql = "SELECT * FROM school WHERE leerling = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $naam);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p style='color: red;'>Deze leerling bestaat al!</p>";
        } else {
            // Voeg de film toe aan de database
            $sql = "INSERT INTO leerling (naam, klas) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $naam, $klas);

            if ($stmt->execute()) {
                echo "<p>Leerling toegevoegd: " . $naam . " | klas: " . $klas . "</p>";
            } else {
                echo "<p style='color: red;'>Er is een fout opgetreden bij het toevoegen van de leerling: " . $stmt->error . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leerling Toevoegen</title>
</head>
<body>

<h1>invoeren van een nieuwe leerling</h1>

<form method="POST" action="insert.php">
    <label>Naam:</label><br>
    <input type="text" name="titel" required><br><br>

    <label>Klas:</label><br>
    <input type="text" name="genre" required><br><br>

    <input type="submit" value="Toevoegen">
</form>

<a href="index.php">Terug naar overzicht</a>

</body>
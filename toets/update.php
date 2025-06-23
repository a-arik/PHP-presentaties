<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'school';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $leerling_id = $_GET['id'];

    // Haal de huidige gegevens van de film op
    $sql = "SELECT * FROM film WHERE id = $leerling_id";
    $result = $conn->query($sql);
    $leerling = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leerling = $_POST['leerling'];
    $klas = $_POST['klas'];

    // Update de film
    $update_sql = "UPDATE school SET name = ?, klas = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssi", $leerling, $klas, $leerling_id);

    if ($stmt->execute()) {
        echo "<p>Film bijgewerkt: " . $leerling . " | Genre: " . $klas . "</p>";
    } else {
        echo "<p style='color: red;'>Er is een fout opgetreden bij het bijwerken van de film: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leerling Bewerken</title>
</head>
<body>

<h1>leerling Bewerken</h1>

<form method="POST" action="toets/update.php?id=<?php echo $leerling['id']; ?>">
    <label>naam:</label><br>
    <input type="text" name="titel" value="<?php echo $leerling['titel']; ?>" required><br><br>

    <label>klas:</label><br>
    <input type="text" name="genre" value="<?php echo $leerling['genre']; ?>" required><br><br>

    <input type="submit" value="Bewerken">
</form>

<a href="index.php">Terug naar overzicht</a>

</body>
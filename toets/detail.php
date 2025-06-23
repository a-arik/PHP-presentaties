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


    $leerling_sql = "SELECT * FROM film WHERE id = $leerling_id";
    $leerling_result = $conn->query($leerling_sql);
    $leerling = $leerling_result->fetch_assoc();


    $cijfer_sql = "SELECT * FROM beoordeling WHERE leerling_id = $leerling_id";
    $cijfer_result = $conn->query($cijfer_sql);


    $avg_cijfer_sql = "SELECT AVG(cijfer) AS avg_rating FROM beoordeling WHERE leerling_id = $leerling_id";
    $avg_cijfer_result = $conn->query($avg_cijfer_sql);
    $avg_cijfer = $avg_cijfer_result->fetch_assoc()['avg_rating'] ?? 'Geen beoordelingen';
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Beoordelingen</title>
</head>
<body>

<h1>Beoordelingen voor: <?php echo $leerling['naam']; ?> (<?php echo $leerling['klas']; ?>)</h1>


<p><strong>Gemiddeld cijfer: </strong><?php echo number_format($avg_cijfer, 1); ?></p>


<h2>Beoordelingen</h2>
<table border="1">
    <thead>
    <tr>
        <th>Cijfer</th>
        <th>Opmerking</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($cijfer_result->num_rows > 0) {
        while ($row = $cijfer_result->fetch_assoc()) {
            echo "<tr>
                        <td>" . $row['cijfer'] . "</td>
                        <td>" . $row['opmerking'] . "</td>
                    </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Geen beoordelingen beschikbaar</td></tr>";
    }
    ?>
    </tbody>
</table>


<a href="index.php">Terug naar overzicht</a>

</body>
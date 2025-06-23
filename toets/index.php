<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'school';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}


$sql = "SELECT * FROM leerling";
$result = $conn->query($sql);
?>

<td>
    <a href='detail.php?id=$leerling_id'>Bekijk Beoordelingen</a> |
    <a href='update.php?id=$leerling_id'>Bewerken</a> |
    <a href='delete.php?id=$leerling_id'>Verwijderen</a>
</td>
</tr>";
}
} else {
echo "<tr><td colspan='5'>Geen leerlingen gevonden</td></tr>";
}
?>
<a href="detail.php">Details</a>
</tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>

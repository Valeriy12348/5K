<?php
$conn = new mysqli("localhost", "root", "", "warsztaty");
if ($conn->connect_error) {
    die("Błąd połączenia z bazą: " . $conn->connect_error);
}
?>

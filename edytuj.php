<?php
include 'config.php';

$id = $_GET['id'];


if (isset($_POST['aktualizuj'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];

    $stmt = $conn->prepare("UPDATE uczestnicy SET imie=?, nazwisko=?, email=?, telefon=? WHERE id=?");
    $stmt->bind_param("ssssi", $imie, $nazwisko, $email, $telefon, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}


$stmt = $conn->prepare("SELECT * FROM uczestnicy WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$uczestnik = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj uczestnika</title>
</head>
<body>
    <h2>Edytuj uczestnika</h2>
    <form method="post" action="">
        Imię: <input type="text" name="imie" value="<?= $uczestnik['imie'] ?>" required><br><br>
        Nazwisko: <input type="text" name="nazwisko" value="<?= $uczestnik['nazwisko'] ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= $uczestnik['email'] ?>" required><br><br>
        Telefon: <input type="text" name="telefon" value="<?= $uczestnik['telefon'] ?>"><br><br>
        <input type="submit" name="aktualizuj" value="Zapisz zmiany">
    </form>
    <a href="index.php">Powrót do listy</a>
</body>
</html>

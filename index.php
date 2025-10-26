<?php
include 'config.php';

// Dodawanie uczestnika
if (isset($_POST['dodaj'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];

    $stmt = $conn->prepare("INSERT INTO uczestnicy (imie, nazwisko, email, telefon) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $imie, $nazwisko, $email, $telefon);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// Usuwanie uczestnika
if (isset($_GET['usun'])) {
    $id = $_GET['usun'];
    $stmt = $conn->prepare("DELETE FROM uczestnicy WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// Pobieranie listy uczestników
$result = $conn->query("SELECT * FROM uczestnicy");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja uczestników warsztatów</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Dodaj nowego uczestnika</h2>
    <form method="post" action="">
        Imię: <input type="text" name="imie" required><br><br>
        Nazwisko: <input type="text" name="nazwisko" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Telefon: <input type="text" name="telefon"><br><br>
        <input type="submit" name="dodaj" value="Dodaj uczestnika">
    </form>

    <h2>Lista uczestników</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Data dodania</th>
            <th>Akcje</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['imie'] ?></td>
            <td><?= $row['nazwisko'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['telefon'] ?></td>
            <td><?= $row['data_dodania'] ?></td>
            <td>
                <a href="index.php?usun=<?= $row['id'] ?>" onclick="return confirm('Czy na pewno usunąć?')">Usuń</a>
                | <a href="edytuj.php?id=<?= $row['id'] ?>">Edytuj</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

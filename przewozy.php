<?php

header('Content-Type: text/html; charset=utf-8');


$mysqli = new mysqli('localhost', 'root', '', 'przewozy');
if ($mysqli->connect_errno) {
    die('Błąd połączenia z bazą: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');


if (isset($_GET['usun'])) {
    $id = intval($_GET['usun']);
    if ($id > 0) {
        $stmt = $mysqli->prepare("DELETE FROM zadania WHERE id_zadania = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: przewozy.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $zadanie = trim($_POST['zadanie']);
    $data = trim($_POST['data']);
    if (!empty($zadanie)) {
        $osoba_id = 1;
        $stmt = $mysqli->prepare("INSERT INTO zadania (zadanie, data, osoba_id) VALUES (?, ?, ?)");
        $stmt->bind_param('ssi', $zadanie, $data, $osoba_id);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: przewozy.php');
    exit;
}


$result = $mysqli->query("SELECT id_zadania, zadanie, data FROM zadania ORDER BY id_zadania");
?>
<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Firma Przewozowa</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
  <div class="container">Firma przewozowa Półdarmo</div>
</header>

<nav>
  <div class="container">
    <a href="#">kwerenda1</a>
    <a href="#">kwerenda2</a>
    <a href="#">kwerenda3</a>
    <a href="#">kwerenda4</a>
  </div>
</nav>

<main class="container">
  <section class="left">
    <h2>Zadania do wykonania</h2>

    <table>
      <thead>
        <tr><th>Zadanie do wykonania</th><th>Data realizacji</th><th>Akcja</th></tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['zadanie'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?php echo htmlspecialchars($row['data'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><a href="przewozy.php?usun=<?php echo (int)$row['id_zadania']; ?>">Usuń</a></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <form class="task-form" action="przewozy.php" method="post">
      <label for="zadanie">Zadanie do wykonania: </label>
      <input type="text" id="zadanie" name="zadanie" required size="40">
      <br>
      <label for="data">Data realizacji: </label>
      <input type="date" id="data" name="data">
      <button type="submit">Dodaj</button>
    </form>
  </section>

  <aside class="right">
    <img src="auto.png" alt="auto firmowe" style="max-width:100%; height:auto; background: transparent;">
    <h3>Nasza specjalność</h3>
    <ul>
      <li>Przeprowadzki</li>
      <li>Przewóz mebli</li>
      <li>Przesyłki gabarytowe</li>
      <li>Wynajem pojazdów</li>
      <li>Zakupy towarów</li>
    </ul>
  </aside>
</main>

<footer>
  <div class="container">Stronę wykonał: 06322210275</div>
</footer>

</body>
</html>
<?php
$result->free();
$mysqli->close();
?>

<html>
<head>
    <title>Odzyt z bazy dannych</title>
</head>
<body>
<?php
if(!$bd_lnk = mysqli_connect(hostname:"lacalhost", username:"user", password:"pass")){
	echo("Wystapil blad");
	exit();
} else {
	echo "Polaczenie zostalo nawiazane";
}

if (!mysqli_select_db($bd_lnk, database:"nazwa-bazy")){
	echo "Blad";
	exit();
} else {
	"Zostala wybrana baza danych: nazwa_bazy <br>";
}
$query = "SELECT * FROM osoba";
if (!$result = mysqli_query($bd_lnk, $query)){
	mysqli_close($bd_lnk);
	echo "Blad";
    exit();
}
?>
<table>
	<tr>
		<td>Id</td>
		<td>Imie</td>
		<td>Nazwisko</td>
		<td>Rok urodzenia</td>
		<td>Miejsce urodzenia</td>
    </tr>
<?php
while ($row = mysqli_fetch_row($result)){
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "</tr>"
}
?>
</table>
<?php
if(!mysqli_close($db_lnk)){
	echo "Blad zamykania";
} else {
	echo "Polaczenie zostale zamkiete";
}
?>
</body>
</html>
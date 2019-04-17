<html>
	<head>
	<title>Tabela</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="script.js"></script>
	</head>
	<body>

<?php
$servername = "localhost";
$username = "Admin";
$password = "";
$dbname = "Baza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Połączenie nieudane: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
$return_arr = array();
$fetch = $conn->query("SELECT ID, Pracownicy FROM pc"); 
while ($row = $fetch->fetch_row()) {
	$row_array['id'] = $row[0];
	$row_array['pc'] = $row[1];

    array_push($return_arr,$row_array); } ?>

<script>
var arr = <?php echo json_encode($return_arr) ?>;
</script> 

<div class="Table"></div>
    <div class="Row">
        <div class="Cell" id="Cell-1">
			<p>Nazwa produktu typu</p>
		</div>
		<div class="Cell" id="Cell-2">
			<p> <?php
			$npt = $conn->query("SELECT NPT FROM npt WHERE ID = 1")->fetch_object()->NPT;
			echo $npt; ?> </p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Identyfikator produktu</p>
		</div>
	</div>
	<div class="Row">
        <div class="Cell" id="Cell-1">
			<p>Według rysunku</p>
		</div>
		<div class="Cell" id="Cell-2">
		<p> <?php
			$rys = $conn->query("SELECT Rysunek FROM npt WHERE ID = 1")->fetch_object()->Rysunek;
			echo $rys; ?> </p>
		</div>
		<?php $id = $conn->query("SELECT Identyfikator FROM npt WHERE ID = 1")->fetch_object()->Identyfikator; ?>
		<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Identyfikator', 1, 'npt', 'text')">
			<p><?php if(empty($id)) echo ""; else echo htmlspecialchars("$id") ?></p>
		</div>
	</div>
	<div class="Row">
        <div class="Cell" id="Cell-1">
			<p>POBRANIE MAGAZYNOWE</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-1">
			<p>Nazwa materiału</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Ilość (mm)</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Gatunek</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Numer wytopu</p>
		</div>
	</div>
		<?php
			$result = $conn->query("SELECT Nazwa, Ilosc, Gatunek, Numer FROM pm LIMIT 3");
			while($row=$result->fetch_row())
			{
				echo '<div class="Row">';
				foreach($row as $key=>$value) {
					echo '<div class="Cell" id="Cell-2"><p>',$value,'</p></div>';
				}
				echo '</div>';
			} ?>
	<div class="Row">
		<div class="DoubleCell" id="Cell-1">
			<p>Nazwa materiału</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Gatunek</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Numer wytopu</p>
		</div>
	</div>
	<?php
			$result = $conn->query("SELECT Nazwa, Gatunek, Numer FROM pm LIMIT 3, 2");
			while($row=$result->fetch_row())
			{
				echo '<div class="Row">';
				echo '<div class="DoubleCell" id="Cell-2"><p>',$row[0],'</p></div>';
				echo '<div class="Cell" id="Cell-2"><p>',$row[1],'</p></div>';
				echo '<div class="Cell" id="Cell-2"><p>',$row[2],'</p></div>';
				echo '</div>';
			} ?>
	<div class="Row">
		<div class="Cell" id="Cell-1">
			<p>Data</p>
		</div>
		<?php $dt5 = $conn->query("SELECT Data FROM npt WHERE ID = 1")->fetch_object()->Data; ?>
		<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 1, 'npt', 'date')">
			<p><?php if(empty($dt5)) echo ""; else echo htmlspecialchars("$dt5") ?></p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Wydanie magazynowe</p>
		</div>
        <?php $pc5 = $conn->query("SELECT pc.Pracownicy AS Imie FROM npt JOIN pc ON pc.ID = npt.Imie WHERE npt.ID = 1")->fetch_object()->Imie; ?>
        <div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 1, 'npt')">
       		<p><?php if(empty($pc5)) echo ""; else echo htmlspecialchars($pc5) ?></p>
        </div>
	</div>
	<div class="Row">
        <div class="Cell" id="Cell-1">
			<p>KARTA PRODUKCJI</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-1">
			<p>Proces produkcji</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Wymagane</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Data wykonania</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Wykonane przez</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Uwagi</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
			<p> <?php
			$prc1 = $conn->query("SELECT Proces FROM kp WHERE ID = 1")->fetch_object()->Proces;
			echo $prc1; ?> </p>
		</div>
		<div class="Cell" id="Cell-2">
			<p> <?php
			$wym1 = $conn->query("SELECT Wymagane FROM kp WHERE ID = 1")->fetch_object()->Wymagane;
			echo $wym1; ?> </p>
		</div>
			<?php $dt1 = $conn->query("SELECT Data FROM kp WHERE ID = 1")->fetch_object()->Data; ?>
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 1, 'kp', 'date')">
			<p><?php if(empty($dt1)) echo ""; else echo htmlspecialchars("$dt1") ?></p>
		</div>
        <?php $pc1 = $conn->query("SELECT pc.Pracownicy AS Imie FROM kp JOIN pc ON pc.ID = kp.Imie WHERE kp.ID = 1")->fetch_object()->Imie; ?>
        <div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 1, 'kp')">
       		<p><?php if(empty($pc1)) echo ""; else echo htmlspecialchars($pc1) ?></p>
		</div>
			<?php $uw1 = $conn->query("SELECT Uwagi FROM kp WHERE ID = 1")->fetch_object()->Uwagi; ?>
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Uwagi', 1, 'kp', 'text')">
			<p><?php if(empty($uw1)) echo ""; else echo htmlspecialchars("$uw1") ?></p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
			<p> <?php
			$prc2 = $conn->query("SELECT Proces FROM kp WHERE ID = 2")->fetch_object()->Proces;
			echo $prc2; ?> </p>
		</div>
		<div class="Cell" id="Cell-2">
			<p> <?php
			$wym2 = $conn->query("SELECT Wymagane FROM kp WHERE ID = 2")->fetch_object()->Wymagane;
			echo $wym2; ?> </p>
		</div>
			<?php $dt2 = $conn->query("SELECT Data FROM kp WHERE ID = 2")->fetch_object()->Data; ?>
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 2, 'kp', 'date')">
			<p><?php if(empty($dt2)) echo ""; else echo htmlspecialchars("$dt2") ?></p>
		</div>
        <?php $pc2 = $conn->query("SELECT pc.Pracownicy AS Imie FROM kp JOIN pc ON pc.ID = kp.Imie WHERE kp.ID = 2")->fetch_object()->Imie; ?>
        <div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 2, 'kp')">
       		<p><?php if(empty($pc2)) echo ""; else echo htmlspecialchars($pc2) ?></p>
		</div>
			<?php $uw2 = $conn->query("SELECT Uwagi FROM kp WHERE ID = 2")->fetch_object()->Uwagi; ?>	
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Uwagi', 2, 'kp', 'text')">
			<p><?php if(empty($uw2)) echo ""; else echo htmlspecialchars("$uw2") ?></p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
			<p> <?php
			$prc3 = $conn->query("SELECT Proces FROM kp WHERE ID = 3")->fetch_object()->Proces;
			echo $prc3; ?> </p>
		</div>
		<div class="Cell" id="Cell-2">
			<p> <?php
			$wym3 = $conn->query("SELECT Wymagane FROM kp WHERE ID = 3")->fetch_object()->Wymagane;
			echo $wym3; ?> </p>
		</div>
			<?php $dt3 = $conn->query("SELECT Data FROM kp WHERE ID = 3")->fetch_object()->Data; ?>
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 3, 'kp', 'date')">
			<p><?php if(empty($dt3)) echo ""; else echo htmlspecialchars("$dt3") ?></p>
		</div>
        <?php $pc3 = $conn->query("SELECT pc.Pracownicy AS Imie FROM kp JOIN pc ON pc.ID = kp.Imie WHERE kp.ID = 3")->fetch_object()->Imie; ?>
        <div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 3, 'kp')">
       		<p><?php if(empty($pc3)) echo ""; else echo htmlspecialchars($pc3) ?></p>
		</div>
			<?php $uw3 = $conn->query("SELECT Uwagi FROM kp WHERE ID = 3")->fetch_object()->Uwagi; ?>	
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Uwagi', 3, 'kp', 'text')">
			<p><?php if(empty($uw3)) echo ""; else echo htmlspecialchars("$uw3") ?></p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
			<p> <?php
			$prc4 = $conn->query("SELECT Proces FROM kp WHERE ID = 4")->fetch_object()->Proces;
			echo $prc4; ?> </p>
		</div>
		<div class="Cell" id="Cell-2">
			<p> <?php
			$wym4 = $conn->query("SELECT Wymagane FROM kp WHERE ID = 4")->fetch_object()->Wymagane;
			echo $wym4; ?> </p>
		</div>
			<?php $dt4 = $conn->query("SELECT Data FROM kp WHERE ID = 4")->fetch_object()->Data; ?>
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 4, 'kp', 'date')">
			<p><?php if(empty($dt4)) echo ""; else echo htmlspecialchars("$dt4") ?></p>
		</div>
        <?php $pc4 = $conn->query("SELECT pc.Pracownicy AS Imie FROM kp JOIN pc ON pc.ID = kp.Imie WHERE kp.ID = 4")->fetch_object()->Imie; ?>
        <div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 4, 'kp')">
       		<p><?php if(empty($pc4)) echo ""; else echo htmlspecialchars($pc4) ?></p>
		</div>
			<?php $uw4 = $conn->query("SELECT Uwagi FROM kp WHERE ID = 4")->fetch_object()->Uwagi; ?>	
			<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Uwagi', 4, 'kp', 'text')">
			<p><?php if(empty($uw4)) echo ""; else echo htmlspecialchars("$uw4") ?></p>
		</div>
	</div>
	<div class="Row">
        <div class="Cell" id="Cell-1">
			<p>KARTA KONTROLI</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-1">
			<p>Pomiar</p>
		</div>
		<div class="Cell" id="Cell-1">
		<p>Data</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Przeprowadził</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
		<p> <?php
			$pom1 = $conn->query("SELECT Pomiar FROM kk WHERE ID = 1")->fetch_object()->Pomiar;
			echo $pom1; ?> </p>
		</div>
		<?php $dt6 = $conn->query("SELECT Data FROM kk WHERE ID = 1")->fetch_object()->Data; ?>
		<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 1, 'kk', 'date')">
			<p><?php if(empty($dt6)) echo ""; else echo htmlspecialchars("$dt6") ?></p>
		</div>
		<?php $pc6 = $conn->query("SELECT pc.Pracownicy AS Imie FROM kk JOIN pc ON pc.ID = kk.Imie WHERE kk.ID = 1")->fetch_object()->Imie; ?>
        <div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 1, 'kk')">
       		<p><?php if(empty($pc6)) echo ""; else echo htmlspecialchars($pc6) ?></p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-1">
			<p>Badanie wizualne</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Data</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Przeprowadził</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
		<p> <?php
			$pom2 = $conn->query("SELECT Pomiar FROM kk WHERE ID = 2")->fetch_object()->Pomiar;
			echo $pom2; ?> </p>
		</div>
		<?php $dt7 = $conn->query("SELECT Data FROM kk WHERE ID = 2")->fetch_object()->Data; ?>
		<div class="Cell" id="Cell-3" ondblclick="startEditInput(this, 'Data', 2, 'kk', 'date')">
		<p><?php if(empty($dt7)) echo ""; else echo htmlspecialchars("$dt7") ?></p>
		</div>
		<?php $pc7 = $conn->query("SELECT pc.Pracownicy AS Imie FROM kk JOIN pc ON pc.ID = kk.Imie WHERE kk.ID = 2")->fetch_object()->Imie; ?>
		<div class="Cell" id="Cell-3" ondblclick="startEditSelect(this, 'Imie', 2, 'kk')">
       		<p><?php if(empty($pc7)) echo ""; else echo htmlspecialchars($pc7) ?></p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-1">
			<p>Badanie penetracyjne</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Data</p>
		</div>
		<div class="Cell" id="Cell-1">
			<p>Przeprowadził</p>
		</div>
	</div>
	<div class="Row">
		<div class="Cell" id="Cell-2">
		<p> <?php
			$uw = $conn->query("SELECT Pomiar FROM kk WHERE ID = 3")->fetch_object()->Pomiar;
			echo $uw; ?> </p>
		</div>
		<div class="Cell" id="Cell-2">
		<p> <?php
			echo $uw; ?> </p>
		</div>
		<div class="Cell" id="Cell-2">
		<p> <?php
			echo $uw; ?> </p>
		</div>
	</div>
</div>

	</body>
</html>
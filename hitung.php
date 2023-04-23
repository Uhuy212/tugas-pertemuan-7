<!DOCTYPE html>
<html>
<head>
	<title>Aplikasi Kasir Makanan Ringan</title>
</head>
<body>
	<center> <h1>TOKO AHMAD</h1></center>
    <h3>Input Barang</h3>
	<form method="post" action="proses.php">
		<label for="nama">Nama Barang:</label>
		<input type="text" id="nama" name="nama" required><br><br>
		<label for="harga">Harga Satuan:</label>
		<input type="number" id="harga" name="harga" required min="0"><br><br>
		<label for="jumlah">Jumlah Barang:</label>
		<input type="number" id="jumlah" name="jumlah" required min="1"><br><br>
		<label for="pembayaran">Uang Masuk:</label>
		<input type="number" id="pembayaran" name="pembayaran" required min="0"><br><br>
		<label for="diskon">Diskon:</label>
		<input type="number" id="diskon" name="diskon" required min="0" max="100"><br><br>
		<input type="submit" value="Submit">
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$nama = htmlspecialchars($_POST["nama"]);
			$harga = $_POST["harga"];
			$jumlah = $_POST["jumlah"];
			$pembayaran = $_POST["pembayaran"];
			$diskon = $_POST["diskon"];

			$total = $harga * $jumlah;
			
			// diskon
			$nilai_diskon = $diskon / 100 * $total;
			$total -= $nilai_diskon;
			
			// bonus pembelian
			if ($jumlah % 5 == 0) {
				$bonus = floor($jumlah / 5);
				echo "<p>Bonus pembelian: $bonus barang</p>";
				$total_barang = $jumlah + $bonus;
				$total_harga = $total_barang * $harga;
				echo "<p>Total barang: $total_barang</p>";
				echo "<p>Total harga: $total_harga</p>";
			} else {
				echo "<p>Total barang: $jumlah</p>";
				echo "<p>Total harga: $total</p>";
			}
			
			// pembayaran dan kembalian
			if ($pembayaran >= $total) {
				$kembalian = $pembayaran - $total;
				echo "<p>Kembalian: $kembalian</p>";
			} else {
				$kurang = $total - $pembayaran;
				echo "<p>Maaf, uang pembayaran kurang sebesar $kurang</p>";
			}
		}
	?>
</body>
</html>

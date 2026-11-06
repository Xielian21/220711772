
<?php

$pesan = [];
$obat = '';
$penyakit = '';
$hargaObat = 0;
$hargaKategori = 0;
$totalBayar = 0;
$diskon = 0;
$totalHarga = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $obat = $_POST['obat'] ?? '';
    $penyakit = $_POST['penyakit'] ?? '';

    if (empty($obat) || empty($penyakit)) {
        $pesan[] = "Harap lengkapi semua data.";
    }

    if (!empty($obat) &&
        !in_array($obat, ['pil', 'tablet', 'sirup'])) {
        $pesan[] = "Pilihan obat tidak valid.";
    }

    if (!empty($penyakit) &&
        !in_array($penyakit, ['demam', 'flu', 'lainnya'])) {
        $pesan[] = "Pilihan penyakit tidak valid.";
    }

    if (empty($pesan)) {

        // Informasi harga obat
        switch ($obat) {
            case 'pil':
                $hargaObat = 30000;
                break;

            case 'tablet':
                $hargaObat = 20000;
                break;

            case 'sirup':
                $hargaObat = 10000;
                break;
        }

        // Informasi harga penyakit
        switch ($penyakit) {
            case 'demam':
                $hargaKategori = 40000;
                break;

            case 'flu':
                $hargaKategori = 30000;
                break;

            case 'lainnya':
                $hargaKategori = 0;
                break;
        }

        // Menghitung total pembayaran
        $totalBayar = $hargaObat + $hargaKategori;

        // Fungsi menentukan diskon
        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 60000) {
                return 0.2;
            } else {
                return 0;
            }
        }

        // Fungsi menghitung total harga
        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($totalBayar * $diskon);
        }

        $diskon = dapatDiskon($totalBayar);

        $totalHarga = totalHarga($diskon, $totalBayar);

    }

} else {
    echo "<p>Silahkan pilih produk yang ingin dibeli.</p>";
}
?>

<h2>Belanja</h2>

<h3>Daftar Stok</h3>

<form action="" method="POST">

    <p>Pilih Obat : <br />
    <select name="obat">
        <option value="">Pilih Obat</option>

        <option value="pil"
        <?php if ($obat == 'pil') echo 'selected'; ?>>
        Pil</option>

        <option value="tablet"
        <?php if ($obat == 'tablet') echo 'selected'; ?>>
        Tablet</option>

        <option value="sirup"
        <?php if ($obat == 'sirup') echo 'selected'; ?>>
        Sirup</option>

    </select>
    </p>

    <p>Pilih Penyakit : <br />
    <select name="penyakit">
        <option value="">Pilih Penyakit</option>

        <option value="demam"
        <?php if ($penyakit == 'demam') echo 'selected'; ?>>
        Demam</option>

        <option value="flu"
        <?php if ($penyakit == 'flu') echo 'selected'; ?>>
        Flu</option>

        <option value="lainnya"
        <?php if ($penyakit == 'lainnya') echo 'selected'; ?>>
        Lainnya</option>

    </select>
    </p>

    <button type="submit">Kirim</button>

</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($pesan)) {

        foreach ($pesan as $msg) {
            echo "<p style='color:red;'>!! "
            . htmlspecialchars($msg) . " !!</p>";
        }

    } elseif ($penyakit == 'lainnya') {

        echo "<p>Maaf, untuk penyakit lainnya silahkan konsultasikan dengan dokter.</p>";

    } else {

        echo "<h2>Informasi Belanja</h2>";

        echo "<p>Penyakit: "
        . htmlspecialchars($penyakit) . "</p>";

        echo "<p>Obat: "
        . htmlspecialchars($obat) . "</p>";

        echo "<p>Total Harga: Rp"
        . number_format($totalHarga, 0, ',', '.') . "</p>";

        echo "<p>Diskon: "
        . htmlspecialchars($diskon * 100) . "%</p>";

        if ($diskon == 0) {

            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";

        } else {

            echo "<p>Selamat! Anda mendapatkan diskon "
            . htmlspecialchars($diskon * 100) . "%.</p>";

        }
    }
}

?>

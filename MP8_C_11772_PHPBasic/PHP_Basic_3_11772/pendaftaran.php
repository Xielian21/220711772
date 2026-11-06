
<?php
$pesan = [];
$nama = '';
$penyakit = '';
$sesi = '';
$tempat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($_POST['nama'] ?? '');
    $penyakit = trim($_POST['penyakit'] ?? '');
    $sesi = $_POST['sesi'] ?? '';

    if (empty($nama) || empty($penyakit) || empty($sesi)) {
        $pesan[] = "Harap lengkapi semua data.";
    }

    if (!empty($nama) && !preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $pesan[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (!empty($sesi) && !in_array($sesi, ['Sesi 1', 'Sesi 2'])) {
        $pesan[] = "Pilihan sesi tidak valid.";
    }

    if ($sesi == 'Sesi 1') {
        $tempat = "Ruang dr. Jung di Lantai 3";
    } elseif ($sesi == 'Sesi 2') {
        $tempat = "Online Meeting (Zoom)";
    }

} else {
    echo "<p>Silahkan lengkapi formulir di atas.</p>";
}
?>

<h2>Pendaftaran Konsultasi</h2>

<form action="" method="POST">

    <p>Nama : <br />
    <input type="text" name="nama"
    value="<?php echo htmlspecialchars($nama); ?>" /></p>

    <p>Penyakit : <br />
    <input type="text" name="penyakit"
    value="<?php echo htmlspecialchars($penyakit); ?>" /></p>

    <p>Sesi Konsultasi : <br />
    <select name="sesi">
        <option value="">Pilih Sesi</option>
        <option value="Sesi 1"
        <?php if ($sesi == 'Sesi 1') echo 'selected'; ?>>
        Sesi 1</option>

        <option value="Sesi 2"
        <?php if ($sesi == 'Sesi 2') echo 'selected'; ?>>
        Sesi 2</option>
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

    } else {

        echo "<h2>Informasi Pendaftaran</h2>";

        echo "<p>Nama: "
        . htmlspecialchars($nama) . "</p>";

        echo "<p>Penyakit: "
        . htmlspecialchars($penyakit) . "</p>";

        echo "<p>Sesi: "
        . htmlspecialchars($sesi) . "</p>";

        echo "<p>Tempat Konsultasi: "
        . htmlspecialchars($tempat) . "</p>";

        echo "<p>Anda mendaftar pada "
        . htmlspecialchars($sesi) . " di "
        . htmlspecialchars($tempat)
        . ". Silahkan hadir tepat waktu.</p>";
    }
}
?>

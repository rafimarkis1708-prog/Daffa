<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// === Simpan data ke tabel nilai ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nim    = $_POST['Nim'];      // gunakan huruf besar sesuai field database
    $kodemk = $_POST['kodemk'];
    $uts    = $_POST['uts'];
    $uas    = $_POST['uas'];

    if ($Nim && $kodemk && $uts !== "" && $uas !== "") {
        $sql = "INSERT INTO nilai (Nim, kodemk, uts, uas) 
                VALUES ('$Nim', '$kodemk', '$uts', '$uas')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Data nilai berhasil disimpan!');
                    window.location='template_dasar_01.php?page=input_nilai';
                  </script>";
        } else {
            echo "<script>alert('Gagal menyimpan data: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Semua field wajib diisi!');</script>";
    }
}

// === Ambil data mahasiswa & matakuliah untuk dropdown ===
$mahasiswa  = $conn->query("SELECT * FROM mahasiswa ORDER BY Nama ASC");
$matakuliah = $conn->query("SELECT * FROM matakuliah ORDER BY namamk ASC");
?>

<h2 style="text-align:center; color:#007bff; margin:30px 0;">INPUT NILAI MAHASISWA</h2>

<div style="
    width:400px;
    margin:auto;
    background:white;
    padding:25px 30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    font-family:'Poppins', Arial, sans-serif;
">
    <form method="POST" action="">
        <label for="Nim" style="font-weight:bold;">NIM</label><br>
        <select name="Nim" id="Nim" required
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin:5px 0 15px;">
            <option value="">-- Pilih Mahasiswa --</option>
            <?php while($row = $mahasiswa->fetch_assoc()): ?>
                <option value="<?php echo $row['Nim']; ?>">
                    <?php echo $row['Nim'] . " - " . $row['Nama']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="kodemk" style="font-weight:bold;">KODE MATA KULIAH</label><br>
        <select name="kodemk" id="kodemk" required
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin:5px 0 15px;">
            <option value="">-- Pilih Mata Kuliah --</option>
            <?php while($mk = $matakuliah->fetch_assoc()): ?>
                <option value="<?php echo $mk['kodemk']; ?>">
                    <?php echo $mk['kodemk'] . " - " . $mk['namamk']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="uts" style="font-weight:bold;">UTS</label><br>
        <input type="number" name="uts" id="uts" required
               style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin:5px 0 15px;">

        <label for="uas" style="font-weight:bold;">UAS</label><br>
        <input type="number" name="uas" id="uas" required
               style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin:5px 0 20px;">

        <button type="submit" style="
            width:100%;
            padding:10px;
            background-color:#198754;
            color:white;
            border:none;
            border-radius:6px;
            font-weight:bold;
            cursor:pointer;
        ">SIMPAN</button>
    </form>
</div>

<?php $conn->close(); ?>

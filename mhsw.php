<?php
// ====== KONEKSI DATABASE ======
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ====== FUNGSI HAPUS DATA ======
if (isset($_GET['hapus'])) {
    $nim = $conn->real_escape_string($_GET['hapus']);
    $sql = "DELETE FROM mahasiswa WHERE Nim='$nim'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='template_dasar_01.php?page=mhsw';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menghapus data: " . $conn->error . "');</script>";
    }
}

// ====== FUNGSI DETAIL DATA ======
if (isset($_GET['detail'])) {
    $nim = $conn->real_escape_string($_GET['detail']);
    $sql = "SELECT * FROM mahasiswa WHERE Nim='$nim'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        ?>
        <h2 style="text-align:center; margin:30px 0; color:#00a3bf;">Detail Mahasiswa</h2>

        <div style="
            width: 50%;
            margin: auto;
            background: #ffffff;
            padding: 25px 40px;
            border: 2px solid #00a3bf;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-family: 'Poppins', Arial, sans-serif;
        ">
            <table style="width:100%; font-size:16px;">
                <tr>
                    <td style="padding:8px 0; font-weight:bold; width:30%;">Nama</td>
                    <td style="padding:8px 0;">: <?php echo htmlspecialchars($data['Nama']); ?></td>
                </tr>
                <tr>
                    <td style="padding:8px 0; font-weight:bold;">NIM</td>
                    <td style="padding:8px 0;">: <?php echo htmlspecialchars($data['Nim']); ?></td>
                </tr>
                <tr>
                    <td style="padding:8px 0; font-weight:bold;">Umur</td>
                    <td style="padding:8px 0;">: <?php echo htmlspecialchars($data['Umur']); ?></td>
                </tr>
            </table>

            <div style="text-align:center; margin-top:25px;">
                <a href="template_dasar_01.php?page=mhsw" 
                   style="background-color:#00a3bf; color:white; padding:10px 20px; 
                          border-radius:6px; text-decoration:none; font-weight:bold;">
                   ← Kembali ke Data Mahasiswa
                </a>
            </div>
        </div>
        <?php
    } else {
        echo "<p style='text-align:center; color:red;'>Data mahasiswa tidak ditemukan!</p>";
    }
} else {
    // ====== TAMPILAN TABEL DATA ======
    $sql = "SELECT * FROM mahasiswa ORDER BY Nim ASC";
    $result = $conn->query($sql);
    ?>
    <h2 style="text-align:center; margin:20px 0; color:#00a3bf;">Data Mahasiswa</h2>

    <div style="display:flex; justify-content:center;">
        <table border="1" cellpadding="10" cellspacing="0"
               style="border-collapse:collapse; width:85%; max-width:900px; text-align:center; background:#fff; 
                      box-shadow:0 2px 6px rgba(0,0,0,0.2); margin:auto; font-family:'Poppins', Arial, sans-serif;">
            <thead style="background-color:#00c9a7; color:#fff;">
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Umur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['Nim']); ?></td>
                            <td><?php echo htmlspecialchars($row['Umur']); ?></td>
                            <td>
                                <a href="template_dasar_01.php?page=mhsw&detail=<?php echo urlencode($row['Nim']); ?>" 
                                   style="color:#00a3bf; text-decoration:none; font-weight:500;">Detail</a> | 
                                <a href="template_dasar_01.php?page=mhsw&hapus=<?php echo urlencode($row['Nim']); ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                   style="color:#d9534f; text-decoration:none; font-weight:500;">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">Belum ada data mahasiswa</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php $conn->close(); ?>

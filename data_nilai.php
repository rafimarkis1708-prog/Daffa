<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query gabungan: mahasiswa + matakuliah + nilai
$sql = "
    SELECT 
        n.id,
        m.Nim,
        m.Nama,
        mk.kodemk,
        mk.namamk,
        n.uts,
        n.uas,
        ((n.uts * 0.4) + (n.uas * 0.6)) AS nilai_akhir
    FROM nilai n
    JOIN mahasiswa m ON n.Nim = m.Nim
    JOIN matakuliah mk ON n.kodemk = mk.kodemk
    ORDER BY m.Nama ASC, mk.namamk ASC
";

$result = $conn->query($sql);
?>

<h2 style="text-align:center; color:#007bff; margin:30px 0;">DATA NILAI MAHASISWA</h2>

<div style="
    width:90%;
    margin:auto;
    background:white;
    padding:25px 30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    font-family:'Poppins', Arial, sans-serif;
">

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:center;">
        <thead style="background-color:#007bff; color:white;">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Indeks</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0):
            $no = 1;
            while($row = $result->fetch_assoc()):
                $nilaiAkhir = $row['nilai_akhir'];

                // Logika penentuan indeks nilai
                if ($nilaiAkhir >= 80) {
                    $indeks = "A";
                } elseif ($nilaiAkhir >= 70) {
                    $indeks = "B";
                } elseif ($nilaiAkhir >= 55) {
                    $indeks = "C";
                } elseif ($nilaiAkhir >= 40) {
                    $indeks = "D";
                } else {
                    $indeks = "E";
                }
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['Nim']; ?></td>
                <td><?php echo $row['Nama']; ?></td>
                <td><?php echo $row['kodemk']; ?></td>
                <td><?php echo $row['namamk']; ?></td>
                <td><?php echo $row['uts']; ?></td>
                <td><?php echo $row['uas']; ?></td>
                <td style="font-weight:bold; color:#198754;">
                    <?php echo number_format($nilaiAkhir, 2); ?>
                </td>
                <td style="font-weight:bold; color:#dc3545;">
                    <?php echo $indeks; ?>
                </td>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr><td colspan="9" style="color:gray;">Belum ada data nilai.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $conn->close(); ?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

/* --- Ambil semua mata kuliah untuk header tabel --- */
$matkulQuery = $conn->query("SELECT * FROM matakuliah ORDER BY kodemk ASC");
$matkulList = [];
while ($mk = $matkulQuery->fetch_assoc()) {
    $matkulList[] = $mk;
}

/* --- Ambil nilai mahasiswa + matkul --- */
$sql = "
    SELECT 
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
    ORDER BY m.Nama ASC, mk.kodemk ASC
";
$result = $conn->query($sql);

/* --- Susun rekap nilai per mahasiswa --- */
$rekap = [];
while ($row = $result->fetch_assoc()) {
    $rekap[$row['Nim']]['Nama'] = $row['Nama'];
    $rekap[$row['Nim']]['nilai'][$row['kodemk']] = $row['nilai_akhir'];
}

/* --- Fungsi konversi nilai angka ke huruf --- */
function konversiNilai($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}
?>

<h2 style="text-align:center; color:#007bff; margin:30px 0;">REKAPITULASI INDEKS NILAI MAHASISWA</h2>

<div style="
    width:95%;
    margin:auto;
    background:white;
    padding:25px 30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    font-family:'Poppins', Arial, sans-serif;
">

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:center;">
    <thead style="background-color:#007bff; color:white;">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NIM</th>
            <th rowspan="2">Nama Mahasiswa</th>
            <th colspan="<?php echo count($matkulList); ?>">Indeks Nilai per Mata Kuliah</th>
            <th rowspan="2">Indeks Rata-rata</th>
        </tr>
        <tr>
            <?php foreach ($matkulList as $mk): ?>
                <th><?php echo $mk['kodemk']; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($rekap)):
            $no = 1;
            foreach ($rekap as $nim => $data):
                $nilaiList = $data['nilai'];
                $jumlahNilai = 0;
                $jumlahMK = 0;
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $nim; ?></td>
            <td style="text-align:left;"><?php echo $data['Nama']; ?></td>

            <?php foreach ($matkulList as $mk): 
                $kode = $mk['kodemk'];
                if (isset($nilaiList[$kode])) {
                    $nilaiAkhir = $nilaiList[$kode];
                    $indeks = konversiNilai($nilaiAkhir);
                    $jumlahNilai += $nilaiAkhir;
                    $jumlahMK++;
                } else {
                    $indeks = "-";
                }
            ?>
                <td><?php echo $indeks; ?></td>
            <?php endforeach; ?>

            <td style="font-weight:bold; color:#198754;">
                <?php 
                    if ($jumlahMK > 0) {
                        $rata2 = $jumlahNilai / $jumlahMK;
                        echo konversiNilai($rata2);
                    } else {
                        echo "-";
                    }
                ?>
            </td>
        </tr>
        <?php
            endforeach;
        else:
        ?>
        <tr><td colspan="<?php echo 4 + count($matkulList); ?>" style="color:gray;">Belum ada data nilai mahasiswa.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<?php $conn->close(); ?>

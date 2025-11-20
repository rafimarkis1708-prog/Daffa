<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<h2 style="text-align:center; margin:20px 0;">Cek Data Mahasiswa</h2>

<!-- Form pencarian nama -->
<form method="GET" action="template_dasar_01.php" 
      style="width:60%;margin:20px auto;padding:20px;background:#fff;
      border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.2);">
  
  <!-- Tambahkan input hidden agar page tetap 'layanan' -->
  <input type="hidden" name="page" value="layanan">

  <label>Masukkan Nama Mahasiswa:</label><br>
  <input type="text" name="Nama" required 
         style="width:80%;padding:8px;margin-top:10px;">
  <button type="submit" style="padding:8px 16px;margin-top:10px;">Cari</button>
</form>


<?php
if (isset($_GET['Nama'])) {
    $Nama = $_GET['Nama'];
    $sql = "SELECT * FROM mahasiswa WHERE Nama LIKE '%$Nama%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div style='width:60%;margin:20px auto;padding:20px;background:white;
              border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.2);'>";
        echo "<h3>Hasil Pencarian:</h3>";
        echo "<table border='1' cellpadding='10' cellspacing='0' 
                style='border-collapse:collapse;width:100%;text-align:center;'>
                <thead style='background-color:#007bff;color:white;'>
                  <tr><th>Nama</th><th>NIM</th><th>Umur</th></tr>
                </thead><tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Nama']}</td>
                    <td>{$row['Nim']}</td>
                    <td>{$row['Umur']}</td>
                  </tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<p style='text-align:center;color:red;'>Data tidak ditemukan.</p>";
    }
}

$conn->close();
?>

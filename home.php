<h3>Selamat Datang....</h3>
<?php
// koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiswa_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nama = $_POST['Nama'];
    $nim = $_POST['nim'];
    $Umur = $_POST['Umur'];

    $sql = "INSERT INTO mahasiswa (Nama, nim, Umur) VALUES ('$Nama', '$nim', '$Umur')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green; text-align:center;'>✅ data berhasil disimpan!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Gagal menyimpan: " . $conn->error . "</p>";
    }
}
?>

<style>
form {
  width: 50%;
  margin: 30px auto;
  padding: 25px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

input, select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  width: 100%;
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background-color: #0056b3;
}

h2 {
  text-align: center;
}
</style>

<h2>Input Data Mahasiswa</h2>

<form method="POST">
  <label for="nim">Nama Mahasiswa</label>
  <input type="text" name="Nama" id="Nama" required>

  <label for="matkul">Nim mahasiswa</label>
  <input type="text" name="nim" id="nim" required>

  <label for="nilai">Umur</label>
  <input type="number" name="Umur" id="Umur" min="0" max="100" required>

  <button type="submit">Simpan </button>
</form>

<?php $conn->close(); ?>

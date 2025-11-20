<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Portal Mahasiswa</title>
  <style>
    /* === Gaya Umum === */
    body {
      font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
      background-color: #f5f7fa;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }

    /* === Header === */
    .header {
      background: linear-gradient(135deg, #00c9a7, #00a3bf);
      color: white;
      padding: 30px 20px;
      font-size: 38px;
      font-weight: 700;
      letter-spacing: 1px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      text-align: center;
      animation: fadeInDown 0.8s ease;
    }

    /* === Logo === */
    .logo {
      width: 80px;
      height: 80px;
      object-fit: contain;
      transition: transform 0.3s ease, filter 0.3s ease;
      mix-blend-mode: multiply; /* 🔥 hilangkan background putih */
      filter: contrast(1.2) brightness(1.1) drop-shadow(0 0 4px rgba(0,0,0,0.15));
    }

    .logo:hover {
      transform: scale(1.1);
      filter: contrast(1.3) brightness(1.15) drop-shadow(0 0 8px rgba(0,0,0,0.2));
    }

    .header-title {
      flex-grow: 1;
      text-align: center;
    }

    .subtitle {
      font-size: 16px;
      font-weight: 400;
      margin-top: 5px;
      letter-spacing: 0.5px;
    }

    /* === Navigasi === */
    .menu {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      background-color: #ffffff;
      border-bottom: 3px solid #00c9a7;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .menu a {
      color: #333;
      text-decoration: none;
      padding: 16px 24px;
      font-weight: 500;
      position: relative;
      transition: all 0.3s ease;
    }

    .menu a:hover {
      color: #00a3bf;
    }

    .menu a.active {
      color: #00a3bf;
      font-weight: 600;
    }

    .menu a.active::after,
    .menu a:hover::after {
      content: "";
      position: absolute;
      bottom: 8px;
      left: 0;
      right: 0;
      margin: auto;
      width: 50%;
      height: 3px;
      background-color: #00c9a7;
      border-radius: 2px;
    }

    /* === Konten === */
    .content {
      padding: 40px 50px;
      min-height: 400px;
      line-height: 1.7;
      background-color: #ffffff;
      animation: fadeIn 0.6s ease;
    }

    .content h2 {
      color: #00a3bf;
      text-align: center;
      font-size: 26px;
      margin-bottom: 10px;
    }

    .content p {
      text-align: center;
      font-size: 16px;
      color: #555;
    }

    /* === Footer === */
    .footer {
      background: linear-gradient(135deg, #00a3bf, #00c9a7);
      color: white;
      text-align: center;
      padding: 18px;
      font-size: 14px;
      letter-spacing: 0.5px;
      border-top: 2px solid #00bfa5;
    }

    /* === Animasi === */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === Responsif === */
    @media (max-width: 600px) {
      .header {
        flex-direction: column;
        gap: 10px;
      }

      .logo {
        width: 60px;
        height: 60px;
      }

      .header-title {
        font-size: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="plbn.png" alt="Logo Polban Kiri" class="logo">
      <div class="header-title">
        PORTAL MAHASISWA
        <div class="subtitle">Politeknik Negeri Bandung</div>
      </div>
      <img src="plbn.png" alt="Logo Polban Kanan" class="logo">
    </div>

    <div class="menu">
      <a href="template_dasar_01.php?page=beranda" class="<?= isset($_GET['page']) && $_GET['page']=='beranda' ? 'active' : '' ?>">Beranda</a>
      <a href="template_dasar_01.php?page=Input" class="<?= isset($_GET['page']) && $_GET['page']=='Input' ? 'active' : '' ?>">Input Data Mahasiswa</a>
      <a href="template_dasar_01.php?page=mhsw" class="<?= isset($_GET['page']) && $_GET['page']=='mhsw' ? 'active' : '' ?>">Data Mahasiswa</a>
      <a href="template_dasar_01.php?page=layanan" class="<?= isset($_GET['page']) && $_GET['page']=='layanan' ? 'active' : '' ?>">Layanan</a>
      <a href="template_dasar_01.php?page=rekap_nilai" class="<?= isset($_GET['page']) && $_GET['page']=='rekap_nilai' ? 'active' : '' ?>">Rekap Nilai</a>
      <a href="template_dasar_01.php?page=input_nilai" class="<?= isset($_GET['page']) && $_GET['page']=='input_nilai' ? 'active' : '' ?>">Input Nilai Mahasiswa</a>
      <a href="template_dasar_01.php?page=data_nilai" class="<?= isset($_GET['page']) && $_GET['page']=='data_nilai' ? 'active' : '' ?>">Data Nilai Mahasiswa</a>
    </div>

    <div class="content">
      <?php
      if (isset($_GET['page'])) {
          $page = $_GET['page'];
          switch ($page) {
              case 'beranda':
                  echo "<h2>Selamat datang di <b>PORTAL MAHASISWA</b></h2>
                        <p>Akses data, layanan, dan informasi akademik dengan mudah dan cepat.</p>";
                  break;
              case 'Input':
                  include 'Input.php';
                  break;
              case 'mhsw':
                  include 'mhsw.php';
                  break;
              case 'layanan':
                  include 'layanan.php';
                  break;
              case 'rekap_nilai':
                  include 'rekap_nilai.php';
                  break;
              case 'input_nilai':
                  include 'input_nilai.php';
                  break;
              case 'data_nilai':
                  include 'data_nilai.php';
                  break;
              default:
                  echo "<h2>Halaman tidak ditemukan</h2>";
                  break;
          }
      } else {
          echo "<h2>Selamat datang di <b>PORTAL MAHASISWA</b></h2>
                <p>Akses data, layanan, dan informasi akademik dengan mudah dan cepat.</p>";
      }
      ?>
    </div>

    <div class="footer">
      &copy; 2025 Portal Mahasiswa | Politeknik Negeri Bandung
    </div>
  </div>
</body>
</html>

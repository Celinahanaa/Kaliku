<?php
    session_start();
    if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('location: index.php');
    }
?>
<?php

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

// Ambil ID pengguna yang sedang login
if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
} else {
    // Jika ID pengguna tidak tersedia, alihkan kembali ke halaman login
    header("Location: signin.php");
    exit();
}

// Koneksi ke database
include "database/kaliku.php";

// Periksa koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// Query untuk mengambil data pemasukan pengguna
$no = 1;
$no1 = 1;
$total = 0;
$total2 = 0;
$sql_pemasukan = "SELECT * FROM pemasukan WHERE id_user = '$id_user'";
$result_pemasukan = $db->query($sql_pemasukan);

// Query untuk mengambil data pengeluaran pengguna
$sql_pengeluaran = "SELECT * FROM pengeluaran WHERE id_user = '$id_user'";
$result_pengeluaran = $db->query($sql_pengeluaran);

// Tutup koneksi database
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: white;
            height: 70px;
            margin: 20px;
            border-radius: 15px;
            padding: 0.5rem;
        }

        .navbar-brand {
            font-weight: 500;
            color: green;
            font-size: 24px;
            transition: 0.3s color;
        }

        .logout-button {
        background-color: green;
        color: white;
        font-size: 14px;
        padding: 8px 20px;
        border-radius: 15px;
        text-decoration: none;
        transition: 0.3s background-color;
        }

        .logout-button:hover {
        background-color: green;
        }

        .navbar-toggler {
        border: none;
        font-size: 1.25rem;
        }

        .navbar-toggler:focus, .btn-close:focus {
        box-shadow: none;
        outline: none;
        }

        .nav-link {
        color: #666777;
        font-weight: 500;
        position: relative;
        }

        .nav-link:hover, .nav-link.active {
        color: #000;
        }

        @media (min-width: 991px) {
            .nav-link::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background-color: green;
            visibility: hidden;
            transition: 0.3s ease-in-out;
            }

            .nav-link:hover::before, .nav-link.active::before {
            width: 100%;
            visibility: visible;
            }
        }

        .container-laporan {
            background: url(img/bg2.jpg) no-repeat center;
            background-size: cover;
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container2 {
            margin-top: 150px;
        }

        .container2 h4 {
            margin-bottom: 50px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pemasukan {
            margin-bottom: 100px;
            width: 1000px;
        }

        .pemasukan h5 {
            color: white;
        }

        .table {
            text-align: center;
        }

        thead th:first-child {
            border-top-left-radius: 15px;
        }

        thead th:last-child {
            border-top-right-radius: 15px;
        }
        
        tbody tr:last-child td:first-child {
            border-bottom-left-radius: 15px;
        }

        tbody tr:last-child td:last-child {
            border-bottom-right-radius: 15px;
        }

        .btn1 {
            border-radius: 10px;
            background-color: green;
            border: none;
            cursor: pointer;
        }

        .btn1:hover {
            background-color: green;
        }

        .btn2 {
            border-radius: 10px;
            background-color: red;
            border: none;
            cursor: pointer;
        }

        .btn2:hover {
            background-color: red;
        }

        footer {
            background-color: white;
            color: black;
            padding: 20px 0;
        }

        .container-footer {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-column {
            display: inline-block;
            text-align: center;
        }

        .footer-column h3 {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .footer-column ul {
            list-style-type: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 5px;
        }

        .footer-column ul li a {
            color: black;
            text-decoration: none;
        }

        .footer-column small {
            color: white;
        }

        .bottom-footer {
            margin-bottom: 25px;
            border-radius: 15px;
            padding: 5px;
            bottom: 0;
            background: green;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand me-auto" href="#">Kaliku</a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Kaliku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-2" aria-current="page" href="dashboard.php">Dompet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="pemasukan.php">Pemasukan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="pengeluaran.php">Pengeluaran</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="laporan.php">Laporan</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="index.php" class="logout-button">Keluar</a>
      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    </nav>

    <div class="container-laporan">
        <div class="container2">
        <h4>Laporan Keuangan</h4>
        <div class="pemasukan">
        <table class="table table-borderless"">
        <h5>Data Pemasukan</h5>
        <a href="pemasukan.php" style="background-color:green;" class="btn1 btn btn-primary">Tambah Pemasukan</a>
        <thead>
            <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Sumber</th>
            <th>Jumlah</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_pemasukan->num_rows > 0) {
                while ($row = $result_pemasukan->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>" . $row['sumber'] . "</td>";
                    echo "<td>Rp" . number_format($row['jumlah']) . "</td>";
                    echo "<td>
                            <a style='background-color:green;' class='btn1 btn btn-primary' href='edit_pemasukan.php?id_pemasukan=" . $row['id_pemasukan'] . "'>Edit</a>  
                            <a style='background-color:red;' class='btn2 btn btn-primary' href='hapus_pemasukan.php?id_pemasukan=" . $row['id_pemasukan'] . "'>Hapus</a>
                        </td>";
                    echo "</tr>";
                    $total += $row['jumlah'];
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data pemasukan</td></tr>";
            }
            ?>
        </tbody>
        </table>
        </div>

        <div class="pemasukan">
        <table class="table table-borderless"">
        <h5>Data Pengeluaran</h5>
        <a href="pengeluaran.php" style="background-color:green;" class="btn1 btn btn-primary">Tambah Pengeluaran</a>
        <thead>
            <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Sumber</th>
            <th>Jumlah</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result_pengeluaran->num_rows > 0) {
            while ($row = $result_pengeluaran->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no1++ . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['sumber'] . "</td>";
                echo "<td>Rp" . number_format($row['jumlah']) . "</td>";
                // Tambah tombol aksi
                echo "<td>
                        <a style='background-color:green;' class='btn1 btn btn-primary' href='edit_pengeluaran.php?id_pengeluaran=" . $row['id_pengeluaran'] . "'>Edit</a> 
                        <a style='background-color:red;' class='btn2 btn btn-primary' href='hapus_pengeluaran.php?id_pengeluaran=" . $row['id_pengeluaran'] . "'>Hapus</a>
                    </td>";
                echo "</tr>";
                $total2 += $row['jumlah'];
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data pengeluaran</td></tr>";
        }
        ?>
        </tbody>
        </table>
    </div>
</div>
</div>

    <footer>
    <div class="container-footer">
        <div class="footer-column">
        <h3>Hubungi Kami</h3>
        <ul>
            <li><a href="mailto:kaliku@gmail.com">Email: kaliku@gmail.com</a></li>
            <li><a href="tel:123-456-789">Telepon: 123-456-789</a></li>
        </ul>
        <div class="bottom-footer">
            <small>Hak cipta &copy; 2024 Kaliku</small>
        </div>
        </div>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

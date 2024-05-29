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

$register_message = "";

// Ambil ID pengguna yang sedang login, pastikan ID tersedia dalam session
if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
} else {
    // Jika ID pengguna tidak tersedia, alihkan kembali ke halaman login
    header("Location: signin.php");
    exit();
}

// Proses form jika dikirimkan
if (isset($_POST['submit'])) {
    // Ambil data dari formulir
    $tanggal = $_POST['tanggal'];
    $sumber = $_POST['sumber'];
    $jumlah = $_POST['jumlah'];

    // Koneksi ke database
    include "database/kaliku.php";

    // Periksa koneksi
    if ($db->connect_error) {
        die("Koneksi gagal: " . $db->connect_error);
    }

    // Query untuk memasukkan data pemasukan ke dalam database
    $sql = "INSERT INTO pengeluaran (id_user, tanggal, sumber, jumlah) VALUES ('$id_user', '$tanggal', '$sumber', '$jumlah')";

    if ($db->query($sql) === TRUE) {
        $register_message = "Data pengeluaran berhasil dimasukkan";
    } else {
        $register_message = "Error: " . $sql . "<br>" . $db->error;
    }

    $db->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengeluaran</title>
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

        .container-pemasukan {
            background: url(img/bg2.jpg) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sign-in-form {
            margin-left: 295px;
            margin-top: 95px;
            z-index: 1;
            width: 500px;
            height: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }
        
        .sign-in-form h4 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .sign-in-form input[type="date"],
        .sign-in-form select[type="select"],
        .sign-in-form button, .sign-in-form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
        }
        
        .sign-in-form button {
            background-color: green;
            color:white;
            border: none;
            cursor: pointer;
        }
        
        .sign-in-form button:hover {
            background-color: green;;
        }

        .sign-in-form a {
            color: red;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .btn {
            margin-top: 25px;
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

    <div class="container-pemasukan">
    <div class="container">
    <form action="pengeluaran.php" method="POST" class="sign-in-form">
      <h4>Masukkan Pengeluaran Keuangan</h4>
      <a><?= $register_message ?></a>
      <input type="date" name="tanggal" class="form-control">
      <select name="sumber" class="form-select" type="select">
                <option value="" disabled selected>Pilih sumber</option>
                <optgroup label="Primer">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Sewa">Sewa</option>
                    <option value="Listrik">Listrik</option>
                    <option value="Air">Air</option>
                    <option value="Gas">Gas</option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Pajak">Pajak</option>
                    <option value="Peralatan">Peralatan</option>
                </optgroup>
                <optgroup label="Sekunder">
                    <option value="Transportasi">Transportasi</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="Komunikasi">Komunikasi</option>
                    <option value="Perawatan">Perawatan</option>
                </optgroup>
                <optgroup label="Tersier">
                    <option value="Koleksi">Koleksi</option>
                    <option value="Hobi">Hobi</option>
                    <option value="Perhiasan">Perhiasan</option>
                    <option value="Barang">Barang</option>
                    <option value="Biaya">Biaya</option>
                    <option value="Hadiah">Hadiah</option>
                </optgroup>
      </select>
      <input type="number" name="jumlah" class="form-control" placeholder="0">
      <button style="background-color: green; color: white;" type="submit" name="submit" class="btn">Simpan</button>
    </form>
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
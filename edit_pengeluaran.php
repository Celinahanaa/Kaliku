<?php
session_start();
include "database/kaliku.php";

if (isset($_GET['id_pengeluaran'])) {
    $id_pengeluaran = $_GET['id_pengeluaran'];
    $sql = "SELECT * FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran";
    $result_pengeluaran = $db->query($sql);
    $row = mysqli_fetch_assoc($result_pengeluaran);
    $tanggal= $row ['tanggal'];
    $sumber= $row ['sumber'];
    $jumlah= $row ['jumlah'];
} else {
    echo "ID tidak tersedia.";
    exit();
}

// Proses form jika dikirimkan
if (isset($_POST['update'])) {
    // Ambil data dari formulir
    $tanggal = $_POST['tanggal'];
    $sumber = $_POST['sumber'];
    $jumlah = $_POST['jumlah'];

    $sql = "UPDATE pengeluaran SET tanggal='$tanggal', sumber='$sumber', jumlah='$jumlah' WHERE id_pengeluaran= $id_pengeluaran";
    if ($db->query($sql) === TRUE) {
        header("Location: laporan.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbarui Pengeluaran Keuangan</title>
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
            color: #fff;
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
    <form action="edit_pengeluaran.php?id_pengeluaran=<?php echo $id_pengeluaran;?>" method="POST" class="sign-in-form">
      <h4>Perbarui Pengeluaran Keuangan</h4>
      <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal;?>">
      <select name="sumber" class="form-select" type="select">
                <option value="" disabled selected>Pilih sumber</option>
                <optgroup label="Primer">
                <option value="Makanan" <?php if ($sumber == "Makanan") echo "selected"; ?>>Makanan</option>
                <option value="Minuman" <?php if ($sumber == "Minuman") echo "selected"; ?>>Minuman</option>
                <option value="Sewa" <?php if ($sumber == "Sewa") echo "selected"; ?>>Sewa</option>
                <option value="Listrik" <?php if ($sumber == "Listrik") echo "selected"; ?>>Listrik</option>
                <option value="Air" <?php if ($sumber == "Air") echo "selected"; ?>>Air</option>
                <option value="Gas" <?php if ($sumber == "Gas") echo "selected"; ?>>Gas</option>
                <option value="Pakaian" <?php if ($sumber == "Pakaian") echo "selected"; ?>>Pakaian</option>
                <option value="Kesehatan" <?php if ($sumber == "Kesehatan") echo "selected"; ?>>Kesehatan</option>
                <option value="Pajak" <?php if ($sumber == "Pajak") echo "selected"; ?>>Pajak</option>
                <option value="Peralatan" <?php if ($sumber == "Peralatan") echo "selected"; ?>>Peralatan</option>
            </optgroup>
            <optgroup label="Sekunder">
                <option value="Transportasi" <?php if ($sumber == "Transportasi") echo "selected"; ?>>Transportasi</option>
                <option value="Pendidikan" <?php if ($sumber == "Pendidikan") echo "selected"; ?>>Pendidikan</option>
                <option value="Hiburan" <?php if ($sumber == "Hiburan") echo "selected"; ?>>Hiburan</option>
                <option value="Komunikasi" <?php if ($sumber == "Komunikasi") echo "selected"; ?>>Komunikasi</option>
                <option value="Perawatan" <?php if ($sumber == "Perawatan") echo "selected"; ?>>Perawatan</option>
            </optgroup>
            <optgroup label="Tersier">
                <option value="Koleksi" <?php if ($sumber == "Koleksi") echo "selected"; ?>>Koleksi</option>
                <option value="Hobi" <?php if ($sumber == "Hobi") echo "selected"; ?>>Hobi</option>
                <option value="Perhiasan" <?php if ($sumber == "Perhiasan") echo "selected"; ?>>Perhiasan</option>
                <option value="Barang" <?php if ($sumber == "Barang") echo "selected"; ?>>Barang</option>
                <option value="Biaya" <?php if ($sumber == "Biaya") echo "selected"; ?>>Biaya</option>
                <option value="Hadiah" <?php if ($sumber == "Hadiah") echo "selected"; ?>>Hadiah</option>
            </optgroup>
      </select>
      <input type="number" name="jumlah" class="form-control" value="<?php echo $jumlah;?>">
      <button style="background-color: green; color: white;" type="submit" name="update" class="btn">Perbarui</button>
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

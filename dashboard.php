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
$total_pemasukan = 0;
$sql_pemasukan = "SELECT SUM(jumlah) AS total FROM pemasukan WHERE id_user = '$id_user'";
$result_pemasukan = $db->query($sql_pemasukan);
if ($result_pemasukan->num_rows > 0) {
    $row_pemasukan = $result_pemasukan->fetch_assoc();
    $total_pemasukan = $row_pemasukan['total'];
}

// Query untuk mengambil data pengeluaran pengguna
$total_pengeluaran = 0;
$sql_pengeluaran = "SELECT SUM(jumlah) AS total FROM pengeluaran WHERE id_user = '$id_user'";
$result_pengeluaran = $db->query($sql_pengeluaran);
if ($result_pengeluaran->num_rows > 0) {
    $row_pengeluaran = $result_pengeluaran->fetch_assoc();
    $total_pengeluaran = $row_pengeluaran['total'];
}

$isi_dompet = $total_pemasukan - $total_pengeluaran;

// Query untuk menghitung total pengeluaran dari setiap sumber
$sql = "SELECT sumber, SUM(jumlah) AS total_pengeluaran FROM pengeluaran WHERE id_user = '$id_user' GROUP BY sumber";
$result = $db->query($sql);

// Siapkan array untuk menyimpan data yang akan digunakan untuk chart
$labels = [];
$data = [];

// Loop melalui hasil query
while ($row = $result->fetch_assoc()) {
    // Tambahkan sumber ke array labels
    $labels[] = $row['sumber'];
    // Tambahkan total pengeluaran ke array data
    $data[] = $row['total_pengeluaran'];
}

// Query untuk menghitung total pengeluaran dari setiap sumber
$sql = "SELECT sumber, SUM(jumlah) AS total_pemasukan FROM pemasukan WHERE id_user = '$id_user' GROUP BY sumber";
$result = $db->query($sql);

// Siapkan array untuk menyimpan data yang akan digunakan untuk chart
$labels1 = [];
$data1 = [];

// Loop melalui hasil query
while ($row = $result->fetch_assoc()) {
    // Tambahkan sumber ke array labels
    $labels1[] = $row['sumber'];
    // Tambahkan total pengeluaran ke array data
    $data1[] = $row['total_pemasukan'];
}

// Tutup koneksi database
$db->close();
?>

<script>
    var totalPemasukan = <?php echo $total_pemasukan; ?>;
    var totalPengeluaran = <?php echo $total_pengeluaran; ?>;
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        .content {
            background: url(img/bg2.jpg) no-repeat center;
            background-size: cover;
            backdrop-filter: blur(50px);
            width: 100%;
            height: 160vh;
        }

        .hero-section .container {
            height: 62vh;
            z-index: 1;
            position: relative;
        }

        .hero-section h1 {
            color: white;
            margin-top: 200px;
            font-size: 1em;
        }

        .hero-section p {
            color: white;
            font-size: 0.5em;
            text-align: center;
        }

        .hero {
            height: 15vh;
        }

        .card--container {
            margin: 20px;
            z-index: 1;
            width: auto;
            height: 390px;
            background: white;
            padding: 2rem;
            border-radius: 15px;
        }

        .card--container h3 {
            color: green;
            z-index: 1;
            margin-bottom: 30px;
        }

        .card--wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 1.57rem;
        }

        .payment--card {
            z-index: 1;
            background: green;
            border-radius: 15px;
            padding: 1.2rem;
            width: 299px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            transition: all 0.5s ease-in-out;
        }

        .payment--card:hover {
            transform: translateY(-5px);
        }

        .card--header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .amount {
            display: flex;
            flex-direction: column;
        }

        .amount h1 {
            font-size: 1em;
            color: white;
        }

        .amount p {
            color: white;
            font-size: 1.2em;
        }

        .icon {
            margin-left: 95px;
            margin-bottom: 15px;
            color: green;
            padding: 1rem;
            height: 60px;
            width: 60px;
            text-align: center;
            border-radius: 50%;
            font-size: 1.5rem;
            background-color: white;
        }

        .card-detail {
            margin-left: 2px;
            margin-top: 10px;
            font-size: 10px;
            color: whitesmoke;
            letter-spacing: 2px;
        }

        .payment--card1 {
            z-index: 1;
            background: green;
            border-radius: 15px;
            padding: 1.2rem;
            width: 405px;
            height: 265px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.5s ease-in-out;
        }

        .payment--card1:hover {
            transform: translateY(-5px);
        }

        .icon1 {
            margin-left: 20px;
            color: green;
            padding: 1rem;
            height: 225px;
            width: 240px;
            text-align: center;
            border-radius: 15px;
            font-size: 1.5rem;
            background-color: white;
        }

        .icon2 {
            margin-left: 20px;
            color: green;
            padding: 1rem;
            height: 225px;
            width: 240px;
            text-align: center;
            border-radius: 15px;
            font-size: 1.5rem;
            background-color: white;
        }

        footer {
            margin-top: 30px
            background-color: white;
            color: black;
            padding: 20px 0;
        }

        .container-footer {
            margin-top: 95px;
            max-width: 1200px;
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
              <a class="nav-link mx-lg-2" href="#dompet">Dompet</a>
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

    <div class="content">
    <section id="akun" class="hero-section">
        <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
            <h1>Selamat datang <?= $_SESSION["username"] ?>!</h1>
            <p>Mari mulai kelola keuanganmu</p>
        </div>
    </section>

    <section id="dompet" class="hero">

    </section>

    <div class ="column">
    <section class="card--container">
        <h3 class="main--title">Data</h3>
        <div class="card--wrapper">
            <div class="payment--card1">
                <div class="amount">
                    <table>
                    <td>
                    <h1 class="tittle">
                        Pemasukan
                    </h1>
                    <p class="amount-value">
                    Rp<?php echo number_format($total_pemasukan); ?>
                    </p>
                    </td>
                    <td>
                    <div class="icon1">
                    <canvas id="pieChart1" class="piechart" width="250px" height="270px"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            var ctx = document.getElementById('pieChart1').getContext('2d');
                            var myPieChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo json_encode($labels1); ?>,
                                    datasets: [{
                                        data: <?php echo json_encode($data1); ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.7)',
                                            'rgba(54, 162, 235, 0.7)',
                                            'rgba(255, 206, 86, 0.7)',
                                            'rgba(75, 192, 192, 0.7)',
                                            'rgba(153, 102, 255, 0.7)',
                                            'rgba(255, 159, 64, 0.7)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true
                                }
                            });
                        </script>
                    </div>
                    </td>
                    </table>
                </div>
            </div>

            <div class="payment--card">
                <div class="amount">
                    <table>
                    <td>
                    <h1 class="tittle">
                        Dompetku
                    </h1>
                    <p class="amount-value">
                        Rp<?php echo number_format($isi_dompet); ?>
                    </p>
                    </td>
                    <td>
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                        </svg>
                    </div>
                    </td>
                    </table>
                    <span class="card-detail">
                        <?= $id_user?>
                    </span>
                </div>
            </div>

            <div class="payment--card1">
                <div class="amount">
                    <table>
                    <td>
                    <h1 class="tittle">
                        Pengeluaran
                    </h1>
                    <p class="amount-value">
                    Rp<?php echo number_format($total_pengeluaran); ?>
                    </p>
                    </td>
                    <td>
                    <div class="icon2">
                    <canvas id="pieChart" width="250px" height="270px"</canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        var ctx = document.getElementById('pieChart').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($labels); ?>,
                                datasets: [{
                                    data: <?php echo json_encode($data); ?>,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.7)',
                                        'rgba(54, 162, 235, 0.7)',
                                        'rgba(255, 206, 86, 0.7)',
                                        'rgba(75, 192, 192, 0.7)',
                                        'rgba(153, 102, 255, 0.7)',
                                        'rgba(255, 159, 64, 0.7)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    </script>
                    </div>
                    </td>
                    </table>
                </div>
            </div>           
        </div>
    </section>
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
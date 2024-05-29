<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .body {
            background-color: rgba(0, 0, 0, 0.6);
        }
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

        .login-button {
        background-color: green;
        color: white;
        font-size: 14px;
        padding: 8px 20px;
        border-radius: 15px;
        text-decoration: none;
        transition: 0.3s background-color;
        }

        .login-button:hover {
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
            background: url(img/bg.jpg) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 280vh;
        }

        .hero-section .container {
            height: 100vh;
            z-index: 1;
            position: relative;
        }

        .hero-section h1 {
            font-size: 1em;
        }

        .hero-section p {
            font-size: 0.5em;
            text-align: center;
        }

        .hero {
            height: 15vh;
        }

        .hero-section2 {
            border-radius: 15px;
            padding: 0.5rem;
            height: 50vh;
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:  white;
        }

        .hero-section2 .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50vh;
            position: relative;
        }

        .hero-section2 h2 {
            margin-bottom: 50px;
            text-align: center;
            font-size: 2em;
        }

        .hero-section2 h2::after {
            content: "";
            position: absolute;
            width: 195px;
            height: 2px;
            display: block;
            margin: 0 auto;
            background-color: green;
        }

        .hero-section2 p {
            font-size: 1em;
            text-align: center;
        }

        .hero1 {
            height: 15vh;
        }

        .hero-section3 {
            border-radius: 15px;
            padding: 0.5rem;
            height: 70vh;
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background:  white;
        }

        .hero-section3 .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 70vh;
            position: relative;
        }

        .hero-section3 h2 {
            margin-bottom: 50px;
            text-align: center;
            font-size: 2em;
        }

        .hero-section3 h2::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 2px;
            display: block;
            margin: 0 auto;
            background-color: green;
        }

        .container-hero3 {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            max-width: 500px; 
        }

        .container .content-hero3 {
            position: absolute; 
            bottom: 0; 
            background: rgb(0, 0, 0); 
            background: rgba(0, 0, 0, 0.5); 
            color:white;
            width: 70%; 
            padding: 20px; 
            border-radius: 15px;
        }

        .column {
            float: left;
            padding: 5px;
        }

        .hero-section3 h5 {
            margin-bottom: 15px;
            font-size: 1.2em;
            text-align: center;
        }

        .hero-section3 p {
            font-size: 0.8em;
            text-align: center;
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
              <a class="nav-link mx-lg-2" aria-current="page" href="#beranda">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#tentang">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#fitur">Fitur</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="signin.php" class="login-button">Masuk</a>
      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    </nav>

    <div class="content">
    <section id="beranda" class="hero-section">
        <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
            <h1>Selamat datang di Kaliku!</h1>
            <p>Kami menyediakan layanan pencatatan keuangan yang efektif dan efisien. 
            Dengan Kaliku, Anda dapat memantau pemasukan dan pengeluaran dengan mudah, 
            mengetahui posisi keuangan Anda, dan mengambil keputusan yang bijaksana untuk masa depan.</p>
            <a href="signup.php" class="login-button">Daftar sekarang</a>
        </div>
    </section>

    <section id="tentang" class="hero">

    </section>

    <section class="hero-section2">
        <div class="container d-flex flex-column">
            <div class="title">
            <h2>Tentang kami</h2>
            <div class="line"></div>
            </div>
            <p>Kami ada untuk membantu Anda mengelola keuangan Anda dengan baik. 
                Kami percaya bahwa pencatatan keuangan yang akurat dan terorganisir 
                dapat membantu Anda mencapai tujuan keuangan Anda. 
                Pengalaman kami di bidang teknologi dan keuangan, 
                membuat layanan ini menjadi solusi yang inovatif dan terpercaya untuk Anda.</p>
        </div>
    </section>

    <section id="fitur" class="hero1">

    </section>

    <section class="hero-section3">
    <div class="container d-flex flex-column">
    <h2>Fitur</h2>
    <div class="column">
    <table>
        <tr>
        <td>
        <div class="container-hero3">
        <img src="img/income.jpg" alt="Pemasukan" style="width:70%; border-radius: 15px;">
        <div class="content-hero3">
            <h5>Pemasukan</h5>
            <p>Fitur pemasukan kami memudahkan Anda untuk mencatat pemasukan 
                        Anda dari berbagai sumber, 
                seperti upah, gaji, bonus, investasi, dll.</p>
        </div>
        </td>
        <td>
        <div class="container-hero3">
        <img src="img/expense.jpg" alt="Pengeluaran" style="width:70%; border-radius: 15px;">
        <div class="content-hero3">
            <h5>Pengeluaran</h5>
            <p>Fitur pengeluaran kami memudahkan Anda untuk mencatat pengeluaran 
                Anda dari berbagai aspek, 
                seperti primer, sekunder, tersier. </p>
        </div>
        </td>
        </tr>
    </table>
    </div>
    </div>
    </div>
    </section>


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
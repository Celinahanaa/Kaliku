<?php
    include "database/kaliku.php";
    session_start();

    $register_message = "";

    if (isset($_POST['signin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["id"] = $data["id"];
            $_SESSION["is_signin"] = true;

            header("location: dashboard.php");
        } else {
            $register_message = "Akun belum terdaftar";
        }
        $db->close();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        .container {
            background: url(img/money.jpg) no-repeat center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .back-container::before {
            background-color: rgba(255, 255, 255, 0.724);
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
        
        .sign-in-form {
            z-index: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .sign-in-form h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .sign-in-form input[type="text"],
        .sign-in-form input[type="password"],
        .sign-in-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
        }
        
        .sign-in-form button {
            background-color: green;
            color: white;
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
        
        .sign-up-link {
            z-index: 1;
            color: black;
            margin-top: 15px;
            text-align: center;
        }
        
        .sign-up-link a {
            color: green;
            text-decoration: none;
        }
        
        .sign-up-link a:hover {
            text-decoration: underline;
        }

        .back-button {
            z-index: 1;
        }

        .back-button a {
            color: green;
        }
    </style>
</head>
<body>
<div class="back-container">
<div class="container">
    <form action="signin.php" method="POST" class="sign-in-form">
      <h2>Masuk</h2>
      <a><?= $register_message ?></a>
      <input type="text" name="username" placeholder="Nama" >
      <input type="password" name="password" placeholder="Kata sandi" >
      <button type="submit" name="signin" >Masuk</button>
    </form>
    <div class="sign-up-link">
      Belum punya akun? <a href="signup.php">Daftar</a>
    </div>
    <div class="back-button">
        <a href="index.php">Beranda</a>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
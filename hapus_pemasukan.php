<?php
session_start();

include "database/kaliku.php";

if (isset($_GET['id_pemasukan'])) {
    $id_pemasukan = $_GET['id_pemasukan'];

    // Hapus data pemasukan berdasarkan ID
    $sql = "DELETE FROM pemasukan WHERE id_pemasukan = $id_pemasukan";

    if ($db->query($sql) === TRUE) {
        header("Location: laporan.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
} else {
    echo "ID tidak tersedia.";
    exit();
}

$db->close();
?>

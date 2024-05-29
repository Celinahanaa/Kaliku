<?php
session_start();

include "database/kaliku.php";

if (isset($_GET['id_pengeluaran'])) {
    $id_pengeluaran = $_GET['id_pengeluaran'];

    // Hapus data pemasukan berdasarkan ID
    $sql = "DELETE FROM pengeluaran WHERE id_pengeluaran = $id_pengeluaran";

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


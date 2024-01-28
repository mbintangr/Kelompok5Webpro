<?php 
    include_once('koneksi.php');

    $waktu = $_GET['waktu'];
    $hari = $_GET['hari'];
    $ruangan = $_GET['ruangan'];

    $sql = "DELETE FROM peminjaman_ruangan WHERE waktu = '$waktu' AND hari = '$hari' AND id_ruangan = (SELECT id_ruangan FROM ruangan WHERE nama_ruangan = '$ruangan')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    header("Location: pageadmin.php?ruangan=$ruangan");
?>
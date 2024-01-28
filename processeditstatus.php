<?php
    include_once('koneksi.php');

    $newStatus = $_GET['newStatus'];
    $id = $_GET['id_peminjaman'];
    
    global $conn;
    $sql = "UPDATE peminjaman_ruangan SET status = '$newStatus' WHERE id_peminjaman = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: pageadmin.php?ruangan=aa204");
?>
<?php 
    include_once('koneksi.php');

    $nama_ruangan = $_GET['ruangan'];
    $nama_dosen = $_POST['nama_dosen'];
    $nama_mata_kuliah = $_POST['mata_kuliah'];
    $semester = $_POST['smt'];
    $kelas = $_POST['kelas'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu_mulai'] . " - " . $_POST['waktu_selesai'];

    $sql = "SELECT id FROM user WHERE nama = '$nama_dosen'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    
    $id_dosen = $result['id'];

    $sql = "SELECT id_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

    $id_ruangan = $result['id_ruangan'];

    $sql = "SELECT id_mata_kuliah FROM mata_kuliah WHERE nama_mata_kuliah = '$nama_mata_kuliah'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

    $id_mata_kuliah = $result['id_mata_kuliah'];

    $sql = "INSERT INTO peminjaman_ruangan (kelas, status, hari, waktu, id_user, id_ruangan, id_mata_kuliah) VALUES ('$kelas', 'Pending', '$tanggal', '$waktu', '$id_dosen', '$id_ruangan', '$id_mata_kuliah')";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        header("Location: pagedosen.php?ruangan=" . $nama_ruangan);
    } else {
        echo "ERROR";
    }

?>
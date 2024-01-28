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

    $sql = "INSERT INTO peminjaman_ruangan (kelas, status, hari, waktu, id_user, id_ruangan) VALUES (:kelas, 'Pending', :tanggal, :waktu, :id_dosen, :id_ruangan)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kelas', $kelas, PDO::PARAM_STR);
    $stmt->bindParam(':tanggal', $tanggal, PDO::PARAM_STR);
    $stmt->bindParam(':waktu', $waktu, PDO::PARAM_STR);
    $stmt->bindParam(':id_dosen', $id_dosen, PDO::PARAM_INT);
    $stmt->bindParam(':id_ruangan', $id_ruangan, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: pagedosen.php?ruangan=" . $nama_ruangan);
?>
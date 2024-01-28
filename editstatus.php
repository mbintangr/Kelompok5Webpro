<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <?php 
  include_once('koneksi.php'); 
  $hari = $_GET['hari'];
  $waktu = $_GET['waktu'];
  $nama_ruangan = $_GET['ruangan'];

  $sql = "SELECT id_peminjaman FROM peminjaman_ruangan WHERE waktu = '$waktu' AND hari = '$hari' AND id_ruangan = (SELECT id_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan')";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if(empty($result)) {
    header("Location: pageadmin.php?ruangan=" . $_GET['ruangan']);
  } else {
    $id = $result[0]['id_peminjaman'];
  }

  $sql = "SELECT u.nama, mk.nama_mata_kuliah, mk.semester, pr.kelas, pr.waktu, pr.hari, pr.status FROM peminjaman_ruangan pr JOIN mata_kuliah mk ON (mk.id_user = pr.id_user) JOIN user u ON (u.id = pr.id_user) WHERE pr.id_ruangan = (SELECT id_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan') AND pr.id_peminjaman = '$id'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach ($stmt->fetchAll() as $key => $value) {
    $nama = $value['nama'];
    $mata_kuliah = $value['nama_mata_kuliah'];
    $semester = $value['semester'];
    $kelas = $value['kelas'];
    $waktu = $value['waktu'];
    $hari = $value['hari'];
    $status = $value['status'];
  }
  ?>


  <div>
    <div class='fixed top-0 left-0 w-full h-screen bg-black opacity-50'>
    </div>
    <div class='flex-col justify-center items-center fixed bg-white rounded-3xl p-8 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2'>
      
      <div>
        <h1 class='text-center font-bold text-xl mb-3'>Details:</h1>
        <ul class="">
          <li>Nama Ruangan: <?= $nama_ruangan ?></li></li>
          <li>Tanggal: <?= $hari ?></li></li>
          <li>Dosen: <?= $nama ?></li></li>
          <li>Mata Kuliah: <?= $mata_kuliah ?></li></li>
          <li>Semester: <?= $semester ?></li></li>
          <li>Kelas: <?= $kelas ?></li></li>
          <li>Waktu: <?= $waktu ?></li></li>
          <li>Status: <?= $status ?></li></li>
        </ul>
      </div>

      <div>
        <h2 class='my-3 font-bold'>Change Status:</h2>
        <div class="w-full flex justify-between">
          <a href="processeditstatus.php?newStatus=Accepted&ruangan=<?= $nama_ruangan ?>&id_peminjaman=<?= $id ?>"><button class='mx-1 px-5 py-1 bg-green-500 font-bold text-white rounded-full hover:bg-green-600'>Accept</button></a>
          <a href="processeditstatus.php?newStatus=Pending&ruangan=<?= $nama_ruangan ?>&id_peminjaman=<?= $id ?>"><button class='mx-1 px-5 py-1 bg-yellow-500 font-bold text-white rounded-full hover:bg-yellow-600'>Pending</button></a>
          <a href="processeditstatus.php?newStatus=Rejected&ruangan=<?= $nama_ruangan ?>&id_peminjaman=<?= $id ?>"><button class='mx-1 px-5 py-1 bg-red-500 font-bold text-white rounded-full hover:bg-red-600'>Reject</button></a>
        </div>
      </div>

    </div>
  </div>
</body>
</html>

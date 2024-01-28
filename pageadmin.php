<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      margin: 2cm;
    }

    header{
      margin-bottom: 1cm;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 1cm;
    }

    th, td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

  </style>
</head>

<body>
  <?php include_once('koneksi.php') ?>
  <header>
    <?php 
      $nama_ruangan = strtoupper($_GET['ruangan']);
      $sql = "SELECT kapasitas, jenis_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $kapasitas_kelas = $result[0]['kapasitas'];
      $jenis_ruangan = $result[0]['jenis_ruangan'];
    ?>
    <h2 class='text-2xl font-bold'><b>RUANG <?php echo $nama_ruangan;?></b></h2>
    <p>Jenis Ruangan: <?php echo $jenis_ruangan ;?></p>
    <p>Kapasitas: <?php echo $kapasitas_kelas . ' orang';?></p>
  </header>

  <main>
  <table class="min-w-full mb-5">
  <h1 class="mb-2"><b>JADWAL</b></h1>
      <thead>
        <tr>
          <th>Nama Dosen</th>
          <th>Matkul</th>
          <th>Semester</th>
          <th>Kelas</th>
          <th>Waktu</th>
          <th>Hari</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php           
          $sql = "SELECT u.nama, mk.nama_mata_kuliah, mk.semester, pr.kelas, pr.waktu, pr.hari, pr.status FROM peminjaman_ruangan pr JOIN user u ON (pr.id_user = u.id) JOIN mata_kuliah mk ON (mk.id_user = u.id) WHERE id_ruangan = (SELECT id_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan')";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          foreach ($stmt->fetchAll() as $key => $value) {
            echo "<tr>";
              echo "<td>" . $value['nama'] . "</td>";
              echo "<td>" . $value['nama_mata_kuliah'] . "</td>";
              echo "<td>" . $value['semester'] . "</td>";
              echo "<td>" . $value['kelas'] . "</td>";
              echo "<td>" . $value['waktu'] . "</td>";
              echo "<td>" . $value['hari'] . "</td>";
              if ($value['status'] == 'Accepted') {
                echo "<td><button class='px-5 py-1 bg-green-500 font-bold text-white rounded-full'>" . $value['status'] . "</button>";
                echo "<a href='editstatus.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-black font-bold text-white rounded-full'>Edit</button></td>";
              } else if ($value['status'] == 'Pending') {
                echo "<td><button class='px-5 py-1 bg-yellow-500 font-bold text-white rounded-full'>" . $value['status'] . "</button>";
                echo "<a href='editstatus.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-black font-bold text-white rounded-full'>Edit</button></td>";
              } else {
                echo "<td><button class='px-5 py-1 bg-red-500 font-bold text-white rounded-full'>" . $value['status'] . "</button>";
                echo "<a href='editstatus.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-black font-bold text-white rounded-full'>Edit</button></td>";
              }
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>

    <div class='hidden'>
      <div class='fixed top-0 left-0 w-full h-screen bg-black opacity-50'>
      </div>
      <div class='flex justify-center items-center fixed bg-white rounded-3xl p-8 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2'>
        <a href="/" class='absolute top-3 right-5 font-extrabold' onclick=<?php $isPopup = false?>>X</a>
        <div>
          <h2 class='font-bold text-center mb-3'>Change Status:</h2>
          <div>
            <button class='px-5 py-1 bg-green-500 font-bold text-white rounded-full'>Accept</button>
            <button class='px-5 py-1 bg-yellow-500 font-bold text-white rounded-full'>Pending</button>
            <button class='px-5 py-1 bg-red-500 font-bold text-white rounded-full'>Reject</button>
          </div>
        </div>
      </div>
    </div>

  </main>
</body>
</html>

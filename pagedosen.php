<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Dosen</title>
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
      $sql = "SELECT kapasitas FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $kapasitas_kelas = $result[0]['kapasitas'];
    ?>
    <h2 class='text-2xl font-bold'><b>RUANG <?php echo $nama_ruangan;?></b></h2>
    <p>Kapasitas: <?php echo $kapasitas_kelas . ' orang';?></p>
  </header>

  <main>
    <table class="min-w-full mb-5">
    <h1><b>JADWAL</b></h1>
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
                echo "<td class='text-green-500 font-bold'>" . $value['status'] . "</td>";
              } else if ($value['status'] == 'Pending') {
                echo "<td class='text-yellow-500 font-bold'>" . $value['status'] . "</td>";
              } else {
                echo "<td class='text-red-500 font-bold'>" . $value['status'] . "</td>";
              }
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
    <a href="form.php?ruangan=<?php echo $nama_ruangan; ?>" ><button class="font-bold px-5 py-1 rounded-full bg-green-500 text-white">Tambah</button></a>
  </main>
</body>
</html>

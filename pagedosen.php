<?php
session_start();
include 'koneksi.php';
$query = "SELECT * FROM user WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute(array('username' => $_SESSION["username"]));
$user = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Dosen</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <style>


    header {
      margin-bottom: 1cm;
    }

    table {
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 10px 30px 10px 30px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <header class="text-center">
    <nav class=" mb-10 bg-white border-gray-200 dark:bg-gray-900 relative ">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="img/pnjlogo.png" class="h-12" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">POLITEKNIK NEGERI JAKARTA</span>
        </a>
        <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
          <button type="button" data-dropdown-toggle="language-dropdown-menu" onclick="toggleDropdown()" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white dropdown-toggle">
            <div class="w-12 h-12">
              <img src="img/user.png" />
            </div>
            <p>Welcome, <?php echo $user['nama']; ?></p>
          </button>
          <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-2 ml-8 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href="logout.php">Logout</a></button>
        </div>
      </div>
    </nav>


    <?php
    $nama_ruangan = strtoupper($_GET['ruangan']);
    $sql = "SELECT kapasitas, jenis_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $kapasitas_kelas = $result[0]['kapasitas'];
    $jenis_ruangan = $result[0]['jenis_ruangan'];
    ?>
    <h2 class='text-2xl font-bold'><b>RUANG <?php echo $nama_ruangan; ?></b></h2>
    <p>Jenis Ruangan: <?php echo $jenis_ruangan; ?></p>
    <p>Kapasitas: <?php echo $kapasitas_kelas . ' orang'; ?></p>
  </header>

  <main>
    <table class="mb-5 mx-auto">
      <h1 class="mb-6 text-center text-xl"><b>JADWAL</b></h1>
      <thead>
        <tr>
          <th>Nama Dosen</th>
          <th>Mata Kuliah</th>
          <th>Semester</th>
          <th>Kelas</th>
          <th>Waktu</th>
          <th>Hari</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT u.nama, mk.nama_mata_kuliah, mk.semester, pr.kelas, pr.waktu, pr.hari, pr.status
        FROM peminjaman_ruangan pr
        JOIN user u ON (pr.id_user = u.id)
        JOIN mata_kuliah mk ON (mk.id_mata_kuliah = pr.id_mata_kuliah)
        WHERE id_ruangan = (SELECT id_ruangan FROM ruangan WHERE UPPER(nama_ruangan) = UPPER('$nama_ruangan'))";
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
    <a href="form.php?ruangan=<?php echo $nama_ruangan; ?>" class="flex items-center justify-center"><button class="font-bold px-5 py-1 rounded-full bg-green-600 hover:bg-green-700 transition duration-300 text-white text-center">Tambah</button></a>
  </main>
</body>

</html>
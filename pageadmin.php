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
  <title>Page Admin</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <style>


    header {
      margin-bottom: 1cm;
    }

    table {
      border-collapse: collapse;
      margin-bottom: 1cm;
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
<nav class="mb-10 bg-[#6096B4] relative">
  <div class=" max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="admin.php" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="img/pnjlogo.png" class="w-16" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">POLITEKNIK NEGERI JAKARTA</span>
    </a>
    <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
      <button type="button" data-dropdown-toggle="language-dropdown-menu" onclick="toggleDropdown()" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer  dropdown-toggle">
        <div class="w-12 h-12">
          <img src="img/user.png" />
        </div>
        <p class="text-white">Welcome, <?php echo $user['nama']; ?></p>
      </button>
      <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-2 ml-8 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href="logout.php">Logout</a></button>
    </div>
  </div>
</nav>



  <?php include_once('koneksi.php') ?>
  <header class="text-center">
    <?php
    $nama_ruangan = strtoupper($_GET['ruangan']);
    $sql = "SELECT kapasitas, jenis_ruangan FROM ruangan WHERE nama_ruangan = '$nama_ruangan'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $kapasitas_kelas = $result['kapasitas'];
    $jenis_ruangan = $result['jenis_ruangan'];
    ?>
    <h2 class='text-2xl font-bold'><b>RUANG <?php echo $nama_ruangan; ?></b></h2>
    <p>Jenis Ruangan: <?php echo $jenis_ruangan; ?></p>
    <p>Kapasitas: <?php echo $kapasitas_kelas . ' orang'; ?></p>
  </header>

  <main>
    <h1 class="mb-6 text-center text-xl"><b>JADWAL</b></h1>
    <table class="mb-5 mx-auto">
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
            echo "<td><div class='flex justify-items-start'><button class='px-5 py-1 bg-green-500 font-bold text-white rounded-full'>" . $value['status'] . "</button>";
            echo "<a href='editstatus.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-black font-bold text-white rounded-full'>Edit</button>";
            echo "<a href='hapusdata.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-red-700 font-bold text-white rounded-full'>X</button></div></td>";
          } else if ($value['status'] == 'Pending') {
            echo "<td><div class='flex justify-items-start'><button class='px-5 py-1 bg-yellow-500 font-bold text-white rounded-full'>" . $value['status'] . "</button>";
            echo "<a href='editstatus.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-black font-bold text-white rounded-full'>Edit</button>";
            echo "<a href='hapusdata.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-red-700 font-bold text-white rounded-full'>X</button></div></td>";
          } else {
            echo "<td><div class='flex justify-items-start'><button class='px-5 py-1 bg-red-500 font-bold text-white rounded-full'>" . $value['status'] . "</button>";
            echo "<a href='editstatus.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-black font-bold text-white rounded-full'>Edit</button>";
            echo "<a href='hapusdata.php?waktu=" . $value['waktu'] . "&hari=" . $value['hari'] . "&ruangan=" . $nama_ruangan . "'><button class='ml-2 px-5 py-1 bg-red-700 font-bold text-white rounded-full'>X</button></div></td>";
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
        <a href="/" class='absolute top-3 right-5 font-extrabold' onclick=<?php $isPopup = false ?>>X</a>
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
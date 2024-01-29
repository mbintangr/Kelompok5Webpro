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
    <title>Form Pengisian Jadwal</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/form.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[#FFFBEB]">

<nav class="bg-[#6096B4] relative">
  <div class=" max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
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

    <?php 
        include_once('koneksi.php');

    ?>
    <div>
    <h2 class="text-2xl font-extrabold text-center mt-[40px] mb-[5px]">FORM PENGISIAN JADWAL</h2>
    </div>


    <div class="container mx-auto ">
    
        <div class="form-container">
            <div class="mb-4 text-center">
                <h3 class="text-xl font-extrabold">RUANGAN <?= $_GET['ruangan'] ?></h3>
                
            </div>
            <div>
            <br class="text-black w-3/4">
            </div>
            <form id="dataForm" action="processtambahdata.php?ruangan=<?= $_GET['ruangan'] ?>" method="post">

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-600">Nama Dosen:</label>
                    <select name="nama_dosen" id="nama" class="mt-1 p-2 w-full border rounded-md">
                    <option value="null"></option>
                    <?php
                        include_once('koneksi.php');

                        $sql = "SELECT DISTINCT nama FROM user WHERE level = 'DOSEN'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach ($stmt->fetchAll() as $key => $value) {
                            echo "<option value='" . $value['nama'] . "'>" . $value['nama'] . "</option>";
                        }
                    ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="matkul" class="block text-sm font-medium text-gray-600">Mata Kuliah:</label>
                    <select name="mata_kuliah" id="nama" class="mt-1 p-2 w-full border rounded-md">
                    <option value="null"></option>
                    <?php
                        include_once('koneksi.php');

                        $sql = "SELECT DISTINCT nama_mata_kuliah FROM mata_kuliah";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach ($stmt->fetchAll() as $key => $value) {
                            echo "<option value='" . $value['nama_mata_kuliah'] . "'>" . $value['nama_mata_kuliah'] . "</option>";
                        }
                    ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="smt" class="block text-sm font-medium text-gray-600">Semester:</label>
                    <select name="smt" id="smt" class="mt-1 p-2 w-full border rounded-md">
                        <option value="null"></option>
                        <option value="1">1</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="7">7</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="kelas" class="block text-sm font-medium text-gray-600">Kelas:</label>
                    <select name="kelas" id="kelas" class="mt-1 p-2 w-full border rounded-md">
                        <option value="null"></option>
                        <option value="TI-1A">TI-1A</option>
                        <option value="TI-1B">TI-1B</option>
                        <option value="TI-3A">TI-3A</option>
                        <option value="TI-3B">TI-3B</option>
                        <option value="TI-5A">TI-5A</option>
                        <option value="TI-5B">TI-5B</option>
                        <option value="TI-7A">TI-7A</option>
                        <option value="TI-7B">TI-7B</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="hari" class="block text-sm font-medium text-gray-600">Tanggal:</label>
                    <input type="date" name="tanggal" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-600">Jam Mulai:</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-600">Jam Akhir:</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mt-4 ml-[1435px]">
                    <button type="submit" class="bg-[#19A7CE] hover:bg-green-700 transition duration-300 mt-6 text-white px-5 py-1 rounded-full font-bold">Submit</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengisian Jadwal</title>
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="">
    <?php 
        include_once('koneksi.php');

    ?>
    <div class="container mx-auto mt-8">
        <div class="form-container">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-extrabold">Form Pengisian Jadwal</h2>
                <h3><?= $_GET['ruangan'] ?></h3>
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

                <div class="mt-6">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 transition duration-300 mt-6 text-white px-5 py-1 rounded-full font-bold">Submit</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
<?php
session_start();
include("koneksi.php");

// Fetch data from the database
$query = "SELECT * FROM ruangan";
$statement = $conn->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Kelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <header class="bg-green-500">
        <div class="container mx-auto flex items-center justify-between p-3">

            <div class="flex items-center m-4">
                <img class="object-scale-down h-20 w-20" src="img/pnjlogo.png" alt="Logo">
                <h1 class="text-white font-bold text-3xl ml-4">PNJ</h1>
            </div>


            <div class="flex flex-col items-end">

                <div class="flex items-center m-4">
                    <h1 class="text-white font-bold text-3xl mr-4">Nama Akun</h1>
                    <img class="object-scale-down h-20 w-20 rounded-full" src="img/fotopp.png" alt="Logo">
                </div>

                <button class="bg-red-500 text-white font-bold text-xl p-2 m-4 h-10 w-30 rounded-lg items-center">Logout</button>
            </div>

        </div>
    </header>
    <div class="flex justify-center items-center pb-[100px]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
            <?php foreach ($results as $result) : ?>
                <div class="bg-gray-100 p-4 rounded-md shadow-md">
                    <h2 class="font-bold text-lg mb-2"><?php echo $result['nama_ruangan']; ?></h2>
                    <p class="text-sm text-gray-600">Jenis Ruangan: <?php echo $result['jenis_ruangan']; ?></p>
                    <p class="text-sm text-gray-600">Kapasitas: <?php echo $result['kapasitas']; ?></p>
                    <button class="bg-green-500 text-white font-bold px-4 py-1 rounded-full my-2 hover:bg-green-700 transition duration-300">
                        <a href="pagedosen.php?ruangan=<?php echo $result['nama_ruangan']; ?>" target="_self">More</a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
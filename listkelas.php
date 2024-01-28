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
    <div class="flex justify-center items-center pb-[100px]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
            <?php foreach ($results as $result): ?>
                <div class="bg-gray-100 p-4 rounded-md shadow-md">
                    <h2 class="font-bold text-lg mb-2"><?php echo $result['nama_ruangan']; ?></h2>
                    <p class="text-sm text-gray-600">Jenis Ruangan: <?php echo $result['jenis_ruangan']; ?></p>
                    <p class="text-sm text-gray-600">Kapasitas: <?php echo $result['kapasitas']; ?></p>
                    <button class="bg-blue-600 text-white font-bold px-4 py-1 rounded-md my-2 hover:bg-blue-700 transition duration-300">
                        <a href="#" target="_blank">More</a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

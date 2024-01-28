<?php
session_start();
include("koneksi.php");


// Fetch data from the database
$query = "SELECT * FROM ruangan";
$statement = $conn->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <title>List Kelas</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>

<nav class="bg-green-300 border-gray-200 dark:bg-gray-900 relative">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="img/pnjlogo.png" class="h-8" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">POLITEKNIK NEGERI JAKARTA</span>
        </a>
        <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
        <button type="button" data-dropdown-toggle="language-dropdown-menu" onclick="toggleDropdown()" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white dropdown-toggle">
        <div class="w-12 h-12">
        <img src="img/user.png"/>
        </div>
        <p>Welcome, <?php echo $user['nama']; ?></p>
        </button>
        <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 mt-2 ml-8 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href="logout.php">Logout</a></button>
        </div>
    </div>
</nav>

</div>
    <div class="flex justify-center items-center pb-[100px]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 p-4">
            <?php foreach ($results as $result): ?>
                <div class="bg-green-300 p-4 rounded-md shadow-md">
                    <h2 class="font-bold text-lg mb-4 pl-14 ;"><?php echo $result['nama_ruangan']; ?></h2>
                    <p class="text-sm text-gray-800">Jenis Ruangan: <?php echo $result['jenis_ruangan']; ?></p>
                    <p class="text-sm text-gray-800">Kapasitas: <?php echo $result['kapasitas']; ?></p>
                    <button class="bg-blue-600 text-white font-bold px-4 py-1 rounded-md my-2 hover:bg-blue-700 transition duration-300 mt-6">
                        <a href="pagedosen.php?ruangan=<?php echo $result['nama_ruangan']; ?>" target="_self">More</a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <script>
    // Fungsi untuk menangani perubahan status dropdown
    function toggleDropdown() {
        var dropdownMenu = document.getElementById('language-dropdown-menu');
        dropdownMenu.classList.toggle('hidden'); // Toggle class 'hidden'
    }

    // Fungsi untuk menutup dropdown saat mengklik di luar dropdown
    window.onclick = function(event) {
        var dropdownMenu = document.getElementById('language-dropdown-menu');
        if (!event.target.matches('.dropdown-toggle')) {
            // Jika yang diklik bukan dropdown toggle, tutup dropdown
            if (!dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
            }
        }
    };
</script>

</body>
</html>
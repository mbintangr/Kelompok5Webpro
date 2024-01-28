<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $matkul = $_POST["matkul"];
    $smt = $_POST["smt"];
    $kelas = $_POST["kelas"];
    $waktuMulai = date("H:i", strtotime($_POST["waktu_mulai"]));
    $waktuSelesai = date("H:i", strtotime($_POST["waktu_selesai"]));
    $hari = $_POST["hari"];

    echo "Data berhasil disimpan: <br>";
    echo "Nama: " . $nama . "<br>";
    echo "Mata Kuliah: " . $matkul . "<br>";
    echo "Semester: " . $smt . "<br>";
    echo "Kelas: " . $kelas . "<br>";
    echo "Waktu Mulai: " . $waktuMulai . "<br>";
    echo "Waktu Selesai: " . $waktuSelesai . "<br>";
    echo "Hari: " . $hari . "<br>";
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Form Pengisian Jadwal</title>
</head>

<body class="bg-gray-200">
    <div class="container mx-auto mt-8">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-6 text-center">Form Pengisian Jadwal</h2>
            <form id="dataForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-600">Nama Dosen:</label>
                    <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="matkul" class="block text-sm font-medium text-gray-600">Mata Kuliah:</label>
                    <input type="text" name="matkul" id="matkul" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="smt" class="block text-sm font-medium text-gray-600">Semester:</label>
                    <select name="smt" id="smt" class="mt-1 p-2 w-full border rounded-md" onchange="updateKelasOptions()">
                        <option value="1">1</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="7">7</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="kelas" class="block text-sm font-medium text-gray-600">Kelas:</label>
                    <select name="kelas" id="kelas" class="mt-1 p-2 w-full border rounded-md">
                    </select>
                </div>
                <div class="mb-4">
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-600">Jam Mulai:</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-600">Jam Akhir:</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="hari" class="block text-sm font-medium text-gray-600">Hari:</label>
                    <select type="text" name="hari" id="hari" class="mt-1 p-2 w-full border rounded-md">
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                    </select>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Submit</button>
                </div>

            </form>
        </div>
        <div id="popup" class="popup-container">
            <div class="popup-content">
                <p>Data berhasil disimpan!</p>
                <span id="popup-close" class="popup-close">Close</span>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('dataForm').addEventListener('submit', function (e) {
            e.preventDefault();

            var waktuMulai = document.getElementById('waktu_mulai').value;
            var waktuSelesai = document.getElementById('waktu_selesai').value;
            if (waktuMulai && waktuSelesai) {
                document.getElementById('popup').style.display = 'flex';
            } else {
                alert('Please select both start and end times.');
            }
        });

        function updateKelasOptions() {
            var semesterSelect = document.getElementById('smt');
            var kelasSelect = document.getElementById('kelas');
            kelasSelect.innerHTML = '';
            var options;
            switch (semesterSelect.value) {
                case '1':
                    options = ['TI-1A', 'TI-1B', 'TI CCIT-1A', 'TI CCIT-1B', 'TMD-1A', 'TMD-1B', 'TMJ-1A', 'TMJ-1B', 'TKJ-1A'];
                    break;
                case '3':
                    options = ['TI-3A', 'TI-3B', 'TI CCIT-3A', 'TI CCIT-3B', 'TMD-3A', 'TMD-3B', 'TMJ-3A', 'TMJ-3B'];
                    break;
                case '5':
                    options = ['TI-5A', 'TI-5B', 'TI CCIT-5A', 'TI CCIT-5B', 'TMD-5A', 'TMD-5B', 'TMJ-5A', 'TMJ-5B'];
                    break;
                case '7':
                    options = ['TI-7A', 'TI-7B', 'TI CCIT-7A', 'TI CCIT-7B', 'TMD-7A', 'TMD-7B', 'TMJ-7A', 'TMJ-7B'];
                    break;
                default:
                    options = [];
            }
            options.forEach(function (option) {
                var optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.text = option;
                kelasSelect.add(optionElement);
            });
        }
        updateKelasOptions();
        document.getElementById('popup-close').addEventListener('click', function () {
            document.getElementById('popup').style.display = 'none';
        });
    </script>
</body>

</html>

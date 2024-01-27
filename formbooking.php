<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Booking AA 203</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.2/tailwind.min.css">
<style>
    body{
        margin: 2cm;
    }

    .container {
            max-width: 600px;
            margin: 2cm auto;
            padding: 20px;
            background-color: #1B8AF2;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .label-select-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .label-select-container label {
            flex: 1;
            margin-right: 1rem;
            color: #fff; 
        }

        .label-select-container select {
            flex: 2;
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc; 
        }

        .flex-end {
            display: flex;
            justify-content: flex-end;
        }

        .button {
            padding: 0.5rem 1rem;
            background-color: #3490dc; 
            color: #fff; 
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

</style>

</head>
<body>
  <div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Form Booking AA 203</h1>
    <form action="" method="post">
      <div class="grid grid-cols-1 gap-4">
        <div class="label-select-container mb-2">
          <label for="nama-dosen" class="text-sm font-medium" style="font-size:20px;">Nama Dosen</label>
          <select name="nama-dosen" id="nama-dosen" class="w-full rounded shadow-sm">
            <option value="">Pilih Dosen</option>
            <option value="Dosen A">Dosen A</option>
            <option value="Dosen B">Dosen B</option>
            <option value="Dosen C">Dosen C</option>
          </select>
        </div>
        <div class="label-select-container mb-2">
          <label for="matkul" class="text-sm font-medium" style="font-size:20px;">Matkul</label>
          <select name="matkul" id="matkul" class="w-full rounded shadow-sm">
            <option value="">Pilih Matkul</option>
            <option value="Pemrograman Web">Pemrograman Web</option>
            <option value="Basis Data">Basis Data</option>
            <option value="Matematika Diskrit">Matematika Diskrit</option>
          </select>
        </div>
        <div class="label-select-container mb-2">
          <label for="smt" class="text-sm font-medium" style="font-size:20px;">Semester</label>
          <select name="smt" id="smt" class="w-full rounded shadow-sm">
            <option value="">Pilih Semester</option>
            <option value="Ganjil">Ganjil</option>
            <option value="Genap">Genap</option>
          </select>
        </div>
        <div class="label-select-container mb-2">
          <label for="kelas" class="text-sm font-medium" style="font-size:20px;">Kelas</label>
          <select name="kelas" id="kelas" class="w-full rounded shadow-sm">
            <option value="">Pilih Kelas</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select>
        </div>
        <div class="label-select-container mb-2">
          <label for="waktu" class="text-sm font-medium" style="font-size:20px;">Waktu</label>
          <select name="waktu" id="waktu" class="w-full rounded shadow-sm">
            <option value="">Pilih Waktu</option>
            <option value="07.00-08.00">07.00-08.00</option>
            <option value="08.00-09.00">08.00-09.00</option>
            <option value="09.00-10.00">09.00-10.00</option>
          </select>
        </div>
        <div class="label-select-container mb-2">
          <label for="hari" class="text-sm font-medium" style="font-size:20px;">Hari</label>
          <select name="hari" id="hari" class="w-full rounded shadow-sm">
            <option value="">Pilih Hari</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">
            </div>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 mr-2 text-white bg-blue-500 rounded shadow-sm">Submit</button>
      </div>
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // validasi data
      $("form").submit(function() {
        // cek apakah nama dosen dipilih
        if ($("select[name='nama-dosen']").val() == "") {
          alert("Nama dosen harus dipilih!");
          return false;
        }

        // cek apakah matkul dipilih
        if ($("select[name='matkul']").val() == "") {
          alert("Matkul harus dipilih!");
          return false;
        }

        // cek apakah semester dipilih
        if ($("select[name='smt']").val() == "") {
          alert("Semester harus dipilih!");
          return false;
        }

        // cek apakah kelas dipilih
        if ($("select[name='kelas']").val() == "") {
          alert("Kelas harus dipilih!");
          return false;
        }

        // cek apakah waktu dipilih
        if ($("select[name='waktu']").val() == "") {
          alert("Waktu harus dipilih!");
          return false;
        }

        // cek apakah hari dipilih
        if ($("select[name='hari']").val() == "") {
          alert("Hari harus dipilih!");
          return false;
        }

        return true;
      });
    });
  </script>
</body>
</html>

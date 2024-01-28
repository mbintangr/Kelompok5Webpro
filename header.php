<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Header</title>
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

</body>

</html>
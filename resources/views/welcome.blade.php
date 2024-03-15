<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <header
        class="bg-gradient-to-b from-green-700 to-green-900 flex flex-col md:flex-row space-y-7 md:space-y-0 items-center justify-between py-5 px-3">
        <a href='' class="flex items-center space-x-3">
            <div class="bg-gradient-to-tl from-green-400 rounded-xl w-16 shadow-lg shadow-black">
                <img class="" src="img/TQ.png">
            </div>
            <div>
                <p class="text-gray-300 text-2xl">Ten Qogam</p>
            </div>
        </a>
        <div>
            <a href="" class="text-xl text-gray-300">О нас</a>
        </div>
        <div>
            <div class="scale-75 md:scale-100 whitespace-nowrap">
                <a href="" class="bg-white hover:bg-gray-300 p-4 text-md rounded-l">Профиль</a>
                <a href="" class="bg-white hover:bg-gray-300 p-4 text-md">Сообщения</a>
                <a href="" class="bg-white hover:bg-gray-300 p-4 text-md rounded-r">Выложить объявление</a>
            </div>
        </div>
    </header>

    <main>
        <div class="bg-gray-300 text-center py-8 space-y-6 shadow-lg shadow-gray-400">
            <form action="" class="flex flex-col md:block items-center space-y-3 md:space-y-0">
                <input type="search" class="rounded p-3 w-full md:w-1/4 " placeholder="Что ищете?">
                <select class="p-3 rounded h-12">
                    <option value="">Вся страна</option>
                    <option value="">Алматы</option>
                    <option value="">Астана</option>
                    <option value="">Шымкент</option>
                </select>
                <button class="p-3 w-24 bg-gray-200 hover:bg-gray-400 rounded text-gray-600 border border-gray-400"
                    type="submit">Поиск</button>
            </form>

            <div>
                <p class="text-3xl">Категории</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 w-6/12 mx-auto gap-1">
                <a href='' class="bg-white hover:bg-gray-400 flex flex-col items-center p-2 rounded-md">
                    <img class="w-10" src="img/wheelchair.svg">
                    <p>Коляски</p>
                </a>
                <a href='' class="bg-white hover:bg-gray-400 flex flex-col items-center p-2 rounded-md">
                    <img class="w-10" src="img/stroller.png">
                    <p>Коляски</p>
                </a><a href='' class="bg-white hover:bg-gray-400 flex flex-col items-center p-2 rounded-md">
                    <img class="w-10" src="img/stroller.png">
                    <p>Коляски</p>
                </a><a href='' class="bg-white hover:bg-gray-400 flex flex-col items-center p-2 rounded-md">
                    <img class="w-10" src="img/stroller.png">
                    <p>Коляски</p>
                </a><a href='' class="bg-white hover:bg-gray-400 flex flex-col items-center p-2 rounded-md">
                    <img class="w-10" src="img/stroller.png">
                    <p>Коляски</p>
                </a>
            </div>
        </div>

        <div class="w-11/12 mx-auto">
            <div class="text-center py-9">
                <p class="text-3xl">
                    Последние объявления
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="flex flex-col justify-between outline bg-gradient-to-b from-gray-100 to-gray-200 hover:to-gray-300 outline-gray-300 p-3 space-y-5 rounded-lg">
                    <a href="" class="text-center ">
                        <p class="text-2xl font-bold ">
                            Коляска
                        </p>
                    </a>
                    <a href="" class="mx-auto">
                        <img class="rounded-lg h-80 w-72" src="img/1.png">
                    </a>
                    <div class="text-center">
                        <p class="text-xl">
                            30 000 тенге
                        </p>
                    </div>
                    <div class="flex justify-start items-center">
                        <p class="text-sm">
                            Алматы, 22 января
                        </p>
                    </div>
                </div>

                <div class="flex flex-col justify-between outline bg-gradient-to-b from-gray-100 to-gray-200 hover:to-gray-300 outline-gray-300 p-3 space-y-5 rounded-lg">
                    <a href="" class="text-center ">
                        <p class="text-2xl font-bold ">
                            Перевозка
                        </p>
                    </a>
                    <a href="" class="mx-auto">
                        <img class="rounded-lg h-80 w-72" src="img/2.jpg">
                    </a>
                    <div class="text-center">
                        <p class="text-xl">
                            Договорная
                        </p>
                    </div>
                    <div class="flex justify-start items-center">
                        <p class="text-sm">
                            Астана, 1 марта
                        </p>
                    </div>
                </div>

                <div class="flex flex-col justify-between outline bg-gradient-to-b from-gray-100 to-gray-200 hover:to-gray-300 outline-gray-300 p-3 space-y-5 rounded-lg">
                    <a href="" class="text-center ">
                        <p class="text-2xl font-bold ">
                            Костыли
                        </p>
                    </a>
                    <a href="" class="mx-auto">
                        <img class="rounded-lg h-80 w-72" src="img/3.png">
                    </a>
                    <div class="text-center">
                        <p class="text-xl">
                            5000 тенге
                        </p>
                    </div>
                    <div class="flex justify-start items-center">
                        <p class="text-sm">
                            Шымкент, 19 февраля
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-3">
        <hr>
        <div class="flex flex-col items-start space-y-5 py-8 mx-auto w-11/12 text-sm font-light">
            <div class="flex space-x-1 items-center text-gray-500 w-10/12">
                <img src="img/copy.svg" class="w-6">
                <p class="">Ten Qogam 2022-2024</p>
            </div>
            <div class="text-gray-500 items-center flex space-x-2 w-10/12">
                <img src="img/address.svg" class="w-6">
                <p>Алматы, Талдыарал 13/1 </p>
            </div>
            <div class="text-gray-500 items-center flex space-x-2 w-10/12">
                <img src="img/wa.svg" class="w-6">
                <p>+77713338080</p>
            </div>
        </div>
    </footer>
</body>

</html>
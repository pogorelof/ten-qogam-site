@extends('layouts.base')

@section('title', 'Выложить объявление')

@section('main')
    <main>
        <div class="mx-auto w-11/12 py-3">
            @if($previous = url()->previous())
                <a href="{{$previous}}"
                   class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                    <img src="img/back.svg" class="w-5" alt="">
                    <p>Назад</p>
                </a>
            @else
                <a href="{{route('home')}}"
                   class="flex items-center font-light p-1 rounded outline-gray-500 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-200">
                    <img src="img/back.svg" class="w-5" alt="">
                    <p>Назад</p>
                </a>
            @endif
        </div>

        <div class="mx-auto w-11/12 bg-white rounded-lg p-5 space-y-5">
            <div class="">
                <p class="text-2xl font-light">ВЫЛОЖИТЬ ОБЪЯВЛЕНИЕ</p>
            </div>
            <form action="{{route('ad.submit')}}" method="POST" class="space-y-3" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col space-y-2 ">
                    <label for="" class="text-xl font-light">Вставить фотографию</label>
                    <input name="photo" type="file" class="
                    file:border-0 file:bg-green-700 file:rounded-lg file:p-2
                    file:hover:bg-green-600 file:hover:cursor-pointer
                    file:text-white
                    ">
                </div>
                @error('photo')
                <p class="text-red-500">{{$message}}</p>
                @enderror

                <div class="flex flex-col space-y-2">
                    <div class="flex items-center space-x-3">
                        <label for="" class="text-xl font-light">Название</label>
                        <div id="edit2" class="bg-purple-700 p-1 rounded-lg hover:bg-purple-800 hover:cursor-pointer opacity-70 hover:opacity-100 transition-opacity duration-500">
                            <img src="{{asset("img/correct.svg")}}" class="w-6">
                        </div>
                        <p id="descriprion2" class="text-xs font-light opacity-0 transition-opacity duration-500">- поправить грамматику нейросетью</p>
                    </div>
                    <input id="title" name="name" type="text" class="border p-2 rounded-md @error('name') outline outline-1 outline-red-200 @enderror" placeholder="Название">
                </div>
                @error('name')
                <p class="text-red-500">{{$message}}</p>
                @enderror

                <div class="grid md:grid-cols-2 gap-3">
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light flex items-center">Цена <p class="text-sm">(Оставьте пустым если цена договорная)</p> </label>
                        <input name="price" type="text" class="border p-2 rounded-md @error('price') outline outline-1 outline-red-200 @enderror" placeholder="Цена, тенге">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light">Категория</label>
                        <select class="border p-2 rounded-md w-full" name="category" style="width: 50%;height: 38px;">
                            <optgroup label="Категории">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    @error('price')
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>

                <div class="flex flex-col space-y-2">
                    <div class="flex items-center space-x-3">
                        <label for="" class="text-xl font-light">Описание</label>
                        <div id="edit" class="bg-purple-700 p-1 rounded-lg hover:bg-purple-800 hover:cursor-pointer opacity-70 hover:opacity-100 transition-opacity duration-500">
                            <img src="{{asset("img/write.svg")}}" class="w-6">
                        </div>
                        <p id="descriprion" class="text-xs font-light opacity-0 transition-opacity duration-500">- украсить текст нейросетью</p>
                    </div>
                    <textarea id="textar" name="description" type="text" class="border p-2 rounded-md resize-none h-36 @error('description') outline outline-1 outline-red-200 @enderror"></textarea>
                </div>
                @error('description')
                <p class="text-red-500">{{$message}}</p>
                @enderror

                <div class="grid md:grid-cols-2 gap-3">
                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light">Номер телефона</label>
                        <input name="phone" type="text" class="border p-2 rounded-md @error('phone') outline outline-1 outline-red-200 @enderror" value="+7">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label for="" class="text-xl font-light">Город, область</label>
                        <select class="border p-2 rounded-md w-full" name="city" style="width: 50%;height: 38px;">
                            <optgroup label="Город, область">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    @error('phone')
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-green-700 p-2 rounded-lg text-white font-bold hover:cursor-pointer hover:bg-green-600">
                    Создать
                </button>

            </form>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        //Description button
        const edit = document.getElementById("edit")
        const descriprion = document.getElementById("descriprion")

        edit.addEventListener("mouseover", function (){
            descriprion.classList.add("opacity-70")
        })
        edit.addEventListener("mouseout", function (){
            descriprion.classList.remove("opacity-70")
        })

        const text_area = $("#textar")

        edit.addEventListener("click", function () {
            const text = text_area.val()

            $.ajax({
                url: "/text_edit",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                data: {
                    text: text
                },
                beforeSend: function () {
                    text_area.addClass("text-gray-300")
                    edit.classList.add("bg-gray-700")
                    edit.classList.add("pointer-events-none")
                    text_area.val("Подождите немного...")
                },
                success: function (res){
                    text_area.removeClass("text-gray-300")
                    edit.classList.remove("bg-gray-700")
                    edit.classList.remove("pointer-events-none")
                    text_area.val(res.data)
                }
            })
        })

        //Title button
        const edit2 = document.getElementById("edit2")
        const descriprion2 = document.getElementById("descriprion2")

        edit2.addEventListener("mouseover", function (){
            descriprion2.classList.add("opacity-70")
        })
        edit2.addEventListener("mouseout", function (){
            descriprion2.classList.remove("opacity-70")
        })

        const title = $("#title")

        edit2.addEventListener("click", function () {
            const text = title.val()

            $.ajax({
                url: "/grammar_edit",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                data: {
                    text: text
                },
                beforeSend: function () {
                    title.addClass("text-gray-300")
                    edit2.classList.add("bg-gray-700")
                    edit2.classList.add("pointer-events-none")
                    title.val("Подождите немного...")
                },
                success: function (res){
                    title.removeClass("text-gray-300")
                    edit2.classList.remove("bg-gray-700")
                    edit2.classList.remove("pointer-events-none")
                    title.val(res.data)
                }
            })
        })
    </script>
@endsection

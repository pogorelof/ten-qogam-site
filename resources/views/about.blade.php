@extends('layouts.base')

@section('title', 'О нас')

@section('main')
    <main class="bg-stone-50 rounded-lg md:w-9/12 mx-auto my-5 p-6">
        <div class="">
            <img class="w-72 mx-auto" src="{{asset('img/about/inclusion.png')}}">
        </div>
        <div>
            <h2 class="text-3xl font-light">
                Мы - организация INCLUSION. Наша миссия:
            </h2>
            <div class="bg-stone-200 rounded-xl p-5 md:w-8/12 mx-auto text-center my-5 shadow-lg shadow-gray-400">
                <p class='md:px-24 font-serif text-lg'>
                    Защита прав и интересов людей с инвалидностью, содействие
                    широкому участию людей с инвалидностью в спортивной и
                    культурной жизни, приобщение их к посильному труду,
                    содействие в решении социальных и бытовых проблем,
                    а также в устранении ограничений в их жизнедеятельности.
                </p>
            </div>

            <hr class="border-gray-400">

            <p class=" text-3xl text-center mt-10">
                Наши основные проекты
            </p>
            <div class="md:grid md:grid-cols-3">
                <div class="flex flex-col justify-center items-center text-center">
                    <div>
                        <img class="w-56" src="{{asset('img/about/invakolyaski.png')}}">
                    </div>
                    <div>
                        <p>
                            Мастерская по ремонту инвалидных колясок и других средств технической реабилитации
                        </p>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center text-center">
                    <div>
                        <img class="w-56" src="{{asset('img/about/tenqogam.png')}}">
                    </div>
                    <div>
                        <p>
                            Обучающий центр для лиц с инвалидностью
                        </p>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center text-center">
                    <div>
                        <img class="w-56" src="{{asset('img/about/invataxi.png')}}">
                    </div>
                    <div>
                        <p>
                            Специальное такси для людей с инвалидностью (дети и взрослые с нарушением опорно двигательного аппарата)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

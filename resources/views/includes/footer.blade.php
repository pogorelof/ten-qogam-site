<footer class="py-3">
    <hr>
    <div class="flex flex-col items-start space-y-5 py-8 mx-auto w-11/12 text-sm font-light">
        <div class="flex space-x-1 items-center @if ($mode != 'vi') text-gray-500 @endif w-10/12">
            <img src="{{ asset('img/copy.svg') }}" class="w-6">
            <p class="">Ten Qogam 2022-2024</p>
        </div>
        <div class="@if ($mode != 'vi') text-gray-500 @endif items-center flex space-x-2 w-10/12">
            <img src="{{ asset('img/address.svg') }}" class="w-6">
            <p>Алматы, Талдыарал 13/1 </p>
        </div>
        <div class="@if ($mode != 'vi') text-gray-500 @endif items-center flex space-x-2 w-10/12">
            <img src="{{ asset('img/wa.svg') }}" class="w-6">
            <p>+77713338080</p>
        </div>
        <a href="{{ route('vision.mode') }}" class="underline italic text-gray-700 hover:text-black">Версия для
            слабовидящих</a>

    </div>
</footer>

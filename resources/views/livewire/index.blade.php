<div class="relative flex flex-col h-screen bg-sky-400/30">

    <div class="flex items-center justify-center py-4">
        <img class="rounded-full h-28 w-28" src="{{asset('storage/logo2.jpeg')}}" alt="">
    </div>

    <div class="flex flex-col w-full h-full gap-6 px-6 bg-white" style="border-radius: 3em 0 0 0">
        <livewire:login>

        <div class="flex justify-center">
            <a href="{{ route('register.human') }}" class="items-center font-semibold">Crea una cuenta nueva</a>
        </div>
    </div>
</div>

<header class="flex justify-between p-3 mb-5">
    <a href="{{route('profile.human', auth()->user()->id)}}"><i class="flex items-center justify-center text-xl fi fi-rr-exchange"></i></a>

    <div class="flex items-end justify-center gap-4 pt-4">
        <a href="{{route('feed')}}" class="relative {{ request()->routeIs('feed') ? 'active' : '' }}">Amigos</a>
        <a href="{{route('discover')}}" class="relative {{ request()->routeIs('discover') ? 'active' : '' }}">Descubre</a>
    </div>

    <a href=""><i class="flex items-center justify-center text-xl fi fi-rr-envelope"></i></a>
</header>

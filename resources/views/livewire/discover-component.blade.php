<div>
    <style>
        header a.active {
            font-weight: bold;
        }

        header a.active::before {
            content: "";
            position: absolute;
            bottom: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #000;
        }

        /* post */
        .post {
            height: 22em;
        }
    </style>

    @livewire('layout.header-component')

    @foreach ($pets as $pet)
        <a href={{ route("profile.pet", $pet->id) }}>{{ $pet->username }}</a>
    @endforeach
</div>

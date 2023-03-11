<header>
    <div class="container header">
        <a class="header-title" href="{{ route('index') }}" title="Home page">Minecraft Stats</a>
        <div class="right">
            <a class="header-title-sub" href="https://discord.groupez.dev/" title="Rejoins le discord" target="_blank">Discord</a>
            @guest()
                <a class="header-title-sub" href="{{ route('login') }}" title="Connecte-toi à ton comte">Connexion</a>
                <a class="header-title-sub" href="{{ route('register') }}" title="Création de ton comte">Inscription</a>
            @elseguest()
                <a class="header-title-sub" href="{{ route('index') }}" title="Rejoins le discord">Profil</a>
            @endguest
        </div>
    </div>
</header>

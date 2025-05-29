
<nav class="navbar">
    <div class="nav-content">
        <div class="logo-matbrew">
            <p>Matbrew Dev</p>
            <img src="{{ asset('images/matbrew-logo.png') }}" alt="matbrew-logo">
        </div>
        
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="btn-nav">
            <a href="{{ route('portfolio.index') }}" class="btn-home">Home</a>
            <a href="{{ route('portfolio.about') }}" class="btn-about">About</a>
            <a href="{{ route('portfolio.contact') }}" class="btn-contact">Contact</a>
            @if($profile && $profile->github_url)
                <a href="{{ $profile->github_url }}" target="_blank">
                    <img src="{{ asset('images/github.png') }}" alt="GitHub">
                </a>
            @endif
        </div>
    </div>
</nav>
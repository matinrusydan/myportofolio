<footer class="foot">
    <div class="top">
        <div class="col-1">
            <div class="useful">
                <a href="#" class="title">Useful Links</a>
                <div class="vertical-auto-layout">
                    <a href="{{ route('portfolio.contact') }}">Contact</a>
                    <a href="{{ route('portfolio.index') }}#portfolio">Portofolio</a>
                    <a href="{{ route('portfolio.index') }}#about">About</a>
                </div>
            </div>
            <div class="legal">
                <div class="container-legal">
                    <p class="title">Legal</p>
                    <div class="legal-autolayout-vertical">
                        <a href="#">Copyright © {{ date('Y') }} {{ $profile->name ?? 'Matin Rusydan' }}</a>
                        <a href="#">Buy a ready-made company</a>
                        <a href="#">All services</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="block">
                <div class="list">
                    <a href="#">{{ $profile->phone ?? '+62 123 456 789' }}</a>
                    <a href="#">{{ $profile->email ?? 'matin.rusydan@gmail.com' }}</a>
                </div>
                <div class="list-2">
                    @if($profile && $profile->whatsapp_url)
                        <a href="{{ $profile->whatsapp_url }}" target="_blank">
                            <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="whatsapp">
                        </a>
                    @endif
                    @if($profile && $profile->telegram_url)
                        <a href="{{ $profile->telegram_url }}" target="_blank">
                            <img src="{{ asset('images/telegram.png') }}" alt="Telegram" class="telegram">
                        </a>
                    @endif
                </div>
            </div>
            <div class="block-2">
                <button class="btn">Call me back</button>
                <div class="address">{{ $profile->address ?? 'Tasikmalaya, West Java, Indonesia' }}</div>
            </div>
        </div>
    </div>
    <div class="bottom">
        <p>© {{ date('Y') }} — Copyright</p>
        <p>Privacy</p>
    </div>
</footer>
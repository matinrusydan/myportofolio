@extends('app')

@section('title', 'About - ' . ($profile->name ?? 'Matin Rusydan'))

@section('content')
<div class="about-page">
    <section class="hero" id="about-hero">
        <div class="hero-content">
            {{-- Posisi hero-image di kiri untuk halaman About --}}
            <div class="hero-image animated-left-on-load"> {{-- Tambahkan class ini untuk animasi --}}
                @if($profile && $profile->photo)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
                @else
                    <img src="{{ asset('images/foto-matin.png') }}" alt="matin rusydan">
                @endif
            </div>
            {{-- Posisi hero-text di kanan untuk halaman About --}}
            <div class="hero-text">
                <h1>About {{ $profile->name ?? 'Matin Rusydan' }}</h1>
                <h2>{{ $profile->title ?? 'Data Engineer' }}</h2>
                <h3>
                    {{ $profile->about ?? 'Passionate about transforming raw data into meaningful insights. With years of experience in data engineering, I specialize in building robust data pipelines, optimizing database performance, and creating scalable solutions that drive business growth.' }}
                </h3>
                <button class="btn-about-me">About Me</button>
            </div>
        </div>
    </section>

    <section class="skills-section">
        <div class="container">
            <div class="section-header">
                <h4>Skills & Expertise</h4>
                <h5>Technologies and tools I work with to deliver exceptional results.</h5>
            </div>
            
            <div class="skills-grid">
                @foreach($skills as $index => $skill)
                <div class="skill-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="skill-icon">
                        @if($skill->icon)
                            <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}">
                        @else
                            <span class="skill-icon-placeholder">{{ strtoupper(substr($skill->name, 0, 2)) }}</span>
                        @endif
                    </div>
                    <h3>{{ $skill->name }}</h3>
                    <p>{{ $skill->description }}</p>
                    <div class="skill-level">
                        <div class="skill-bar">
                            <div class="skill-progress" style="width: {{ $skill->level }}%;"></div>
                        </div>
                        <span class="skill-percentage">{{ $skill->level }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="experience-section">
        <div class="container">
            <div class="section-header">
                <h4>Experience</h4>
                <h5>My professional journey and key roles held.</h5>
            </div>
            <div class="experience-timeline">
                @foreach($experiences as $index => $experience)
                <div class="experience-item" data-aos="fade-right" data-aos-delay="{{ $index * 100 }}">
                    <div class="experience-dot"></div>
                    <div class="experience-content">
                        <div class="experience-header">
                            <span class="experience-period">{{ $experience->start_date->format('M Y') }} - {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}</span>
                            <span class="experience-company">{{ $experience->company }}</span>
                        </div>
                        <h6 class="experience-title">{{ $experience->title }}</h6>
                        <p class="experience-description">{{ $experience->description }}</p>
                        <div class="experience-tech">
                            @foreach(explode(',', $experience->technologies) as $tech)
                                <span class="tech-tag">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="achievements-section">
        <div class="container">
            <div class="section-header">
                <h4>Achievements & Certifications</h4>
                <h5>Recognitions and qualifications that highlight my expertise.</h5>
            </div>
            <div class="achievements-grid">
                @foreach($achievements as $index => $achievement)
                <div class="achievement-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="achievement-icon">
                        @if($achievement->icon)
                            <img src="{{ asset('storage/' . $achievement->icon) }}" alt="{{ $achievement->title }}">
                        @else
                            <i class="fas fa-trophy achievement-icon-default"></i>
                        @endif
                    </div>
                    <h3>{{ $achievement->title }}</h3>
                    <p class="achievement-issuer">{{ $achievement->issuer }}</p>
                    <p class="achievement-date">{{ $achievement->date->format('M Y') }}</p>
                    <p class="achievement-description">{{ $achievement->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="personal-section">
        <div class="personal-content">
            <div class="personal-text">
                <h2>A Glimpse into My World</h2>
                <p>Beyond the code and data, I am a passionate individual who believes in continuous learning and creative exploration. My journey is driven by curiosity and a desire to make an impact, both professionally and personally.</p>
                <p>In my spare time, I enjoy delving into new technologies, contributing to open-source projects, and exploring the intersection of data science and art. These hobbies not only enrich my life but also fuel my problem-solving skills and innovative thinking.</p>
                <div class="personal-stats">
                    <div class="stat-item">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Projects Completed</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">3+</span>
                        <span class="stat-label">Certifications</span>
                    </div>
                </div>
            </div>
            <div class="personal-image">
                <div class="image-wrapper">
                    @if($profile && $profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
                    @else
                        <img src="{{ asset('images/foto-matin.png') }}" alt="matin rusydan">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Transform Your Data?</h2>
            <p>Let's collaborate on your next project and turn your data challenges into powerful solutions.</p>
            <div class="cta-buttons">
                <a href="{{ route('portfolio.contact') }}" class="btn-primary">Get In Touch</a>
                <a href="{{ route('portfolio.index') }}#portfolio" class="btn-secondary">View My Work</a>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.experience-item, .skill-card, .achievement-card').forEach(item => {
            observer.observe(item);
        });

        // Animate skill bars
        const skillBars = document.querySelectorAll('.skill-progress');
        const skillObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progress = entry.target;
                    const width = progress.style.width;
                    progress.style.width = '0%';
                    setTimeout(() => {
                        progress.style.width = width;
                    }, 100);
                }
            });
        }, observerOptions);

        skillBars.forEach(bar => skillObserver.observe(bar));

        // Trigger animation for the hero image on About page
        const heroImageAnimated = document.querySelector('.hero-image.animated-left-on-load');
        if (heroImageAnimated) {
            // Memberi sedikit jeda agar browser sempat merender state awal
            setTimeout(() => {
                heroImageAnimated.classList.add('is-visible');
            }, 100);
        }
    });
</script>
@endsection
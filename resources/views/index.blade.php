@extends('app')

@section('title', 'Portfolio ' . ($profile->name ?? 'Matin Rusydan'))

@section('content')
<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Hi, I am {{ $profile->name ?? 'Matin Rusydan' }}</h1>
            <h2>{{ $profile->title ?? 'Data Engineer' }}</h2>
            <h3>{{ $profile->description ?? 'With expertise in ETL, big data, and database optimization, I ensure your data architecture runs smoothly to support smarter business decisions.' }}</h3>
            <button class="btn-about-me">About Me</button>
        </div>
        <div class="hero-image">
            @if($profile && $profile->photo)
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
            @else
                <img src="{{ asset('images/foto-matin.png') }}" alt="matin rusydan">
            @endif
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about" id="about">
    <!-- Education Section -->
    <div class="section-header">
        <h4>Education</h4>
        <h5>My educational journey that shaped my skills and knowledge in technology.</h5>
    </div>
    
    <div class="timeline">
        @foreach($education as $index => $edu)
        <div class="timeline-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <div class="timeline-year">{{ $edu->year }}</div>
                <div class="timeline-title">{{ $edu->degree }}</div>
                <div class="timeline-institution">{{ $edu->institution }}</div>
                @if($edu->description)
                <div class="timeline-description">{{ $edu->description }}</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Projects Section -->
    <div class="section-header">
        <h4>Recent Projects</h4>
        <h5>A showcase of my latest projects in web development and data science.</h5>
    </div>
    
    <div class="projects-grid">
        @foreach($projects as $project)
        <div class="project-card">
            <div class="project-image">
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}">
                @else
                    <img src="{{ asset('images/project-placeholder.png') }}" alt="{{ $project->name }}">
                @endif
            </div>
            <div class="project-info">
                <h6>{{ $project->name }}</h6>
                <p>{{ $project->location ?? $project->description }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Testimonials Section -->
    <div class="section-header">
        <h4>Customer Feedback</h4>
        <h5>Feedback from clients about their experience working with me.</h5>
    </div>
    
    <div class="testimonials-grid">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-card">
            <div class="testimonial-header">
                <div class="testimonial-avatar">
                    @if($testimonial->avatar)
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                    @else
                        <img src="{{ asset('images/avatar.png') }}" alt="{{ $testimonial->name }}">
                    @endif
                </div>
                <div class="testimonial-meta">
                    <h6>{{ $testimonial->name }}</h6>
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <span class="star filled">★</span>
                            @else
                                <span class="star">☆</span>
                            @endif
                        @endfor
                    </div>
                    <p class="position">{{ $testimonial->position }}</p>
                </div>
            </div>
            <div class="testimonial-message">
                <p>{{ $testimonial->message }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endsection
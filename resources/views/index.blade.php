<?php
// contentFetchId: uploaded:index.blade.php
?>
@extends('app')

@section('title', 'Portfolio ' . ($profile->name ?? 'Matin Rusydan'))

@section('content')
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

<section class="about" id="about">
    <div class="section-header">
        <h4>Education</h4>
        <h5>My educational journey that shaped my skills and knowledge in technology.</h5>
    </div>
    
    <div class="timeline">
        <div class="timeline-progress-fill"></div> {{-- BARU: Tambahkan elemen ini --}}
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

    <section class="projects-section">
        <div class="container">
            <div class="section-header">
                <h4>Projects</h4>
                <h5>My passion projects showcasing diverse skills and creative solutions.</h5>
            </div>
            
            <div class="projects-grid">
                @foreach($projects as $project)
                <div class="project-card">
                    <div class="project-image">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        @else
                            <img src="{{ asset('images/project-placeholder.jpg') }}" alt="{{ $project->title }}">
                        @endif
                    </div>
                    <div class="project-info">
                        <h6>{{ $project->title }}</h6>
                        <p>{{ $project->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h4>Testimonials</h4>
                <h5>What others say about my work and collaboration.</h5>
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
        </div>
    </section>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Observer Options for general animations (like fade-up)
        const observerOptions = {
            threshold: 0.1, // Trigger when 10% of the item is visible
            rootMargin: '0px 0px -50px 0px' // Adjust for earlier/later trigger
        };

        const generalObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                } else {
                    // Optional: remove class if element leaves viewport (for repeated animation)
                    // entry.target.classList.remove('animate-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item, .project-card, .testimonial-card').forEach(item => {
            generalObserver.observe(item);
        });

        // --- Interactive Timeline Line and Dot Animation ---
        const timeline = document.querySelector('.timeline');
        const timelineLineFill = document.querySelector('.timeline-progress-fill');
        const timelineItems = document.querySelectorAll('.timeline-item');

        if (!timeline || !timelineItems.length || !timelineLineFill) {
            console.warn('Timeline elements not found, skipping interactive timeline script.');
            return;
        }

        // Function to update progress line height
        const updateTimelineProgressLine = () => {
            const timelineRect = timeline.getBoundingClientRect();
            const viewportHeight = window.innerHeight;

            // Calculate current scroll position relative to the timeline container
            // The line should fill up as the user scrolls down through the timeline section
            let fillHeight = 0;
            if (timelineRect.top < viewportHeight && timelineRect.bottom > 0) {
                // How much of the timeline has scrolled past the top of the viewport
                const scrolledPastTop = Math.max(0, -timelineRect.top);
                // How much of the timeline is visible from the top of its container
                fillHeight = Math.min(timelineRect.height, scrolledPastTop + viewportHeight / 2); // Fill past middle of screen
            }
            // Ensure fillHeight doesn't exceed timeline's actual height
            timelineLineFill.style.height = `${Math.min(fillHeight, timeline.offsetHeight)}px`;
        };

        // Intersection Observer for Timeline Dots
        const dotObserverOptions = {
            threshold: 0.7, // Trigger when 70% of the timeline-item is visible
            rootMargin: '0px 0px -20px 0px' // Slightly adjust trigger point
        };

        const dotObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const dot = entry.target.querySelector('.timeline-dot');
                if (dot) {
                    if (entry.isIntersecting) {
                        dot.classList.add('is-in-view');
                        // Add pulsing animation after a short delay for a better effect
                        setTimeout(() => dot.classList.add('pulsing'), 300);
                    } else {
                        // Optional: remove animation when out of view
                        dot.classList.remove('is-in-view', 'pulsing');
                    }
                }
            });
        }, dotObserverOptions);

        timelineItems.forEach(item => {
            dotObserver.observe(item);
        });

        // Initial update and on scroll/resize
        updateTimelineProgressLine();
        window.addEventListener('scroll', updateTimelineProgressLine);
        window.addEventListener('resize', updateTimelineProgressLine);
    });
</script>
@endsection
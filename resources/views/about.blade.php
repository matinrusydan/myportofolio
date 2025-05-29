@extends('app')

@section('title', 'About - ' . ($profile->name ?? 'Matin Rusydan'))

@section('content')
<div class="about-page">
    <!-- About Hero Section -->
    <section class="about-hero" id="about-hero">
        <div class="about-hero-content">
            <div class="about-hero-image">
                @if($profile && $profile->photo)
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}">
                @else
                    <img src="{{ asset('images/foto-matin.png') }}" alt="matin rusydan">
                @endif
            </div>
            <div class="about-hero-text">
                <h1>About {{ $profile->name ?? 'Matin Rusydan' }}</h1>
                <p class="about-subtitle">{{ $profile->title ?? 'Data Engineer' }}</p>
                <p class="about-description">
                    {{ $profile->about ?? 'Passionate about transforming raw data into meaningful insights. With years of experience in data engineering, I specialize in building robust data pipelines, optimizing database performance, and creating scalable solutions that drive business growth.' }}
                </p>
            </div>
        </div>
    </section>


    <!-- Skills Section -->
    <section class="skills-section">
        <div class="container">
            <div class="section-header">
                <h2>Skills & Expertise</h2>
                <p>Technologies and tools I work with to deliver exceptional results</p>
            </div>
            
            <div class="skills-grid">
                @if(isset($skills) && $skills->count() > 0)
                    @foreach($skills as $skill)
                    <div class="skill-card">
                        <div class="skill-icon">
                            @if($skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}">
                            @else
                                <div class="skill-icon-placeholder">{{ substr($skill->name, 0, 2) }}</div>
                            @endif
                        </div>
                        <h3>{{ $skill->name }}</h3>
                        <p>{{ $skill->description ?? 'Proficient in ' . $skill->name }}</p>
                        @if($skill->level)
                            <div class="skill-level">
                                <div class="skill-bar">
                                    <div class="skill-progress" style="width: {{ $skill->level }}%"></div>
                                </div>
                                <span class="skill-percentage">{{ $skill->level }}%</span>
                            </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <!-- Default Skills if none in database
                    <div class="skill-card">
                        <div class="skill-icon">
                            <div class="skill-icon-placeholder">PY</div>
                        </div>
                        <h3>Python</h3>
                        <p>Advanced programming for data analysis and ETL processes</p>
                        <div class="skill-level">
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 95%"></div>
                            </div>
                            <span class="skill-percentage">95%</span>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon">
                            <div class="skill-icon-placeholder">SQL</div>
                        </div>
                        <h3>SQL</h3>
                        <p>Database design, optimization, and complex query writing</p>
                        <div class="skill-level">
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 90%"></div>
                            </div>
                            <span class="skill-percentage">90%</span>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon">
                            <div class="skill-icon-placeholder">AW</div>
                        </div>
                        <h3>AWS</h3>
                        <p>Cloud infrastructure and data services management</p>
                        <div class="skill-level">
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 85%"></div>
                            </div>
                            <span class="skill-percentage">85%</span>
                        </div>
                    </div>
                    <div class="skill-card">
                        <div class="skill-icon">
                            <div class="skill-icon-placeholder">SP</div>
                        </div>
                        <h3>Apache Spark</h3>
                        <p>Big data processing and distributed computing</p>
                        <div class="skill-level">
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: 80%"></div>
                            </div>
                            <span class="skill-percentage">80%</span>
                        </div>
                    </div> -->
                @endif
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience-section">
        <div class="container">
            <div class="section-header">
                <h2>Work Experience</h2>
                <p>My professional journey in the tech industry</p>
            </div>
            
            <div class="experience-timeline">
                @if(isset($experiences) && $experiences->count() > 0)
                    @foreach($experiences as $index => $experience)
                    <div class="experience-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="experience-dot"></div>
                        <div class="experience-content">
                            <div class="experience-header">
                                <div class="experience-period">{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}</div>
                                <div class="experience-company">{{ $experience->company }}</div>
                            </div>
                            <h3 class="experience-title">{{ $experience->position }}</h3>
                            <p class="experience-description">{{ $experience->description }}</p>
                            @if($experience->technologies)
                                <div class="experience-tech">
                                    @foreach(explode(',', $experience->technologies) as $tech)
                                        <span class="tech-tag">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Default Experience if none in database -->
                    <!-- <div class="experience-item">
                        <div class="experience-dot"></div>
                        <div class="experience-content">
                            <div class="experience-header">
                                <div class="experience-period">2022 - Present</div>
                                <div class="experience-company">Tech Solutions Inc.</div>
                            </div>
                            <h3 class="experience-title">Senior Data Engineer</h3>
                            <p class="experience-description">
                                Led the development of data pipeline architecture, implemented ETL processes, 
                                and optimized database performance for large-scale applications serving millions of users.
                            </p>
                            <div class="experience-tech">
                                <span class="tech-tag">Python</span>
                                <span class="tech-tag">Apache Spark</span>
                                <span class="tech-tag">AWS</span>
                                <span class="tech-tag">PostgreSQL</span>
                            </div>
                        </div>
                    </div>
                    <div class="experience-item">
                        <div class="experience-dot"></div>
                        <div class="experience-content">
                            <div class="experience-header">
                                <div class="experience-period">2020 - 2022</div>
                                <div class="experience-company">DataFlow Corp</div>
                            </div>
                            <h3 class="experience-title">Data Engineer</h3>
                            <p class="experience-description">
                                Designed and maintained data warehouses, developed automated reporting systems, 
                                and collaborated with analytics teams to deliver actionable business insights.
                            </p>
                            <div class="experience-tech">
                                <span class="tech-tag">SQL</span>
                                <span class="tech-tag">Apache Airflow</span>
                                <span class="tech-tag">Docker</span>
                                <span class="tech-tag">MongoDB</span>
                            </div>
                        </div>
                    </div> -->
                @endif
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="achievements-section">
        <div class="container">
            <div class="section-header">
                <h2>Achievements & Certifications</h2>
                <p>Recognition and certifications that validate my expertise</p>
            </div>
            
            <div class="achievements-grid">
                @if(isset($achievements) && $achievements->count() > 0)
                    @foreach($achievements as $achievement)
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            @if($achievement->icon)
                                <img src="{{ asset('storage/' . $achievement->icon) }}" alt="{{ $achievement->title }}">
                            @else
                                <div class="achievement-icon-default">🏆</div>
                            @endif
                        </div>
                        <h3>{{ $achievement->title }}</h3>
                        <p class="achievement-issuer">{{ $achievement->issuer }}</p>
                        <p class="achievement-date">{{ $achievement->date }}</p>
                        @if($achievement->description)
                            <p class="achievement-description">{{ $achievement->description }}</p>
                        @endif
                    </div>
                    @endforeach
                @else
                    <!-- Default Achievements if none in database -->
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <div class="achievement-icon-default">🎓</div>
                        </div>
                        <h3>AWS Certified Solutions Architect</h3>
                        <p class="achievement-issuer">Amazon Web Services</p>
                        <p class="achievement-date">2023</p>
                        <p class="achievement-description">Validated expertise in designing distributed systems on AWS</p>
                    </div>
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <div class="achievement-icon-default">🏆</div>
                        </div>
                        <h3>Best Data Pipeline Architecture</h3>
                        <p class="achievement-issuer">Tech Innovation Awards</p>
                        <p class="achievement-date">2022</p>
                        <p class="achievement-description">Recognized for innovative approach to real-time data processing</p>
                    </div>
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <div class="achievement-icon-default">📜</div>
                        </div>
                        <h3>Google Cloud Professional Data Engineer</h3>
                        <p class="achievement-issuer">Google Cloud</p>
                        <p class="achievement-date">2021</p>
                        <p class="achievement-description">Certified in designing and building data processing systems</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Personal Info Section -->
    <section class="personal-section">
        <div class="container">
            <div class="personal-content">
                <div class="personal-text">
                    <h2>Beyond the Code</h2>
                    <p>
                        When I'm not diving deep into data pipelines and optimizing databases, you can find me exploring new technologies, 
                        contributing to open-source projects, or sharing knowledge through tech blogs and community meetups.
                    </p>
                    <p>
                        I believe in continuous learning and staying updated with the latest trends in data engineering and cloud technologies. 
                        My goal is to build systems that not only solve today's problems but are scalable for tomorrow's challenges.
                    </p>
                    
                    <div class="personal-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $projectsCount ?? '50+' }}</span>
                            <span class="stat-label">Projects Completed</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $experienceYears ?? '5+' }}</span>
                            <span class="stat-label">Years Experience</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $clientsCount ?? '30+' }}</span>
                            <span class="stat-label">Happy Clients</span>
                        </div>
                    </div>
                </div>
                <div class="personal-image">
                    <div class="image-wrapper">
                        @if($profile && $profile->work_photo)
                            <img src="{{ asset('storage/' . $profile->work_photo) }}" alt="{{ $profile->name }} at work">
                        @else
                            <img src="{{ asset('images/work-setup.jpg') }}" alt="Work setup">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Let's Work Together</h2>
                <p>Ready to transform your data into actionable insights? Let's discuss your project and create something amazing together.</p>
                <div class="cta-buttons">
                    <a href="{{ route('portfolio.contact') }}" class="btn-primary">Get In Touch</a>
                    @if($profile && $profile->resume_url)
                        <a href="{{ $profile->resume_url }}" target="_blank" class="btn-secondary">Download Resume</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script>
    // Add smooth scroll animation for experience timeline
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
    });
</script>
@endsection
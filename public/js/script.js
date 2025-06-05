
const projects = document.querySelector('.projects');
const projectItems = document.querySelectorAll('.project-0'); // Periksa apakah class ini benar, mungkin seharusnya .project-card?

if (projects && projectItems.length > 0) {
    function autoScroll() {
        // Sesuaikan scrollAmount jika diperlukan agar sesuai dengan lebar project-card + gap
        const scrollAmount = projectItems[0].offsetWidth + 30; // Lebar item + gap
        let currentScroll = projects.scrollLeft;
        let targetScroll = currentScroll + scrollAmount;

        // Jika sudah mencapai akhir, kembali ke awal
        if (targetScroll >= projects.scrollWidth - projects.clientWidth + 10) { // +10 untuk buffer
            targetScroll = 0;
        }

        projects.scrollTo({
            left: targetScroll,
            behavior: 'smooth'
        });
    }

    setInterval(autoScroll, 3000);

    // Efek hover untuk project items
    projectItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'scale(1.05)';  
        });

        item.addEventListener('mouseleave', () => {
            item.style.transform = 'scale(1)';  
        });
    });
}

// Hamburger menu functionality
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".btn-nav");
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener("click", function () {
            navMenu.classList.toggle("active");
            menuToggle.classList.toggle("open");
        });
        
        document.addEventListener("click", function (event) {
            if (!menuToggle.contains(event.target) && !navMenu.contains(event.target)) {
                navMenu.classList.remove("active");
                menuToggle.classList.remove("open");
            }
        });
    }
});

// Smooth scrolling for internal links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});

// --- BARU: Interaktif Timeline Line dan Dot Animation ---
document.addEventListener('DOMContentLoaded', function() {
    // Observer Options untuk animasi umum (seperti fade-up)
    const generalObserverOptions = {
        threshold: 0.1, // Memicu ketika 10% dari item terlihat
        rootMargin: '0px 0px -50px 0px' // Sesuaikan untuk pemicu lebih awal/akhir
    };

    const generalObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            } else {
                // Opsional: hapus kelas jika elemen meninggalkan viewport (untuk animasi berulang)
                // entry.target.classList.remove('animate-in');
            }
        });
    }, generalObserverOptions);

    // Amati semua item yang sudah ada data-aos nya
    document.querySelectorAll('[data-aos]').forEach(item => { // Ini akan mengamati semua elemen dengan data-aos
        generalObserver.observe(item);
    });
    // Jika ada elemen lain yang ingin dianimasikan selain AOS, tambahkan di sini
    // document.querySelectorAll('.project-card, .testimonial-card').forEach(item => {
    //     generalObserver.observe(item);
    // });


    // --- Interaktif Timeline Line dan Dot Animation Logic ---
    const timeline = document.querySelector('.timeline');
    const timelineLineFill = document.querySelector('.timeline-progress-fill');
    const timelineItems = document.querySelectorAll('.timeline-item');

    if (!timeline || !timelineItems.length || !timelineLineFill) {
        console.warn('Timeline elements not found, skipping interactive timeline script.');
        return;
    }

    // Fungsi untuk memperbarui tinggi garis pengisi
    const updateTimelineProgressLine = () => {
        const timelineRect = timeline.getBoundingClientRect(); // Posisi timeline relatif ke viewport
        const viewportHeight = window.innerHeight; // Tinggi viewport

        let fillHeight = 0;
        // Hitung berapa banyak bagian timeline yang sudah melewati bagian tengah viewport
        // Ini akan membuat garis mengisi saat user menggulir ke bawah melewati timeline section
        if (timelineRect.top < viewportHeight && timelineRect.bottom > 0) {
            // Posisi bagian bawah viewport relatif terhadap bagian atas timeline container
            const scrolledThroughTimeline = Math.max(0, (viewportHeight - timelineRect.top) - (viewportHeight * 0.2)); // Mulai mengisi ketika 20% viewport sudah melewati timeline top
            fillHeight = Math.min(timelineRect.height, scrolledThroughTimeline);
        }
        
        // Pastikan fillHeight tidak melebihi tinggi aktual timeline
        timelineLineFill.style.height = `${Math.min(fillHeight, timeline.offsetHeight)}px`;
    };

    // Intersection Observer untuk Timeline Dots
    const dotObserverOptions = {
        threshold: 0.7, // Memicu ketika 70% dari timeline-item terlihat
        rootMargin: '0px 0px -20px 0px' // Sesuaikan pemicu agar lebih awal/akhir
    };

    const dotObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const dot = entry.target.querySelector('.timeline-dot');
            if (dot) {
                if (entry.isIntersecting) {
                    dot.classList.add('is-in-view');
                    // Tambahkan animasi pulsing setelah sedikit jeda untuk efek yang lebih baik
                    setTimeout(() => dot.classList.add('pulsing'), 300);
                } else {
                    // Opsional: hapus animasi ketika keluar dari viewport (untuk animasi berulang)
                    dot.classList.remove('is-in-view', 'pulsing');
                }
            }
        });
    }, dotObserverOptions);

    timelineItems.forEach(item => {
        dotObserver.observe(item);
    });

    // Panggil fungsi pembaruan garis saat pertama kali load dan setiap kali scroll/resize
    updateTimelineProgressLine(); // Panggilan awal
    window.addEventListener('scroll', updateTimelineProgressLine);
    window.addEventListener('resize', updateTimelineProgressLine);
});
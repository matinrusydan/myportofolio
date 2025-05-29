// Projects auto scroll functionality
const projects = document.querySelector('.projects');
const projectItems = document.querySelectorAll('.project-0');

if (projects && projectItems.length > 0) {
    function autoScroll() {
        const scrollAmount = 388 + 58; 
        let currentScroll = projects.scrollLeft;
        let targetScroll = currentScroll + scrollAmount;

        projects.scrollTo({
            left: targetScroll,
            behavior: 'smooth'
        });
    }

    setInterval(autoScroll, 3000);

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
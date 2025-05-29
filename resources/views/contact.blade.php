@extends('app')

@section('title', 'Kontak - ' . ($profile->name ?? 'Matin Rusydan'))
@section('body-class', 'contact-page')

@section('content')
<main class="contact-container">
    <div class="contact-header">
        <h1>Contact Me</h1>
        <div class="contact-subtitle">Let's Build Something Great Together</div>
        <p class="contact-description">
            I'm always interested in hearing about new projects and opportunities. Whether you have a question or just want to say hello, feel free to get in touch!
        </p>
    </div>

    <form id="contactForm" class="contact-form" novalidate>
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" maxlength="50" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" maxlength="50" placeholder="Enter your email address" required>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" maxlength="15" placeholder="Enter your phone number">
        </div>

        <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" maxlength="500" placeholder="Tell me about your project or just say hi..." required></textarea>
            <div class="char-counter">
                <span id="charCount">0</span>/500
            </div>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
            <span class="btn-text">Send Message</span>
        </button>

        <div id="formMessage" class="form-message"></div>
    </form>

    <!-- Contact Info -->
    <div class="contact-info">
        <div class="info-card">
            <div class="info-icon">📧</div>
            <h3>Email</h3>
            <p>{{ $profile->email ?? 'matinrusydan@example.com' }}</p>
        </div>
        <div class="info-card">
            <div class="info-icon">📱</div>
            <h3>Phone</h3>
            <p>{{ $profile->phone ?? '+62 123 4567 8900' }}</p>
        </div>
        <div class="info-card">
            <div class="info-icon">📍</div>
            <h3>Location</h3>
            <p>{{ $profile->location ?? 'Tasikmalaya, Indonesia' }}</p>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<!-- <script src="{{ asset('js/contact.js') }}"></script> -->
<script>
$(document).ready(function() {
    // Character counter for message textarea
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');

    messageTextarea.addEventListener('input', function() {
        const currentLength = this.value.length;
        charCount.textContent = currentLength;
        
        // Change color based on character count
        const counter = charCount.parentElement;
        if (currentLength > 400) {
            counter.style.color = '#e74c3c';
        } else if (currentLength > 300) {
            counter.style.color = '#f39c12';
        } else {
            counter.style.color = 'rgba(255, 255, 255, 0.6)';
        }
    });

    // Form submission with enhanced UI
    $("#contactForm").submit(function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        const formMessage = document.getElementById('formMessage');
        const btnText = submitBtn.querySelector('.btn-text');
        
        // Get form data
        var formData = {
            name: $("#name").val().trim(),
            email: $("#email").val().trim(),
            phone: $("#phone").val().trim(),
            message: $("#message").val().trim(),
            _token: $('input[name="_token"]').val()
        };
        
        // Basic validation
        if (!formData.name || !formData.email || !formData.message) {
            showMessage('Harap isi semua field yang wajib diisi.', 'error');
            return;
        }
        
        if (!isValidEmail(formData.email)) {
            showMessage('Harap masukkan alamat email yang valid.', 'error');
            return;
        }
        
        // Show loading state
        submitBtn.classList.add('loading');
        btnText.textContent = 'Mengirim...';
        submitBtn.disabled = true;

        $.ajax({
            url: "{{ route('contact.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                // Reset button state
                submitBtn.classList.remove('loading');
                btnText.textContent = 'Kirim Pesan';
                submitBtn.disabled = false;
                
                if(response.success) {
                    showMessage(response.message || 'Terima kasih! Pesan Anda telah berhasil dikirim.', 'success');
                    $("#contactForm")[0].reset();
                    charCount.textContent = '0';
                    charCount.parentElement.style.color = 'rgba(255, 255, 255, 0.6)';
                } else {
                    showMessage(response.message || 'Terjadi kesalahan, silakan coba lagi.', 'error');
                }
            },
            error: function(xhr) {
                // Reset button state
                submitBtn.classList.remove('loading');
                btnText.textContent = 'Kirim Pesan';
                submitBtn.disabled = false;
                
                var response = JSON.parse(xhr.responseText);
                showMessage(response.message || "Terjadi kesalahan, silakan coba lagi.", 'error');
            }
        });
    });
    
    // Show message function
    function showMessage(text, type) {
        const formMessage = document.getElementById('formMessage');
        formMessage.textContent = text;
        formMessage.className = `form-message ${type}`;
        formMessage.style.display = 'block';
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            formMessage.style.display = 'none';
        }, 5000);
    }
    
    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Input animations
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection
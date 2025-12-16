<?php
include 'includes/header.php';
?>

<style>
    :root {
        --brand-blue: #3498db; 
        --brand-yellow: #f1c40f; 
        --text-light: #ffffff;
        --text-pudar: #e0e0e0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        line-height: 1.6;
        color: var(--text-light);
        background: linear-gradient(to right bottom, #051636, #020d20) !important;
        min-height: 100vh;
        overflow-x: hidden;
    }
    .color-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        opacity: 0.3;
        pointer-events: none;
    }
    .color {
        position: absolute;
        filter: blur(200px);
    }
    .color:nth-child(1) {
        top: -350px;
        width: 600px;
        height: 600px;
        background: #ff359b;
    }
    .color:nth-child(2) {
        bottom: -150px;
        left: 100px;
        width: 500px;
        height: 500px;
        background: #fffd87;
    }
    .color:nth-child(3) {
        bottom: 50px;
        right: 100px;
        width: 300px;
        height: 300px;
        background: #00d2ff;
    }
    
    /* Content z-index */
    .hero, .section {
         position: relative;
         z-index: 10;
    }

    /* Container */
    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .section {
        padding: 80px 0;
    }

    /* Hero Section */
    .hero {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        padding: 120px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }
    .hero h1 {
        font-size: 3rem;
        margin-bottom: 20px;
        font-weight: 700;
        text-shadow: 3px 3px 10px rgba(0,0,0,0.7);
    }
    .hero p {
        font-size: 1.2rem;
        margin-bottom: 40px;
        opacity: 0.95;
        line-height: 1.6;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
    }

    /* Section Title */
    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }
    .section-title h2 {
        font-size: 2.5rem;
        color: var(--text-light);
        margin-bottom: 15px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }
    .section-title p {
        font-size: 1.1rem;
        color: var(--text-pudar);
        max-width: 600px;
        margin: 0 auto;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    }
    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--brand-blue), var(--brand-yellow));
        margin: 20px auto 0;
        border-radius: 2px;
    }

    /* Himpunan Grid */
    .himpunan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
    .himpunan-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .himpunan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        background: rgba(255, 255, 255, 0.12);
    }
    
    /* Logo Himpunan */
    .himpunan-logo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--brand-blue), var(--brand-yellow));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        font-weight: bold;
        margin: 0 auto 20px;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    /* Nama Himpunan */
    .himpunan-name {
        margin-bottom: 10px;
    }
    .himpunan-name h3 {
        color: var(--text-light);
        font-size: 1.4rem;
        margin-bottom: 5px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    }
    .himpunan-name .full-name {
        color: var(--text-pudar);
        font-size: 0.85rem;
        font-style: italic;
        margin-bottom: 15px;
    }
    
    /* Prodi Badge */
    .prodi-badge {
        display: inline-block;
        padding: 6px 18px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
        background: rgba(241, 196, 15, 0.2);
        color: var(--brand-yellow);
        border: 1px solid var(--brand-yellow);
    }
    
    /* Deskripsi Singkat */
    .himpunan-desc {
        color: var(--text-pudar);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 20px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }
    
    /* Contact Info */
    .contact-info {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .contact-info a {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .contact-info a:hover {
        transform: translateY(-3px) scale(1.1);
        background: var(--brand-blue);
    }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(60px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes zoomIn {
        from { opacity: 0; transform: scale(0.7); }
        to { opacity: 1; transform: scale(1); }
    }
    
    .fade-in-up {
        opacity: 0;
        animation: fadeInUp 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }
    .zoom-in {
        opacity: 0;
        animation: zoomIn 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }
    .delay-1 { animation-delay: 0.15s; }
    .delay-2 { animation-delay: 0.3s; }
    .delay-3 { animation-delay: 0.45s; }
    .delay-4 { animation-delay: 0.6s; }

    /* Responsive */
    @media (max-width: 768px) {
        .hero h1 { font-size: 2rem; }
        .hero p { font-size: 1rem; }
        .himpunan-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>

<section class="hero">
    <div class="container hero-content">
        <h1 class="fade-in-up">Himpunan Mahasiswa FIKOM</h1>
        <p class="fade-in-up delay-1">Organisasi kemahasiswaan yang menaungi mahasiswa berdasarkan program studi</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title fade-in-up">
            <h2>Daftar Himpunan Mahasiswa</h2>
            <p>Himpunan mahasiswa di lingkungan Fakultas Ilmu Komputer</p>
        </div>

        <div class="himpunan-grid">
            <div class="himpunan-card zoom-in delay-1">
                <div class="himpunan-logo">
                    <i class="fas fa-code"></i>
                </div>
                <div class="himpunan-name">
                    <h3>HMTI</h3>
                    <p class="full-name">Himpunan Mahasiswa Informatika</p>
                </div>
                <div class="prodi-badge">Informatika</div>
                <div class="himpunan-desc">
                    Wadah aspirasi dan kreativitas mahasiswa Informatika dalam mengembangkan kompetensi di bidang programming dan teknologi.
                </div>
                <div class="contact-info">
                    <a href="https://instagram.com/hmif_unisan" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:hmif@fikom-unisan.ac.id" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>

            <div class="himpunan-card zoom-in delay-3">
                <div class="himpunan-logo">
                    <i class="fas fa-network-wired"></i>
                </div>
                <div class="himpunan-name">
                    <h3>HMPTI</h3>
                    <p class="full-name">Himpunan Mahasiswa Pendidikan Teknologi Informasi</p>
                </div>
                <div class="prodi-badge">Pendidikan Teknologi Informasi</div>
                <div class="himpunan-desc">
                    Himpunan mahasiswa yang berfokus pada infrastruktur IT, jaringan komputer, dan keamanan siber.
                </div>
                <div class="contact-info">
                    <a href="https://instagram.com/hmti_unisan" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6281234567892" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:hmti@fikom-unisan.ac.id" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.fade-in-up, .zoom-in');
        animatedElements.forEach(el => observer.observe(el));
        const heroElements = document.querySelectorAll('.hero .fade-in-up');
        heroElements.forEach((el, index) => {
            setTimeout(() => {
                el.style.opacity = '1';
            }, index * 300);
        });
    });
    let ticking = false;
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const scrolled = window.pageYOffset;
                const colors = document.querySelectorAll('.color');
                
                colors.forEach((color, index) => {
                    const speed = 0.3 + (index * 0.15);
                    color.style.transform = `translateY(${scrolled * speed}px)`;
                });
                
                ticking = false;
            });
            ticking = true;
        }
    });
</script>

<?php
include 'includes/footer.php';
?>
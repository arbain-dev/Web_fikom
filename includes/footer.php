<style>
:root {
    --brand-blue: #0ad2ec;
}

.site-footer {
    width: 100%;
    background: linear-gradient(135deg, #16213e 0%, #0f3460 50%, #0e0f10 100%) !important;
    color: #bdc3c7;
    padding: 15px 0 10px 0;
    font-size: 0.75rem;
    line-height: 1.4;
    border-top: 2px solid #0ad2ec !important;
    margin-top: 30px !important; 
    position: relative !important;
    z-index: 999;
}

.site-footer .container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 25px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.2fr 0.9fr 0.9fr;
    gap: 1rem;
    align-items: start;
}

@media (max-width: 768px) {
    .footer-grid { 
        grid-template-columns: 1fr;
        gap: 20px;
        text-align: center;
    }
}

.site-footer h4, 
.site-footer p, 
.site-footer ul, 
.site-footer li {
    margin: 0;
}

.footer-col h4 {
    color: #fff;
    font-weight: 600;
    font-size: 0.85rem;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-col p {
    text-align: justify;
}

.footer-col-links ul li { 
    margin-bottom: 4px;
}
.footer-col-links ul li a {
    text-align: justify;
    color: #bdc3c7;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    transition: 0.3s;
}
.footer-col-links ul li a:hover {
    color: #fff;
    transform: translateX(3px);
}

.footer-col-contact p {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 6px;
}
.footer-col-contact p i {
    color: var(--brand-blue);
    font-size: 0.8rem;
    margin-top: 1px;
}

@media (max-width: 768px) {
    .footer-col-contact p {
        justify-content: center;
        text-align: center;
    }
}

.social-icons {
    display: flex;
    gap: 6px;
    margin-top: 10px;
}
@media (max-width: 768px) {
    .social-icons {
        justify-content: center;
    }
}

.social-icons a {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    background: rgba(255,255,255,0.12);
    color: white;
    text-decoration: none !important;
    transition: 0.25s;
}

.social-icons a:hover {
    transform: translateY(-2px);
}

.social-icons a.whatsapp:hover { 
    background: #25D366; 
}
.social-icons a.facebook:hover { 
    background: #1877F2; 
}
.social-icons a.tiktok:hover { 
    background: #000;
}
.social-icons a.instagram:hover {
    background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
}
.social-icons a.youtube:hover { background: #FF0000; }

.footer-bottom {
    text-align: center;
    margin-top: 10px;
    padding-top: 8px;
    border-top: 1px solid rgba(255,255,255,0.2);
    color: #7f8c8d;
    font-size: 0.7rem;
}

/* ANIMATION */
.footer-col {
    opacity: 0;
    transform: translateY(15px);
    transition: all 0.5s ease-out;
}
.footer-col.show {
    opacity: 1;
    transform: translateY(0);
}
.back-to-top {
    position: fixed;
    right: 25px;
    bottom: 80px; 
    width: 40px;
    height: 40px;
    background-color: var(--brand-blue);
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    text-decoration: none;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s ease-in-out;
    box-shadow: 0 3px 6px rgba(0,0,0,0.3);
}

/* MUNCUL SAAT DI SCROLL */
.back-to-top.active {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    background-color: #08b3c9;
    transform: translateY(-3px);
}
</style>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-col footer-col-contact">
                <h4>Hubungi Kami</h4>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Poros, Rappang, Sulsel</p>
                <p><i class="fas fa-phone-alt"></i> (0421) 123 456</p>
                <p><i class="fas fa-envelope"></i> info@fikom-unisan.ac.id</p>

                <div class="social-icons">
    <a href="#" class="whatsapp" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>

    <a href="https://www.facebook.com/share/1A7pWq9jEJ/" class="facebook" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-facebook-f"></i>
    </a>

    <a href="https://www.tiktok.com/@informatikaunisan.sid" class="tiktok" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-tiktok"></i>
    </a>

    <a href="https://www.instagram.com/fikomunisansidrap?igsh=MWdjZWlxNm12bmxyMg==" class="instagram" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-instagram"></i>
    </a>

    <a href="#" class="youtube" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-youtube"></i>
    </a>
</div>

            </div>

            <div class="footer-col footer-col-links">
                <h4>Akademik</h4>
                <ul>
                    <li><a href="berita_semua.php">Berita & Agenda</a></li>
                    <!-- <li><a href="#">Info Wisuda</a></li> -->
                </ul>
            </div>

            <div class="footer-col footer-col-links">
                <h4>Mahasiswa Baru</h4>
                <ul>
                    <li><a href="proses-pendaftaran.php">Pendaftaran Online</a></li>
                    <li><a href="#">Panduan Daftar</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <p>Hak Cipta © <?php echo date("Y"); ?> Muhammad Arbain. All Rights Reserved.</p>
    </div>
</footer>

<a href="#" class="back-to-top" id="backToTopBtn">
    <i class="fas fa-arrow-up"></i>
</a>

<script>
const backToTopBtn = document.getElementById("backToTopBtn");
window.addEventListener("scroll", () => {
    if (window.scrollY > 200) backToTopBtn.classList.add("active");
    else backToTopBtn.classList.remove("active");
});

backToTopBtn.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: "smooth" });
});

document.addEventListener('DOMContentLoaded', function() {
    const footerCols = document.querySelectorAll(".footer-col");
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add("show");
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    footerCols.forEach(col => observer.observe(col));
});
</script>
<a href="#" class="back-to-top" id="backToTopBtn"><i class="fas fa-arrow-up"></i></a>

<script src="/web_fikom/assets/js/script.js"></script>

</body>
</html>
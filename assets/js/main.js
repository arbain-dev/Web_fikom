/**
 * Main JavaScript for Web FIKOM
 * Refactored & Consolidated
 */

/* =========================================
   GLOBAL STATE & HELPER FUNCTIONS
   ========================================= */
const App = {
    init: function () {
        this.initScrollAnimations();
        this.initMobileMenu();
        this.initNavbar();
        this.initHeroSlider();

        this.initPopups();
        this.initGlobalEvents();
    },

    /* 1. SCROLL ANIMATIONS */
    initScrollAnimations: function () {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    entry.target.classList.add('show'); // For compatibility

                    // Specific logic: Start stats counters
                    if (entry.target.classList.contains('stats-section') || entry.target.querySelector('.stat-number')) {
                        App.animateCounters();
                    }

                    // Specific logic: Start dosen card animations
                    if (entry.target.classList.contains('dosen-card')) {
                        entry.target.style.animationPlayState = 'running';
                    }

                    scrollObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Select all elements to animate
        const animatedElements = document.querySelectorAll(
            '.reveal-on-scroll, .reveal-left, .reveal-right, .stagger-container, ' +
            '.stats-section, .fade-in-up, .zoom-in, .fade, ' +
            '.glass-card, .lab-card, .ruangan-card, .kurikulum-card, .glass-table-box, .dosen-card'
        );

        animatedElements.forEach(el => scrollObserver.observe(el));

        // Stagger helper for hero
        const heroElements = document.querySelectorAll('.hero-himpunan .fade-in-up, .hero .fade-in-up');
        heroElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('is-visible');
                el.style.opacity = '1';
            }, index * 300);
        });
    },

    /* 2. MOBILE MENU */
    initMobileMenu: function () {
        // Exposed globally for HTML onClick compatibility
        window.toggleMobileMenu = function () {
            const navMenu = document.getElementById('navMenu');
            const overlay = document.getElementById('mobileOverlay');
            const hamburger = document.getElementById('hamburger');

            if (navMenu) {
                navMenu.classList.toggle('show');
                if (overlay) overlay.classList.toggle('show');

                if (hamburger) {
                    const icon = hamburger.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-bars');
                        icon.classList.toggle('fa-times');
                    }
                }
            }
        };

        // Internal Event Listeners
        const hamburger = document.getElementById('hamburger');
        const overlay = document.getElementById('mobileOverlay');

        if (hamburger) hamburger.addEventListener('click', window.toggleMobileMenu);
        if (overlay) overlay.addEventListener('click', window.toggleMobileMenu);

        // Mobile Dropdown Logic
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 992) {
                    const parent = link.parentElement;
                    if (parent.querySelector('.nav-dropdown')) {
                        e.preventDefault();
                        // Close others
                        document.querySelectorAll('.nav-item').forEach(item => {
                            if (item !== parent) item.classList.remove('open');
                        });
                        parent.classList.toggle('open');
                    }
                }
            });
        });
    },

    /* 3. NAVBAR SCROLL EFFECT */
    initNavbar: function () {
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });
    },

    /* 4. HERO SLIDER */
    initHeroSlider: function () {
        const slides = document.querySelectorAll('.hero-slide');
        if (slides.length === 0) return;

        const dotsContainer = document.getElementById('sliderDots');
        const btnPrev = document.getElementById('btnPrev');
        const btnNext = document.getElementById('btnNext');
        let currentSlide = 0;
        let slideInterval;

        // Setup Dots
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('slider-dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                stopAutoSlide();
                goToSlide(index);
                startAutoSlide();
            });
            if (dotsContainer) dotsContainer.appendChild(dot);
        });

        const dots = document.querySelectorAll('.slider-dot');

        function goToSlide(n) {
            slides[currentSlide].classList.remove('active');
            if (dots[currentSlide]) dots[currentSlide].classList.remove('active');

            currentSlide = (n + slides.length) % slides.length;

            slides[currentSlide].classList.add('active');
            if (dots[currentSlide]) dots[currentSlide].classList.add('active');
        }

        function nextSlide() { goToSlide(currentSlide + 1); }
        function prevSlide() { goToSlide(currentSlide - 1); }

        function startAutoSlide() { slideInterval = setInterval(nextSlide, 5000); }
        function stopAutoSlide() { clearInterval(slideInterval); }

        if (btnNext) btnNext.addEventListener('click', () => { stopAutoSlide(); nextSlide(); startAutoSlide(); });
        if (btnPrev) btnPrev.addEventListener('click', () => { stopAutoSlide(); prevSlide(); startAutoSlide(); });

        startAutoSlide();
    },

    /* 5. COUNTERS */
    countersLooping: false,
    animateCounters: function () {
        if (this.countersLooping) return;

        const counters = document.querySelectorAll('[data-count]');
        if (counters.length === 0) return;

        this.countersLooping = true;

        counters.forEach(counter => {
            const tempAttr = counter.getAttribute('data-count');
            if (!tempAttr) return;

            const target = +tempAttr;
            const duration = 4000; // "Tidak terlalu cepat" -> 4 seconds

            const runAnimation = () => {
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;

                    if (elapsed < duration) {
                        const progress = elapsed / duration;
                        // EaseOutQuart: 1 - (1-x)^4
                        const ease = 1 - Math.pow(1 - progress, 4);

                        // Ensure we don't exceed target
                        const currentVal = Math.ceil(ease * target);
                        counter.innerText = currentVal;

                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                        // "Bergerak terus" -> Loop after 3 seconds pause
                        setTimeout(() => {
                            // Optional: Smoothly reset or just jump to 0?
                            // Jumping to 0 and restarting is standard for simple loops
                            counter.innerText = 0;
                            runAnimation();
                        }, 3000);
                    }
                };

                requestAnimationFrame(updateCounter);
            };

            runAnimation();
        });
    },

    /* 6. POPUPS & MODALS (Consolidated) */
    initPopups: function () {

        // --- A. GENERIC CLOSE LOGIC ---
        // Close any active popup
        window.closePopup = function () {
            document.querySelectorAll('.popup').forEach(p => p.classList.remove('show'));
            document.querySelectorAll('.popup').forEach(p => p.style.display = 'none');
            document.body.style.overflow = 'auto'; // Restore scroll

            // Clear iframes/images to stop media
            const pdfFrame = document.getElementById('pdfFrame');
            if (pdfFrame) pdfFrame.src = '';
            const popupImg = document.getElementById('popupImg');
            if (popupImg) popupImg.src = '';
        };

        // Attach close listeners
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('popup') || e.target.id === 'popup') {
                window.closePopup();
            }
        });

        document.querySelectorAll('.close-btn, .popup-close, #popupCloseBtn, #closePopup').forEach(btn => {
            btn.addEventListener('click', window.closePopup);
        });

        // --- B. IMAGE / GALLERY POPUP ---
        window.showPopupImage = function (title, src) {
            const caption = document.getElementById('popupCaption');
            const img = document.getElementById('popupImg');
            const popup = document.getElementById('imagePopup') || document.getElementById('calendarPopup');

            if (caption) caption.textContent = title;
            if (img) img.src = src;
            if (popup) {
                popup.classList.add('show');
                popup.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        };

        // Attach Generic Image/Calendar Triggers
        document.querySelectorAll('.js-calendar-trigger, .dosen-card img').forEach(el => {
            el.addEventListener('click', function () {
                const src = this.getAttribute('data-img') || this.src;
                const title = this.getAttribute('alt') || 'Image Preview';
                window.showPopupImage(title, src);
            });
        });

        // --- C. DOSEN DETAIL POPUP ---
        window.showDosenDetail = function (data) {
            // Support both object passing or individual arguments via HTML onclick override if needed
            // But checking usage, most are likely updated to objects or we fix here.

            const popup = document.getElementById('dosenPopup') || document.getElementById('popup'); // Handle multiple IDs from old code
            if (!popup) return;

            const setText = (id, text) => {
                const el = document.getElementById(id) || document.getElementById('pop' + id.replace('popup', ''));
                if (el) el.textContent = text.startsWith(':') ? text : ": " + text;
            };

            // Special case for Name (Direct text, no colon)
            const elNama = document.getElementById('popupNama') || document.getElementById('popNama');
            if (elNama) elNama.textContent = data.nama;

            // Other fields with colon prefix
            setText('popupJabatan', data.jabatan);
            setText('popupNidn', data.nidn);
            setText('popupProdi', data.program_studi || data.prodi);
            setText('popupKeahlian', data.keahlian);
            setText('popupPendidikan', data.pendidikan);
            setText('popupStatus', data.status);
            // setText('popupStatus', data.status); // Removed duplicate line
            setText('popupEmail', data.email);

            // Update Email Button Href
            const btnEmail = document.getElementById('btnEmail');
            if (btnEmail) btnEmail.href = 'mailto:' + data.email;

            const img = document.getElementById('popupFoto') || document.getElementById('popFoto');
            if (img) img.src = data.foto;

            popup.classList.add('show');
            popup.style.display = 'flex';
        };

        // --- D. PDF / KURIKULUM POPUP ---
        window.showPdfPopup = function (title, path) {
            const popup = document.getElementById('pdfPopup');
            const frame = document.getElementById('pdfFrame');
            const titleEl = document.getElementById('popupTitle');
            const downloadBtn = document.getElementById('popupDownload');

            if (titleEl) titleEl.innerText = title;
            if (frame) frame.src = path;
            if (downloadBtn) downloadBtn.href = path;

            if (popup) {
                popup.classList.add('show');
                popup.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        };

        document.querySelectorAll('.content-btn, .btn-lihat').forEach(btn => {
            btn.addEventListener('click', function () {
                const file = this.getAttribute('data-file');
                const nama = this.getAttribute('data-nama');
                window.showPdfPopup('Dokumen: ' + nama, file);
            });
        });

        // --- E. PENELITIAN DETAIL POPUP ---
        window.showPenelitianDetail = function (data) {
            if (typeof data === 'string') {
                try { data = JSON.parse(data); } catch (e) { console.error("Invalid JSON", e); return; }
            }

            const popup = document.getElementById('detailPopup') || document.getElementById('popup');
            if (!popup) return;

            // Mapping for Penelitian Popup IDs
            const map = {
                'popJudul': data.judul,
                'popupJudul': data.judul,
                'popPeneliti': ": " + data.peneliti,
                'popupPeneliti': ": " + data.peneliti,
                'popTahun': ": " + data.tahun,
                'popupTahun': ": " + data.tahun,
                'popStatus': ": " + (data.status || '-'),
                'popupStatus': ": " + (data.status || '-'),
                'popDana': ": " + (data.sumber_dana || '-'),
                'popupSumberDana': ": " + (data.sumber_dana || '-')
            };

            for (const [id, val] of Object.entries(map)) {
                const el = document.getElementById(id);
                if (el) el.textContent = val;
            }

            const linkWrapper = document.getElementById('linkWrapper') || document.getElementById('popupLinkWrapper');
            const popLink = document.getElementById('popLink') || document.getElementById('popupLinkPublikasi');

            if (linkWrapper && popLink) {
                if (data.link_publikasi) {
                    linkWrapper.style.display = 'block';
                    popLink.href = data.link_publikasi;
                } else {
                    linkWrapper.style.display = 'none';
                }
            }

            popup.classList.add('show');
            popup.style.display = 'flex';
        };

        // Attach Generic Triggers for Penelitian/Dosen if data attributes exist
        document.querySelectorAll('.js-popup-trigger').forEach(card => {
            card.addEventListener('click', (event) => {
                const data = event.currentTarget.dataset;
                window.showPenelitianDetail(data); // Default to penelitian handler for this class
            });
        });
    },

    /* 7. GLOBAL EVENTS */
    initGlobalEvents: function () {
        // Parallax Effect
        const colors = document.querySelectorAll('.color-bg .color');
        if (colors.length > 0) {
            window.addEventListener('scroll', () => {
                const scrolled = window.scrollY;
                window.requestAnimationFrame(() => {
                    colors.forEach((color, index) => {
                        const speed = 0.08 + (index * 0.06);
                        color.style.transform = `translateY(${scrolled * speed}px)`;
                    });
                });
            });
        }
    }
};

// Initialize App
document.addEventListener('DOMContentLoaded', () => {
    App.init();
});

/* =========================================
   LEGACY/GLOBAL COMPATIBILITY LAYER
   (Mapping old function names to new Logic)
   ========================================= */

// Old: window.showPopup = function (title, src) // Used in Ruangan
// Old: window.showDosen = function (data) // Used in Dosen
// Old: window.showDetail = function (data) // Used in Penelitian
// Old: window.showPdf = function (title, path) // Used in Pengabdian/Kurikulum
// Old: function showDosenPopup(...) // Used in some Dosen files

window.showPopup = function (arg1, arg2) {
    // Determine intent based on arg types
    if (typeof arg1 === 'string' && typeof arg2 === 'string') {
        window.showPopupImage(arg1, arg2);
    } else if (typeof arg1 === 'object') {
        // Could be penelitian or dosen, try generic fallback
        // Ideally should update HTML to call specific functions
        console.warn('Ambiguous showPopup call, check HTML');
    }
};

window.showDosen = function (data) { window.showDosenDetail(data); };
window.showDetail = function (data) { window.showPenelitianDetail(data); };
window.showPdf = function (title, path) { window.showPdfPopup(title, path); };

// Compatibility for multi-argument calls
window.showDosenPopup = function (nama, nidn, jabatan, prodi, keahlian, pendidikan, status, email, foto) {
    window.showDosenDetail({
        nama, nidn, jabatan, program_studi: prodi, keahlian, pendidikan, status, email, foto
    });
};

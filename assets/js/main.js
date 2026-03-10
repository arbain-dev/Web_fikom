/**
 * JavaScript Utama untuk Web FIKOM
 * Refactoring & Konsolidasi
 */

/* =========================================
   STATE GLOBAL & FUNGSI BANTUAN
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

    /* 1. ANIMASI SCROLL */
    initScrollAnimations: function () {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    entry.target.classList.add('show'); // Untuk kompatibilitas

                    // Logika spesifik: Mulai penghitung statistik
                    if (entry.target.classList.contains('stats-section') || entry.target.querySelector('.stat-number')) {
                        App.animateCounters();
                    }

                    // Logika spesifik: Mulai animasi kartu dosen
                    if (entry.target.classList.contains('dosen-card')) {
                        entry.target.style.animationPlayState = 'running';
                    }

                    scrollObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Pilih semua elemen untuk dianimasikan
        const animatedElements = document.querySelectorAll(
            '.reveal-on-scroll, .reveal-left, .reveal-right, .stagger-container, ' +
            '.stats-section, .fade-in-up, .zoom-in, .fade, ' +
            '.glass-card, .lab-card, .ruangan-card, .kurikulum-card, .glass-table-box, .dosen-card'
        );

        animatedElements.forEach(el => scrollObserver.observe(el));

        // Bantuan stagger untuk hero
        const heroElements = document.querySelectorAll('.hero-himpunan .fade-in-up, .hero .fade-in-up');
        heroElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('is-visible');
                el.style.opacity = '1';
            }, index * 300);
        });
    },

    /* 2. MENU MOBILE */
    initMobileMenu: function () {
        // Diekspos secara global untuk kompatibilitas HTML onClick
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

        // Event Listeners Internal
        const hamburger = document.getElementById('hamburger');
        const overlay = document.getElementById('mobileOverlay');

        if (hamburger) hamburger.addEventListener('click', window.toggleMobileMenu);
        if (overlay) overlay.addEventListener('click', window.toggleMobileMenu);

        // Logika Dropdown Mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 992) {
                    const parent = link.parentElement;
                    if (parent.querySelector('.nav-dropdown')) {
                        e.preventDefault();
                        // Tutup yang lain
                        document.querySelectorAll('.nav-item').forEach(item => {
                            if (item !== parent) item.classList.remove('open');
                        });
                        parent.classList.toggle('open');
                    }
                }
            });
        });
    },

    /* 3. EFEK SCROLL NAVBAR */
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

    /* 4. SLIDER HERO */
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

    /* 5. COUNTERS (PENGHITUNG) */
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
            const duration = 4000; // "Tidak terlalu cepat" -> 4 detik

            const runAnimation = () => {
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;

                    if (elapsed < duration) {
                        const progress = elapsed / duration;
                        // EaseOutQuart: 1 - (1-x)^4
                        const ease = 1 - Math.pow(1 - progress, 4);

                        // Pastikan tidak melebihi target
                        const currentVal = Math.ceil(ease * target);
                        counter.innerText = currentVal;

                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                        // "Bergerak terus" -> Loop setelah jeda 3 detik
                        setTimeout(() => {
                            // Opsional: Reset halus atau langsung lompat ke 0?
                            // Lompat ke 0 dan restart adalah standar untuk loop sederhana
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

    /* 6. POPUPS & MODALS (Dikonsolidasi) */
    initPopups: function () {

        // --- A. LOGIKA TUTUP UMUM ---
        // Tutup popup aktif apa pun
        window.closePopup = function () {
            document.querySelectorAll('.popup').forEach(p => p.classList.remove('show'));
            document.querySelectorAll('.popup').forEach(p => p.style.display = 'none');
            document.body.style.overflow = 'auto'; // Kembalikan scroll

            // Bersihkan iframe/gambar untuk menghentikan media
            const pdfFrame = document.getElementById('pdfFrame');
            if (pdfFrame) pdfFrame.src = '';
            const popupImg = document.getElementById('popupImg');
            if (popupImg) popupImg.src = '';
        };

        // Pasang listener tutup
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('popup') || e.target.id === 'popup') {
                window.closePopup();
            }
        });

        document.querySelectorAll('.close-btn, .popup-close, #popupCloseBtn, #closePopup').forEach(btn => {
            btn.addEventListener('click', window.closePopup);
        });

        // --- B. POPUP GAMBAR ---
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

        // Pasang Pemicu Gambar/Kalender Umum
        document.querySelectorAll('.js-calendar-trigger, .dosen-card img').forEach(el => {
            el.addEventListener('click', function () {
                const src = this.getAttribute('data-img') || this.src;
                const title = this.getAttribute('alt') || 'Pratinjau Gambar';
                window.showPopupImage(title, src);
            });
        });

        // --- C. POPUP DETAIL DOSEN ---
        window.showDosenDetail = function (data) {
            // Mendukung pengiriman objek atau argumen individu melalui override HTML onclick jika diperlukan
            // Tapi memeriksa penggunaan, sebagian besar kemungkinan sudah diperbarui ke objek atau kita perbaiki di sini.

            const popup = document.getElementById('dosenPopup') || document.getElementById('popup'); // Menangani beberapa ID dari kode lama
            if (!popup) return;

            const setText = (id, text) => {
                const el = document.getElementById(id) || document.getElementById('pop' + id.replace('popup', ''));
                if (el) el.textContent = text.startsWith(':') ? text : ": " + text;
            };

            // Kasus khusus untuk Nama (Teks langsung, tanpa titik dua)
            const elNama = document.getElementById('popupNama') || document.getElementById('popNama');
            if (elNama) elNama.textContent = data.nama;

            // Kolom lain dengan prefix titik dua
            setText('popupJabatan', data.jabatan);
            setText('popupNidn', data.nidn);
            setText('popupProdi', data.program_studi || data.prodi);
            setText('popupKeahlian', data.keahlian);
            setText('popupPendidikan', data.pendidikan);
            setText('popupStatus', data.status);
            // setText('popupStatus', data.status); // Baris duplikat dihapus
            setText('popupEmail', data.email);

            // Perbarui Href Tombol Email
            const btnEmail = document.getElementById('btnEmail');
            if (btnEmail) btnEmail.href = 'mailto:' + data.email;

            const img = document.getElementById('popupFoto') || document.getElementById('popFoto');
            if (img) img.src = data.foto;

            popup.classList.add('show');
            popup.style.display = 'flex';
        };

        // --- D. POPUP PDF / KURIKULUM ---
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

        // --- E. POPUP DETAIL PENELITIAN ---
        window.showPenelitianDetail = function (data) {
            if (typeof data === 'string') {
                try { data = JSON.parse(data); } catch (e) { console.error("JSON Tidak Valid", e); return; }
            }

            const popup = document.getElementById('detailPopup') || document.getElementById('popup');
            if (!popup) return;

            // Pemetaan untuk ID Popup Penelitian
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

        // Pasang Pemicu Umum untuk Penelitian/Dosen jika atribut data ada
        document.querySelectorAll('.js-popup-trigger').forEach(card => {
            card.addEventListener('click', (event) => {
                const data = event.currentTarget.dataset;
                window.showPenelitianDetail(data); // Default ke handler penelitian untuk kelas ini
            });
        });
    },

    /* 7. EVENT GLOBAL */
    initGlobalEvents: function () {
        // Efek Parallax
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

// Inisialisasi App
document.addEventListener('DOMContentLoaded', () => {
    App.init();
});

/* =========================================
   LAYER KOMPATIBILITAS LEGACY/GLOBAL
   (Memetakan nama fungsi lama ke Logika baru)
   ========================================= */

// Lama: window.showPopup = function (title, src) // Digunakan di Ruangan
// Lama: window.showDosen = function (data) // Digunakan di Dosen
// Lama: window.showDetail = function (data) // Digunakan di Penelitian
// Lama: window.showPdf = function (title, path) // Digunakan di Pengabdian/Kurikulum
// Lama: function showDosenPopup(...) // Digunakan di beberapa file Dosen

window.showPopup = function (arg1, arg2) {
    // Tentukan maksud berdasarkan tipe arg
    if (typeof arg1 === 'string' && typeof arg2 === 'string') {
        window.showPopupImage(arg1, arg2);
    } else if (typeof arg1 === 'object') {
        // Bisa jadi penelitian atau dosen, coba fallback umum
        // Idealnya harus memperbarui HTML untuk memanggil fungsi spesifik
        console.warn('Panggilan showPopup ambigu, periksa HTML');
    }
};

window.showDosen = function (data) { window.showDosenDetail(data); };
window.showDetail = function (data) { window.showPenelitianDetail(data); };
window.showPdf = function (title, path) { window.showPdfPopup(title, path); };

// Kompatibilitas untuk panggilan multi-argumen
window.showDosenPopup = function (nama, nidn, jabatan, prodi, keahlian, pendidikan, status, email, foto) {
    window.showDosenDetail({
        nama, nidn, jabatan, program_studi: prodi, keahlian, pendidikan, status, email, foto
    });
};

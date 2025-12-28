/**
 * Main JavaScript for Web FIKOM
 * Handles Animations, Slider, and Mobile Menu
 */

document.addEventListener('DOMContentLoaded', () => {

    /* =========================================
       1. SCROLL ANIMATIONS (IntersectionObserver)
       ========================================= */
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');

                // If it's a stats section, trigger counters
                if (entry.target.classList.contains('stats-section') || entry.target.querySelector('.stat-number')) {
                    animateCounters();
                }

                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.reveal-on-scroll, .reveal-left, .reveal-right, .stagger-container, .stats-section');
    animatedElements.forEach(el => scrollObserver.observe(el));


    /* =========================================
       2. MOBILE MENU & DROPDOWNS
       ========================================= */
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    const overlay = document.getElementById('mobileOverlay');
    const navLinks = document.querySelectorAll('.nav-link');

    function toggleMenu() {
        navMenu.classList.toggle('show');
        if (overlay) overlay.classList.toggle('show');

        const icon = hamburger.querySelector('i');
        if (navMenu.classList.contains('show')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }

    if (hamburger) {
        hamburger.addEventListener('click', toggleMenu);
    }

    if (overlay) {
        overlay.addEventListener('click', toggleMenu);
    }

    // Mobile Dropdown Toggle
    navLinks.forEach(link => {
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

    // Navbar Scroll Effect
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


    /* =========================================
       3. HERO SLIDER
       ========================================= */
    const slides = document.querySelectorAll('.hero-slide');
    const dotsContainer = document.getElementById('sliderDots');
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    let currentSlide = 0;
    let slideInterval;

    if (slides.length > 0) {
        // Create Dots
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

        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        function prevSlide() {
            goToSlide(currentSlide - 1);
        }

        function startAutoSlide() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(slideInterval);
        }

        if (btnNext) {
            btnNext.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });
        }

        if (btnPrev) {
            btnPrev.addEventListener('click', () => {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });
        }

        startAutoSlide();
    }


    /* =========================================
       4. COUNTER ANIMATION
       ========================================= */
    /* =========================================
       4. COUNTER ANIMATION (Infinite Loop)
       ========================================= */
    let countersStarted = false;

    function animateCounters() {
        // Only trigger once to start the loops, preventing double-starts on scroll
        if (countersStarted) return;

        const counters = document.querySelectorAll('[data-count]');
        if (counters.length === 0) return;

        countersStarted = true;

        counters.forEach(counter => {
            const target = +counter.getAttribute('data-count');
            const duration = 4000; // Slower duration (4s) for smoother visualization
            const pause = 3000;    // Wait time

            // Easing function: easeOutExpo
            // t = current time, b = start value, c = change in value, d = duration
            const easeOutExpo = (t, b, c, d) => {
                return (t === d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
            };

            const startLoop = () => {
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;

                    if (elapsed < duration) {
                        const progress = easeOutExpo(elapsed, 0, target, duration);
                        counter.innerText = Math.ceil(progress);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                        // Wait then restart
                        setTimeout(startLoop, pause);
                    }
                };

                requestAnimationFrame(updateCounter);
            };

            startLoop();
        });
    }


    /* =========================================
       5. POPUP / LIGHTBOX LOGIC
       ========================================= */
    // Lightbox for Ruangan/Gallery
    window.showPopup = function (title, src) {
        const caption = document.getElementById('popupCaption');
        const img = document.getElementById('popupImg');
        const popup = document.getElementById('imagePopup');

        if (caption) caption.textContent = title;
        if (img) img.src = src;
        if (popup) popup.classList.add('show');
    };

    window.closePopup = function () {
        const popups = document.querySelectorAll('.popup');
        popups.forEach(p => {
            p.classList.remove('show');
            p.classList.remove('active');
        });
    };

    // Close popup when clicking outside
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('popup')) {
            closePopup();
        }
    });

    // Popup for Dosen Detail
    window.showDosen = function (data) {
        const popup = document.getElementById('dosenPopup');
        if (!popup) return;

        // Helper to safe set text
        const setText = (id, text) => {
            const el = document.getElementById(id);
            if (el) el.textContent = text;
        };

        const setSrc = (id, src) => {
            const el = document.getElementById(id);
            if (el) el.src = src;
        };

        const setHref = (id, href) => {
            const el = document.getElementById(id);
            if (el) el.href = href;
        };

        setSrc('popFoto', data.foto);
        setText('popNama', data.nama);
        setText('popJabatan', data.jabatan);
        setText('popNidn', data.nidn);
        setText('popProdi', data.program_studi);
        setText('popKeahlian', data.keahlian);
        setText('popPendidikan', data.pendidikan);
        setText('popStatus', data.status);
        setHref('popEmail', 'mailto:' + data.email);

        popup.classList.add('show');
    };

    // Popup for Penelitian Detail
    window.showDetail = function (data) {
        // Ensure data is object
        if (typeof data === 'string') {
            try {
                data = JSON.parse(data);
            } catch (e) { console.error("Invalid JSON data", e); return; }
        }

        const setText = (id, text) => {
            const el = document.getElementById(id);
            if (el) el.textContent = text;
        };

        setText('popJudul', data.judul);
        setText('popPeneliti', data.peneliti);
        setText('popTahun', data.tahun);
        setText('popStatus', data.status || '-');
        setText('popDana', data.sumber_dana || '-');

        const linkWrapper = document.getElementById('linkWrapper');
        const popLink = document.getElementById('popLink');

        if (data.link_publikasi && popLink) {
            if (linkWrapper) linkWrapper.style.display = 'block';
            popLink.href = data.link_publikasi;
        } else {
            if (linkWrapper) linkWrapper.style.display = 'none';
        }

        const popup = document.getElementById('detailPopup');
        if (popup) popup.classList.add('show');
    };

    // Popup for PDF (Pengabdian)
    window.showPdf = function (title, path) {
        const titleEl = document.getElementById('popupTitle');
        const frame = document.getElementById('pdfFrame');
        const popup = document.getElementById('pdfPopup');
        const downloadBtn = document.getElementById('popupDownload');

        if (titleEl) titleEl.innerText = title;
        if (frame) frame.src = path;
        if (popup) popup.classList.add('show');
        if (downloadBtn) downloadBtn.href = path;
        document.body.style.overflow = "hidden";
    };

    window.closePdf = function () {
        const popup = document.getElementById('pdfPopup');
        const frame = document.getElementById('pdfFrame');
        if (popup) popup.classList.remove('show');
        if (frame) frame.src = '';
        document.body.style.overflow = "auto";
    };

    window.closePopup = function () {
        document.querySelectorAll('.popup').forEach(p => p.classList.remove('show'));
    };

    /* =========================================
       6. SHARED ANIMATIONS (Fade In Up / Zoom)
       ========================================= */
    const animObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.classList.add('show'); // For alumni fade
            }
        });
    }, { threshold: 0.1 });

    const animElements = document.querySelectorAll('.fade-in-up, .zoom-in, .fade');
    animElements.forEach(el => animObserver.observe(el));

    // Stagger for hero elements if present
    const heroElements = document.querySelectorAll('.hero-himpunan .fade-in-up, .hero .fade-in-up');
    heroElements.forEach((el, index) => {
        setTimeout(() => {
            el.style.opacity = '1';
        }, index * 300);
    });

    /* =========================================
       7. PARALLAX EFFECT (Background Blobs)
       ========================================= */
    const colors = document.querySelectorAll('.color-bg .color');
    if (colors.length > 0) {
        let ticking = false;
        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(function () {
                    const scrolled = window.scrollY;
                    colors.forEach((color, index) => {
                        const speed = 0.08 + (index * 0.06);
                        color.style.transform = `translateY(${scrolled * speed}px)`;
                    });
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

});
document.addEventListener('DOMContentLoaded', () => {

    // ============================================================
    //               ELEMENT POPUP (PDF & DETAIL PENELITIAN)
    // ============================================================
    const cards = document.querySelectorAll('.card');
    window.addEventListener('scroll', () => {
        cards.forEach(card => {
            const top = card.getBoundingClientRect().top;
            if (top < window.innerHeight - 50) {
                card.style.animationPlayState = 'running';
            }
        });
    });

    const popup = document.getElementById('popup');
    if (popup) {
        const allClickableCards = document.querySelectorAll('.js-popup-trigger');
        const closeBtn = popup.querySelector('.close-btn');

        function showPopup(data) {
            const popupJudul = document.getElementById('popupJudul');
            const popupPeneliti = document.getElementById('popupPeneliti');
            const popupTahun = document.getElementById('popupTahun');
            const popupStatus = document.getElementById('popupStatus');
            const popupSumberDana = document.getElementById('popupSumberDana');
            const linkWrapper = document.getElementById('popupLinkWrapper');
            const linkBtn = document.getElementById('popupLinkPublikasi');

            if (popupJudul) popupJudul.textContent = data.judul;
            if (popupPeneliti) popupPeneliti.textContent = ": " + data.peneliti;
            if (popupTahun) popupTahun.textContent = ": " + data.tahun;
            if (popupStatus) popupStatus.textContent = ": " + data.status;
            if (popupSumberDana) popupSumberDana.textContent = ": " + data.sumber_dana;

            if (linkWrapper && linkBtn) {
                if (data.link_publikasi) {
                    linkBtn.href = data.link_publikasi;
                    linkWrapper.style.display = 'block';
                } else {
                    linkWrapper.style.display = 'none';
                }
            }
            popup.style.display = 'flex';
        }

        function closePopup() {
            popup.style.display = 'none';
        }

        allClickableCards.forEach(card => {
            card.addEventListener('click', (event) => {
                const data = event.currentTarget.dataset;
                showPopup(data);
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closePopup);
        }

        popup.addEventListener('click', (event) => {
            if (event.target === popup) {
                closePopup();
            }
        });
    }

    // ==================================================
    // POPUP GAMBAR KALENDER AKADEMIK
    // ==================================================
    const calendarPopup = document.getElementById("calendarPopup");
    const popupImg = document.getElementById("popupImg");
    const closeImg = document.getElementById("popupCloseBtn");

    if (calendarPopup && popupImg && closeImg) {
        document.querySelectorAll(".js-calendar-trigger").forEach(card => {
            card.addEventListener("click", () => {
                popupImg.src = card.getAttribute("data-img");
                calendarPopup.style.display = "flex";
                document.body.style.overflow = "hidden";
            });
        });

        closeImg.addEventListener("click", () => {
            calendarPopup.style.display = "none";
            popupImg.src = "";
            document.body.style.overflow = "auto";
        });

        calendarPopup.addEventListener("click", e => {
            if (e.target === calendarPopup) {
                calendarPopup.style.display = "none";
                popupImg.src = "";
                document.body.style.overflow = "auto";
            }
        });
    }

    // ============================================================
    //                       SCROLL ANIMATION
    // ============================================================
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity = 1;
                e.target.style.transform = "translateY(0)";
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll(
        ".glass-card, .lab-card, .ruangan-card, .kurikulum-card, .glass-table-box"
    ).forEach(el => {
        el.style.opacity = 0;
        el.style.transform = "translateY(30px)";
        observer.observe(el);
    });

});

// --- FUNGSI UNTUK HALAMAN DOSEN ---

function showPopup(nama, nidn, jabatan, prodi, keahlian, pendidikan, status, email, foto) {
    const popup = document.getElementById('popup');
    if (popup) {
        document.getElementById('popupNama').textContent = nama;
        document.getElementById('popupJabatan').textContent = ": " + jabatan;
        document.getElementById('popupNidn').textContent = ": " + nidn;
        document.getElementById('popupProdi').textContent = ": " + prodi;
        document.getElementById('popupKeahlian').textContent = ": " + keahlian;
        document.getElementById('popupPendidikan').textContent = ": " + pendidikan;
        document.getElementById('popupStatus').textContent = ": " + status;
        document.getElementById('popupEmail').textContent = ": " + email;
        document.getElementById('popupFoto').src = foto;

        popup.style.display = 'flex';
    }
}

function closePopup() {
    const popup = document.getElementById('popup');
    if (popup) popup.style.display = 'none';
}

window.onclick = function (event) {
    const popup = document.getElementById('popup');
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.dosen-card');
    if (cards.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        cards.forEach(card => {
            card.style.animationPlayState = 'paused';
            observer.observe(card);
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('pdfPopup');
    if (popup) {
        const pdfFrame = document.getElementById('pdfFrame');
        const popupTitle = document.getElementById('popupTitle');
        const closeBtn = document.getElementById('closePopup');
        const buttons = document.querySelectorAll('.btn-lihat');

        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                const filePath = this.getAttribute('data-file');
                const judul = this.getAttribute('data-nama');

                if (filePath && pdfFrame && popupTitle) {
                    pdfFrame.src = filePath;
                    popupTitle.textContent = 'Laporan: ' + judul;
                    popup.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                } else {
                    alert("Lokasi file tidak ditemukan.");
                }
            });
        });
        function closePopupFunc() {
            popup.style.display = 'none';
            pdfFrame.src = '';
            document.body.style.overflow = 'auto';
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', closePopupFunc);
        }
        if (popup) {
            popup.addEventListener('click', function (e) {
                if (e.target === popup) {
                    closePopupFunc();
                }
            });
        }
    }
});

function showDosenPopup(nama, nidn, jabatan, prodi, keahlian, pendidikan, status, email, foto) {
    const popup = document.getElementById('dosenPopup');
    if (popup) {
        document.getElementById('popNama').textContent = nama;
        document.getElementById('popJabatan').textContent = ": " + jabatan;
        document.getElementById('popNidn').textContent = ": " + nidn;
        document.getElementById('popProdi').textContent = ": " + prodi;
        document.getElementById('popKeahlian').textContent = ": " + keahlian;
        document.getElementById('popPendidikan').textContent = ": " + pendidikan;
        document.getElementById('popStatus').textContent = ": " + status;
        document.getElementById('popEmail').textContent = ": " + email;
        document.getElementById('popFoto').src = foto;

        popup.style.display = 'flex';
    }
}

function closeDosenPopup() {
    const popup = document.getElementById('dosenPopup');
    if (popup) popup.style.display = 'none';
}

window.addEventListener('click', function (event) {
    const popup = document.getElementById('dosenPopup');
    if (event.target == popup) {
        popup.style.display = "none";
    }
});
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.dosen-card');
    if (cards.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        });
        cards.forEach(card => {
            card.style.animationPlayState = 'paused';
            observer.observe(card);
        });
    }
    if (window.location.pathname.includes('dosen.php')) {
        document.body.classList.add('page-dosen');
    }
});

/* =========================================
   GLOBAL FUNCTIONS (Called from HTML)
   ========================================= */

window.toggleMobileMenu = function () {
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    const overlay = document.getElementById('mobileOverlay');

    if (navMenu) {
        navMenu.classList.toggle('show');

        // Handle overlay
        if (overlay) overlay.classList.toggle('show');

        // Handle icon change
        if (hamburger) {
            const icon = hamburger.querySelector('i');
            if (icon) {
                if (navMenu.classList.contains('show')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        }
    }
};

window.toggleDropdown = function (event, element) {
    if (window.innerWidth <= 992) {
        event.preventDefault();
        const parent = element.parentElement;

        // Close other dropdowns
        const allItems = document.querySelectorAll('.nav-item');
        allItems.forEach(item => {
            if (item !== parent && item.classList.contains('open')) {
                item.classList.remove('open');
            }
        });

        // Toggle current
        if (parent) {
            parent.classList.toggle('open');
        }
    }
};

/* =========================================================
   KURIKULUM PDF POPUP
   Aman untuk script.js global
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const popup = document.getElementById("pdfPopup");
    if (!popup) return;
    const pdfFrame = document.getElementById("pdfFrame");
    const popupTitle = document.getElementById("popupTitle");
    const closePopup = document.getElementById("closePopup");

    document.querySelectorAll(".content-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const file = this.getAttribute("data-file");
            const nama = this.getAttribute("data-nama");
            pdfFrame.src = file;
            popupTitle.textContent = "Kurikulum " + nama;
            popup.style.display = "flex";
            document.body.style.overflow = "hidden";
        });
    });

    if (closePopup) {
        closePopup.addEventListener("click", function () {
            popup.style.display = "none";
            pdfFrame.src = "";
            document.body.style.overflow = "auto";
        });
    }
    popup.addEventListener("click", function (e) {
        if (e.target === popup) {
            popup.style.display = "none";
            pdfFrame.src = "";
            document.body.style.overflow = "auto";
        }
    });

});

/* =========================================================
   KALENDER AKADEMIK POPUP
   Aman untuk script.js global
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const calendarPopup = document.getElementById("calendarPopup");
    if (!calendarPopup) return; // bukan halaman kalender

    const popupImg = document.getElementById("popupImg");
    const closeBtn = document.getElementById("popupCloseBtn");

    document.querySelectorAll(".js-calendar-trigger").forEach(card => {
        card.addEventListener("click", function () {
            const img = this.getAttribute("data-img");
            popupImg.src = img;
            calendarPopup.style.display = "flex";
            document.body.style.overflow = "hidden";
        });
    });

    closeBtn.addEventListener("click", function () {
        calendarPopup.style.display = "none";
        popupImg.src = "";
        document.body.style.overflow = "auto";
    });

    calendarPopup.addEventListener("click", function (e) {
        if (e.target === calendarPopup) {
            calendarPopup.style.display = "none";
            popupImg.src = "";
            document.body.style.overflow = "auto";
        }
    });

});

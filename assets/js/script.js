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
    const allClickableCards = document.querySelectorAll('.js-popup-trigger');
    const closeBtn = popup.querySelector('.close-btn');
    function showPopup(data) {
        document.getElementById('popupJudul').textContent = data.judul;
        document.getElementById('popupPeneliti').textContent = ": " + data.peneliti;
        document.getElementById('popupTahun').textContent = ": " + data.tahun;
        document.getElementById('popupStatus').textContent = ": " + data.status;
        document.getElementById('popupSumberDana').textContent = ": " + data.sumber_dana;
        const linkWrapper = document.getElementById('popupLinkWrapper');
        const linkBtn = document.getElementById('popupLinkPublikasi');
        if (data.link_publikasi) { // 'data.link_publikasi' BUKAN 'link_publikasi'
            linkBtn.href = data.link_publikasi;
            linkWrapper.style.display = 'block';
        } else {
            linkWrapper.style.display = 'none';
        }
        popup.style.display = 'flex';
    }

    function closePopup() {
        popup.style.display = 'none';
    }
    allClickableCards.forEach(card => {
        card.addEventListener('click', (event) => {
            // Ambil data dari data-attributes
            const data = event.currentTarget.dataset;
            showPopup(data);
        });
    });
    closeBtn.addEventListener('click', closePopup); 
    popup.addEventListener('click', (event) => {
        if (event.target === popup) {
            closePopup();
        }
    });

// ==================================================
// POPUP GAMBAR KALENDER AKADEMIK
// ==================================================
const calendarPopup = document.getElementById("calendarPopup");
const popupImg = document.getElementById("popupImg");
const closeImg = document.getElementById("popupCloseBtn");

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
    function openPopup(data) {
        if (!popup) return;
        if (pdfFrame && data.file) {
            pdfFrame.src = data.file;
        }
        if (detailPeneliti && data.peneliti) {
            popupJudul.textContent = data.judul || "Detail Penelitian";
            detailPeneliti.textContent = ": " + (data.peneliti || "-");
            detailTahun.textContent = ": " + (data.tahun || "-");
            detailStatus.textContent = ": " + (data.status || "-");
            detailDana.textContent = ": " + (data.sumber_dana || "-");
            if (data.link_publikasi) {
                detailLink.href = data.link_publikasi;
                detailWrapper.style.display = 'block';
            } else {
                detailWrapper.style.display = 'none';
            }
        }
        popup.style.display = "flex";
        document.body.style.overflow = "hidden";
    }

    function closePopup() {
        if (!popup) return;
        popup.style.display = "none";
        if (pdfFrame) pdfFrame.src = ""; 
        document.body.style.overflow = "auto";
    }
    allButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const data = {
                file: btn.dataset.file || "",
                judul: btn.dataset.judul,
                peneliti: btn.dataset.peneliti,
                tahun: btn.dataset.tahun,
                status: btn.dataset.status,
                sumber_dana: btn.dataset.sumber_dana,
                link_publikasi: btn.dataset.link_publikasi
            };
            openPopup(data);
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', closePopup);
    if (popup) {
        popup.addEventListener('click', (e) => {
            if (e.target === popup) closePopup();
        });
    }
    window.addEventListener('keydown', (e) => {
        if (e.key === "Escape") closePopup();
    });

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
    if(popup) {
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
    if(popup) popup.style.display = 'none';
}

window.onclick = function(event) {
    const popup = document.getElementById('popup');
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.dosen-card');
    if(cards.length > 0) {
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

document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('pdfPopup');
    const pdfFrame = document.getElementById('pdfFrame');
    const popupTitle = document.getElementById('popupTitle');
    const closeBtn = document.getElementById('closePopup');
    const buttons = document.querySelectorAll('.btn-lihat');
    console.log("Jumlah tombol ditemukan: " + buttons.length);
    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            const filePath = this.getAttribute('data-file');
            const judul = this.getAttribute('data-nama');

            console.log("Tombol diklik! File:", filePath);
            if (filePath) {
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
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                closePopupFunc();
            }
        });
    }
});
function showDosenPopup(nama, nidn, jabatan, prodi, keahlian, pendidikan, status, email, foto) {
    const popup = document.getElementById('dosenPopup');
    if(popup) {
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
    if(popup) popup.style.display = 'none';
}

window.addEventListener('click', function(event) {
    const popup = document.getElementById('dosenPopup');
    if (event.target == popup) {
        popup.style.display = "none";
    }
});
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.dosen-card');
    if(cards.length > 0) {
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

/* =========================================================
   KURIKULUM PDF POPUP
   Aman untuk script.js global
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const popup = document.getElementById("pdfPopup");
    if (!popup) return; 
    const pdfFrame   = document.getElementById("pdfFrame");
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
    closePopup.addEventListener("click", function () {
        popup.style.display = "none";
        pdfFrame.src = "";
        document.body.style.overflow = "auto";
    });
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

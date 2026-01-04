<?php
/**
 * Frontend Footer Component
 * Clean & Modern Design System
 */
?>

<!-- Footer -->
<!-- Footer -->
<footer class="footer-dark">
    <div class="container">
        <div class="footer-grid-modern">
            <!-- Brand Column -->
            <div class="footer-brand">
                <h3>Fakultas Ilmu Komputer</h3>
                <p>Universitas Ichsan - UNISAN Sidenreng Rappang<br>Mencetak Generasi Unggul di Bidang Teknologi.</p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/share/1A7pWq9jEJ/" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/fikomunisansidrap?igsh=MWdjZWlxNm12bmxyMg==" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://wa.me/6282215322757" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="footer-title-modern">Quick Links</h4>
                <ul class="footer-links-modern">
                    <li><a href="visi-misi.php"><i class="fas fa-chevron-right text-xs"></i> Visi & Misi</a></li>
                    <li><a href="dosen.php"><i class="fas fa-chevron-right text-xs"></i> Dosen</a></li>
                    <li><a href="kurikulum.php"><i class="fas fa-chevron-right text-xs"></i> Kurikulum</a></li>
                    <li><a href="kalender.php"><i class="fas fa-chevron-right text-xs"></i> Kalender Akademik</a></li>
                    <li><a href="pendaftaran.php"><i class="fas fa-chevron-right text-xs"></i> Pendaftaran Mahasiswa</a></li>
                </ul>
            </div>

            <!-- Program Studi -->
            <div>
                <h4 class="footer-title-modern">Program Studi</h4>
                <ul class="footer-links-modern">
                    <li><a href="index_ti.php"><i class="fas fa-laptop-code text-xs"></i> S1 Informatika</a></li>
                    <li><a href="index_pti.php"><i class="fas fa-chalkboard-teacher text-xs"></i> S1 Pend. Teknologi Informasi</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="footer-title-modern">Kontak</h4>
                <ul class="footer-links-modern">
                    <li><i class="fas fa-map-marker-alt"></i> Sekarara, Sidenreng Rappang, Sulsel</li>
                    <li><i class="fas fa-phone"></i> (0421) XXXXXXX</li>
                    <li><i class="fas fa-envelope"></i> fikom@unisan.ac.id</li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom-modern">
            <p>&copy; <?= date('Y') ?> Muhammad Arbain. All Rights Reserved. | <a href="#" style="color: inherit; text-decoration: underline;">Privacy Policy</a></p>
        </div>
    </div>
</footer>

<!-- Core JavaScript -->
<!-- Main Scripts -->
    <script src="<?= BASE_URL ?>/assets/js/main.js?v=<?= time() ?>"></script>
</body>
</html>

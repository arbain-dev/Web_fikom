<?php
/**
 * Sambutan Dekan Page
 */

require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Sambutan Dekan</h1>
        <p class="page-subtitle">Fakultas Ilmu Komputer Universitas Ichsan Sidenreng Rappang</p>
    </div>
</header>

<!-- Custom CSS for Sambutan Page -->
<style>
    .sambutan-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
        align-items: start;
    }

    @media (min-width: 992px) {
        .sambutan-grid {
            grid-template-columns: 2fr 1fr; /* 2/3 for text, 1/3 for image */
        }
    }
    
    .dean-image-container {
        position: sticky;
        top: 100px;
    }
</style>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="card p-8 md:p-12 shadow-lg">
            <div class="sambutan-grid">
                
                <!-- Text Content (Left) -->
                <div class="space-y-6 text-gray-700 leading-relaxed text-justify">
                    <h3 class="text-xl font-bold text-primary-700 mb-4">
                        Assalamu’alaikum warahmatullahi wabarakatuh,<br>
                        Salam sejahtera bagi kita semua.
                    </h3>

                    <p>
                        Puji dan syukur kita panjatkan ke hadirat Allah SWT atas segala limpahan rahmat dan karunia-Nya. 
                        Dengan penuh rasa bangga, kami menyambut seluruh pengunjung di website resmi Fakultas Ilmu Komputer 
                        Universitas Ichsan Sidenreng Rappang.
                    </p>

                    <p>
                        Website ini merupakan media informasi dan komunikasi resmi Fakultas Ilmu Komputer yang bertujuan 
                        untuk memberikan gambaran menyeluruh mengenai profil fakultas, program studi, kegiatan akademik, 
                        penelitian, pengabdian kepada masyarakat, serta berbagai prestasi civitas akademika. Kami berharap 
                        kehadiran website ini dapat menjadi sarana yang informatif, transparan, dan mudah diakses oleh 
                        mahasiswa, dosen, tenaga kependidikan, alumni, mitra, serta masyarakat luas.
                    </p>

                    <p>
                        Fakultas Ilmu Komputer berkomitmen menyelenggarakan pendidikan tinggi yang berkualitas di bidang 
                        teknologi informasi dan komputer, dengan menekankan penguasaan ilmu pengetahuan, keterampilan praktik, 
                        inovasi, serta karakter dan etika akademik.
                    </p>

                    <p>
                        Di era transformasi digital, kami terus mendorong terciptanya lingkungan akademik yang kreatif, 
                        kolaboratif, dan berorientasi pada solusi untuk menghasilkan lulusan yang kompeten, berdaya saing, 
                        dan siap menghadapi tantangan global.
                    </p>

                    <p>
                        Kami menyadari bahwa tantangan di era transformasi digital menuntut perguruan tinggi untuk terus 
                        berinovasi dan beradaptasi. Oleh karena itu, Fakultas Ilmu Komputer senantiasa mendorong terciptanya 
                        lingkungan akademik yang kreatif, kolaboratif, dan berorientasi pada solusi, guna menghasilkan lulusan 
                        yang kompeten, berdaya saing, dan siap berkontribusi bagi pembangunan daerah maupun nasional.
                    </p>

                    <p>
                        Akhir kata, kami mengucapkan terima kasih atas kunjungan Anda ke website Fakultas Ilmu Komputer. 
                        Semoga informasi yang kami sajikan dapat memberikan manfaat dan menjadi jembatan komunikasi yang baik 
                        antara fakultas dengan seluruh pemangku kepentingan.
                    </p>
                    
                    <p class="font-medium text-gray-800 mt-8">
                        Wassalamu’alaikum warahmatullahi wabarakatuh.
                    </p>
                </div>

                <!-- Image and Profile (Right) -->
                <div class="dean-image-container">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transform hover:-translate-y-1 transition-transform duration-300">
                        <!-- Image Container -->
                        <div class="aspect-[3/4] overflow-hidden bg-gray-100 relative">
                            <!-- Dean's Image -->
                            <img src="assets/img/i.jpg" 
                                 onerror="this.src='assets/img/i.jpg'" 
                                 alt="Dekan FIKOM" 
                                 class="w-full h-full object-cover object-top"
                                 style="width: 100%; height: auto; display: block;">
                        </div>
                        
                        <!-- Profile Info -->
                        <div class="p-6 text-center bg-gray-50 border-t border-gray-100">
                            <h4 class="text-xl font-bold text-gray-900 mb-1">Azwar, S. Kom., M. Kom</h4>
                            <div class="text-primary-600 font-semibold mb-4">Dekan Periode 2026–2030</div>
                            
                            <div class="relative">
                                <i class="fas fa-quote-left text-primary-200 text-2xl absolute -top-2 -left-2" style="position: absolute; top: -10px; left: 0;"></i>
                                <p class="text-gray-600 italic text-sm px-4 relative z-10" style="padding: 0 1rem;">
                                    "Computer is Solution, Teaching for Impact"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

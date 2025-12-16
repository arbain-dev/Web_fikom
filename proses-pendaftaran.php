<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pendaftaran Online - UNISAN Sidrap</title>

  <!-- Font Awesome (kalau belum ada di header, boleh hapus kalau sudah) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    :root{
      --blue:#3498db;
      --blue2:#2980b9;
      --yellow:#f1c40f;
      --bg1:#051636;
      --bg2:#020d20;
      --card: rgba(255,255,255,.08);
      --border: rgba(255,255,255,.18);
      --text:#fff;
      --muted:#d9d9d9;
      --danger:#e74c3c;
      --success:#2ecc71;
    }

    body{
      margin:0;
      font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background: linear-gradient(to right bottom, var(--bg1), var(--bg2));
      color:var(--text);
      min-height:100vh;
      overflow-x:hidden;
    }

    /* background blobs */
    .color-bg{
      position:fixed; inset:0; z-index:0; pointer-events:none; opacity:.35;
    }
    .color{ position:absolute; filter: blur(180px); }
    .color:nth-child(1){
      top:-350px; width:600px; height:600px; background:#ff359b;
    }
    .color:nth-child(2){
      bottom:-150px; left:100px; width:520px; height:520px; background:#fffd87;
    }
    .color:nth-child(3){
      bottom:50px; right:100px; width:320px; height:320px; background:#00d2ff;
    }

    .wrap{
      position:relative;
      z-index:2;
      max-width:1200px;
      margin:0 auto;
      padding:50px 18px 80px;
    }

    .hero{
      display:flex;
      gap:22px;
      align-items:center;
      justify-content:space-between;
      padding:26px 26px;
      border-radius:18px;
      background:rgba(255,255,255,.06);
      border:1px solid var(--border);
      backdrop-filter: blur(12px);
      overflow:hidden;
      margin-bottom:22px;
    }

    .hero-left{
      max-width:720px;
    }
    .hero-title{
      font-size:2.1rem;
      margin:0 0 8px;
      font-weight:800;
      letter-spacing:.2px;
      text-shadow: 0 8px 24px rgba(0,0,0,.35);
    }
    .hero-sub{
      margin:0;
      color:var(--muted);
      line-height:1.6;
      font-size:1rem;
    }

    .hero-badge{
      display:flex;
      flex-direction:column;
      gap:10px;
      align-items:flex-end;
    }
    .badge{
      display:inline-flex;
      gap:10px;
      align-items:center;
      padding:10px 14px;
      border-radius:999px;
      background:rgba(52,152,219,.16);
      border:1px solid rgba(52,152,219,.35);
      font-weight:600;
      font-size:.95rem;
      white-space:nowrap;
    }
    .badge i{ color:var(--yellow); }

    .grid{
      display:grid;
      grid-template-columns: 1.2fr .8fr;
      gap:18px;
      align-items:start;
    }

    .card{
      background:var(--card);
      border:1px solid var(--border);
      border-radius:18px;
      backdrop-filter: blur(14px);
      box-shadow: 0 12px 32px rgba(0,0,0,.25);
      overflow:hidden;
    }

    .card-header{
      padding:16px 18px;
      border-bottom:1px solid rgba(255,255,255,.12);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
    }
    .card-header h2{
      margin:0;
      font-size:1.05rem;
      font-weight:700;
      letter-spacing:.2px;
      display:flex;
      gap:10px;
      align-items:center;
    }
    .card-header h2 i{ color:var(--yellow); }

    .card-body{ padding:18px; }

    .form-grid{
      display:grid;
      grid-template-columns: repeat(2, 1fr);
      gap:12px;
    }
    .full{ grid-column: 1 / -1; }

    label{
      display:block;
      font-size:.9rem;
      margin:0 0 6px;
      color:#f1f1f1;
      font-weight:600;
    }

    .input, select, textarea{
      width:100%;
      padding:12px 12px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,.16);
      background: rgba(10, 18, 36, .55);
      color:#fff;
      outline:none;
      transition:.2s;
    }
    .input:focus, select:focus, textarea:focus{
      border-color: rgba(52,152,219,.65);
      box-shadow: 0 0 0 4px rgba(52,152,219,.15);
    }
    textarea{ min-height: 92px; resize: vertical; }

    .hint{
      margin-top:6px;
      font-size:.82rem;
      color: rgba(255,255,255,.75);
      line-height:1.4;
    }

    .actions{
      display:flex;
      flex-wrap:wrap;
      gap:10px;
      justify-content:flex-end;
      margin-top:14px;
    }
    .btn{
      border:none;
      cursor:pointer;
      padding:12px 16px;
      border-radius:12px;
      font-weight:700;
      display:inline-flex;
      gap:10px;
      align-items:center;
      transition:.2s;
      text-decoration:none;
      color:#fff;
    }
    .btn-primary{
      background: linear-gradient(45deg, var(--blue), var(--blue2));
      box-shadow: 0 10px 22px rgba(52,152,219,.25);
    }
    .btn-primary:hover{ transform: translateY(-1px); }
    .btn-outline{
      background: rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.18);
    }
    .btn-outline:hover{ background: rgba(255,255,255,.10); }
    .btn-danger{
      background: rgba(231,76,60,.20);
      border:1px solid rgba(231,76,60,.35);
    }

    .side-box{
      display:flex;
      flex-direction:column;
      gap:12px;
    }

    .info{
      display:flex;
      gap:12px;
      padding:14px 14px;
      border-radius:16px;
      background: rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.12);
    }
    .info i{
      font-size:1.2rem;
      color:var(--yellow);
      margin-top:2px;
      flex: 0 0 auto;
    }
    .info strong{
      display:block;
      font-size:.95rem;
      margin-bottom:2px;
    }
    .info p{
      margin:0;
      color: rgba(255,255,255,.78);
      font-size:.9rem;
      line-height:1.5;
    }

    .progress{
      display:flex;
      gap:10px;
      align-items:center;
      justify-content:space-between;
    }
    .bar{
      width:100%;
      height:10px;
      background: rgba(255,255,255,.10);
      border-radius:999px;
      overflow:hidden;
      border:1px solid rgba(255,255,255,.12);
    }
    .bar > div{
      height:100%;
      width:0%;
      background: linear-gradient(90deg, var(--yellow), var(--blue));
      transition: width .2s ease;
    }
    .pct{
      font-weight:800;
      font-size:.9rem;
      min-width:44px;
      text-align:right;
      color:#fff;
    }

    .toast{
      display:none;
      margin-top:12px;
      padding:12px 14px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(46, 204, 113, .14);
      color:#eafff2;
      font-weight:700;
    }

    @media (max-width: 900px){
      .grid{ grid-template-columns: 1fr; }
      .hero{ flex-direction:column; align-items:flex-start; }
      .hero-badge{ align-items:flex-start; }
    }
    @media (max-width: 640px){
      .form-grid{ grid-template-columns: 1fr; }
      .hero-title{ font-size:1.7rem; }
      .wrap{ padding:30px 14px 70px; }
    }
  </style>
</head>

<body>

  <div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
  </div>

  <div class="wrap">
    <div class="hero">
      <div class="hero-left">
        <h1 class="hero-title">Pendaftaran Mahasiswa Baru — UNISAN Sidrap</h1>
        <p class="hero-sub">
          Isi data pendaftaran dengan benar. Setelah klik <b>Kirim Pendaftaran</b>, admin akan memverifikasi data dan menghubungi kamu.
        </p>
      </div>
      <div class="hero-badge">
        <div class="badge"><i class="fa-solid fa-shield-halved"></i> Data aman & terenkripsi</div>
        <div class="badge"><i class="fa-solid fa-clock"></i> Proses cepat & mudah</div>
      </div>
    </div>

    <div class="grid">
      <!-- FORM -->
      <div class="card">
        <div class="card-header">
          <h2><i class="fa-solid fa-file-signature"></i> Form Pendaftaran Online</h2>
          <div class="progress" style="min-width:220px;">
            <div class="bar"><div id="progressBar"></div></div>
            <div class="pct" id="progressPct">0%</div>
          </div>
        </div>

        <div class="card-body">
          <form id="formDaftar" action="proses-pendaftaran.php" method="POST" enctype="multipart/form-data" autocomplete="on">

            <div class="form-grid">
              <div>
                <label>Nama Lengkap *</label>
                <input class="input req" type="text" name="nama" placeholder="Contoh: Andi Saputra" required>
              </div>

              <div>
                <label>NIK *</label>
                <input class="input req" type="text" name="nik" inputmode="numeric" placeholder="16 digit" maxlength="16" required>
                <div class="hint">Pastikan NIK sesuai KTP.</div>
              </div>

              <div>
                <label>Email *</label>
                <input class="input req" type="email" name="email" placeholder="nama@email.com" required>
              </div>

              <div>
                <label>No. HP/WhatsApp *</label>
                <input class="input req" type="tel" name="hp" placeholder="08xxxxxxxxxx" required>
              </div>

              <div>
                <label>Tempat Lahir *</label>
                <input class="input req" type="text" name="tempat_lahir" required>
              </div>

              <div>
                <label>Tanggal Lahir *</label>
                <input class="input req" type="date" name="tanggal_lahir" required>
              </div>

              <div>
                <label>Jenis Kelamin *</label>
                <select class="req" name="jk" required>
                  <option value="">-- Pilih --</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>

              <div>
                <label>Asal Sekolah *</label>
                <input class="input req" type="text" name="asal_sekolah" required>
              </div>

              <div>
                <label>Program Studi Pilihan *</label>
                <select class="req" name="prodi" required>
                  <option value="">-- Pilih Prodi --</option>
                  <option value="Informatika">Informatika</option>
                  <option value="Sistem Informasi">Sistem Informasi</option>
                  <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                  <option value="Manajemen">Manajemen</option>
                  <option value="Akuntansi">Akuntansi</option>
                </select>
                <div class="hint">Silakan sesuaikan daftar prodi UNISAN.</div>
              </div>

              <div>
                <label>Jalur Masuk *</label>
                <select class="req" name="jalur" required>
                  <option value="">-- Pilih Jalur --</option>
                  <option value="Reguler">Reguler</option>
                  <option value="Prestasi">Prestasi</option>
                  <option value="KIP Kuliah">KIP Kuliah</option>
                  <option value="Transfer">Transfer</option>
                </select>
              </div>

              <div class="full">
                <label>Alamat Lengkap *</label>
                <textarea class="req" name="alamat" placeholder="Alamat sesuai domisili..." required></textarea>
              </div>

              <div>
                <label>Upload KTP (opsional)</label>
                <input class="input" type="file" name="file_ktp" accept=".jpg,.jpeg,.png,.pdf">
                <div class="hint">Format: JPG/PNG/PDF (maks 5MB).</div>
              </div>

              <div>
                <label>Upload Ijazah / SKL (opsional)</label>
                <input class="input" type="file" name="file_ijazah" accept=".jpg,.jpeg,.png,.pdf">
                <div class="hint">Format: JPG/PNG/PDF (maks 5MB).</div>
              </div>

              <div class="full">
                <label>Catatan Tambahan (opsional)</label>
                <textarea name="catatan" placeholder="Misal: info beasiswa, kebutuhan khusus, dll..."></textarea>
              </div>
            </div>

            <div class="toast" id="toastOk">
              <i class="fa-solid fa-circle-check"></i> Form sudah lengkap. Siap dikirim!
            </div>

            <div class="actions">
              <button type="reset" class="btn btn-outline"><i class="fa-solid fa-rotate-left"></i> Reset</button>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Kirim Pendaftaran</button>
            </div>

          </form>
        </div>
      </div>

      <!-- INFO SAMPING -->
      <div class="side-box">
        <div class="card">
          <div class="card-header">
            <h2><i class="fa-solid fa-circle-info"></i> Petunjuk Singkat</h2>
          </div>
          <div class="card-body">
            <div class="info">
              <i class="fa-solid fa-check"></i>
              <div>
                <strong>Isi data wajib</strong>
                <p>Kolom bertanda (*) wajib diisi, pastikan tidak ada typo.</p>
              </div>
            </div>

            <div class="info">
              <i class="fa-solid fa-file-arrow-up"></i>
              <div>
                <strong>Upload dokumen</strong>
                <p>KTP & Ijazah/SKL opsional. Bisa diunggah sekarang atau menyusul.</p>
              </div>
            </div>

            <div class="info">
              <i class="fa-solid fa-phone"></i>
              <div>
                <strong>Konfirmasi admin</strong>
                <p>Admin akan menghubungi lewat WhatsApp/Email setelah verifikasi.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h2><i class="fa-solid fa-headset"></i> Kontak PMB</h2>
          </div>
          <div class="card-body">
            <div class="info">
              <i class="fa-brands fa-whatsapp"></i>
              <div>
                <strong>WhatsApp</strong>
                <p>08xx-xxxx-xxxx (ganti dengan nomor resmi PMB)</p>
              </div>
            </div>
            <div class="info">
              <i class="fa-solid fa-envelope"></i>
              <div>
                <strong>Email</strong>
                <p>pmb@unisan-sidrap.co.id (sesuaikan)</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    // Progress form sederhana
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.getElementById("formDaftar");
      const req = Array.from(form.querySelectorAll(".req"));
      const bar = document.getElementById("progressBar");
      const pct = document.getElementById("progressPct");
      const toast = document.getElementById("toastOk");

      function calc(){
        let filled = 0;
        req.forEach(el => {
          const val = (el.value || "").toString().trim();
          if(val !== "") filled++;
        });
        const percent = Math.round((filled / req.length) * 100);
        bar.style.width = percent + "%";
        pct.textContent = percent + "%";
        toast.style.display = percent === 100 ? "block" : "none";
      }

      form.addEventListener("input", calc);
      form.addEventListener("change", calc);
      calc();

      // Validasi NIK numeric
      form.querySelector('input[name="nik"]').addEventListener("input", (e)=>{
        e.target.value = e.target.value.replace(/\D/g,'').slice(0,16);
      });
    });
  </script>

<?php include 'includes/footer.php'; ?>
</body>
</html>

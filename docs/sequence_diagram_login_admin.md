# Sequence Diagram: Login Administrator (Web FIKOM)

Diagram sekuensial ini menjelaskan secara praktis langkah-langkah yang dilalui ketika Admin akan masuk mengakses kendali (Login).

## Penjelasan Alur

Berikut rincian alur proses saat login admin dieksekusi:

1. **Mengunjungi Halaman Pintu Masuk**: 
   Awalnya, pengguna menapak pada `admin/login` untuk membuka formulir. Pintu panel sekadar menyediakan dua masukan: isian *Username* dan *Password*.

2. **Upaya Penyesuaian Sandi Layar**: 
   - Admin melengkapi data isian kredensial akun (*Username* bersanding *Password*), lantas mengeksekusinya di atas bingkai persetujuan tombol **"Login"**.
   - Input diserahkan mutlak pada skrip pos *backend*.
   - Kueri pemeriksaan sinkron dibangkitkan sistem kepada lapis memori *Database* MySQL untuk mengecek apakah kata sandinya cocok dan username dikenali.

3. **Deklarasi Penerimaan / Penolakan**:
   - Jika kombinasi Username atau Password salah, secara instan gerbang memantulkan peramban ke halaman yang sama. Halaman login menyajikan gertakan status peringatan bahwa "Password atau Akun salah".
   - Pengecualian telak didapat andai kata kecocokan sandi dibenarkan. Sistem membagikan identitas Kunci Sesi (*Session Key Login Aktif*) ke peramban. 
   - Pemandu diubah (mengalami *redirect*) agar admin dapat mendaratkan langkah suksesnya melenggang ke ruangan kendali peladen *Dashboard Utama* situs.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Pengurus Portal / Calon Admin
    participant View as "Form Halaman Login"
    participant System as "Sistem Pengawas Hak Akses (PHP Session)"
    participant DB as "Pangkalan Data Inti (MySQL)"

    Admin->>View: Buka halaman antarmuka login Admin
    View-->>Admin: Menampilkan form isian kredensial
    
    Admin->>View: Lengkapi ketikan *Username* & *Password*, Klik tombol "Login"
    View->>System: Berangkatkan lalu lintas pengecekan data form (Metode HTTP POST)
    
    System->>DB: Cari dan cocokkan sandi beradasarkan pangkalan data tabel user
    DB-->>System: Melaporkan bahwa sandi pelamar sah atau tidak sejalan
    
    alt Logika Sandi Diterima (100% Cocok) / Sukses
        System->>System: Pasaukan sinyal Status Aktif (*Set Login User Session = True*)
        System-->>View: Lemparkan layar pengelola meluncur bebas memasuki Ruang Kontrol Dashboard Utama Situs
    else Kondisi Logika Sandi Gagal / Asal-asalan
        System-->>View: Tolak masuk perlahan mengembalikan halaman form login lengkap berserat Peringatan "Sandi atau Akun Palsu/Salah"
    end
```
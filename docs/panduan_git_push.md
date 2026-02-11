# Panduan Mengirim Perubahan ke GitHub (Push)

Berikut adalah langkah-langkah untuk melakukan _push_ kode ke repository GitHub melalui terminal (Command Prompt/PowerShell/Terminal di VS Code).

## 1. Cek Status Perubahan
Sebelum melakukan apa pun, cek dulu file mana saja yang berubah.
```bash
git status
```
*   File berwarna **merah**: Belum disiapkan (untracked/modified).
*   File berwarna **hijau**: Sudah siap untuk di-commit (staged).

## 2. Menyiapkan File (Add)
Pilih file yang ingin Anda kirim.
*   **Untuk semua file:**
    ```bash
    git add .
    ```
*   **Untuk satu file tertentu:**
    ```bash
    git add nama_folder/nama_file.php
    ```

## 3. Menyimpan Perubahan (Commit)
Berikan pesan singkat yang menjelaskan apa yang Anda ubah.
```bash
git commit -m "Pesan penjelasan perubahan Anda di sini"
```
_Contoh: `git commit -m "fix: memperbaiki bug login"`_

## 4. Mengirim ke GitHub (Push)
Kirim perubahan yang sudah di-commit ke server GitHub.
```bash
git push
```
_Atau jika diminta upstream:_ `git push -u origin main`

---

## 💡 Masalah Umum (Troubleshooting)

### Error: "Updates were rejected because the remote contains work that you do not have locally"
Ini berarti ada orang lain (atau Anda di komputer lain) yang sudah melakukan push lebih dulu. Solusinya:
1.  Ambil perubahan terbaru dari GitHub:
    ```bash
    git pull
    ```
2.  Bereskan jika ada konflik (conflict).
3.  Lakukan `git push` lagi.

### Cek Riwayat Commit
Untuk melihat apa saja yang sudah dikirim:
```bash
git log --oneline
```

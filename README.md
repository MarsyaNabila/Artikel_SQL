# Eksperimen Cross-Site Scripting (XSS) pada Form Komentar Website Sederhana

Nama: Marsya Nabila Putri

Nim: 312410338

Kelas: I241D

Matakuliah: Pemograman Web 2 (UTS)

Repositori ini berisi dokumentasi teknis mengenai eksperimen keamanan web, khususnya pada kerentanan Stored XSS dalam fitur komentar sederhana. Proyek ini dibuat untuk memenuhi tugas UTS Pemrograman Web.

## Deskripsi Proyek
Eksperimen ini mensimulasikan bagaimana sebuah aplikasi web yang dibangun menggunakan PHP Native dapat disusupi oleh skrip berbahaya melalui input pengguna. Fokus utama adalah pada teknik Output Encoding sebagai garda terdepan pertahanan web.

## Persiapan Lingkungan (Setup)
Untuk menjalankan replikasi eksperimen ini:
- Web Server: XAMPP / Laragon (Apache)
  
- Database: MariaDB / MySQL
  
- Browser: Google Chrome / Firefox

### Langkah Instalasi:
1. Clone repositori ini atau buat folder di htdocs.
2. Buat database bernama db_komentar.
3. Impor skema tabel berikut:
   
```
CREATE TABLE tabel_komentar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isi TEXT NOT NULL
);

---
```

### 1. Tahap Injeksi (The Attack)
Pada tahap ini, sistem menerima data tanpa proses sanitasi. Script yang digunakan untuk menampilkan data adalah:

// Bagian ini Rentan terhadap eksekusi script
echo $data['isi'];

Payload yang digunakan:
<script>alert('Sistem Berhasil Ditembus!');</script>

<img width="1503" height="480" alt="Screenshot 2026-04-28 174550" src="https://github.com/user-attachments/assets/09c9bf6b-3afe-40f5-b545-d3b0ea663636" />

### 2. Tahap Analisis
Ketika payload dikirim, browser tidak mengenali input tersebut sebagai teks biasa, melainkan sebagai instruksi program. Akibatnya, muncul jendela pop-up otomatis yang menandakan skrip penyerang telah berhasil dijalankan.

### 3. Tahap Perbaikan (The Patch)
Perbaikan dilakukan pada sisi output dengan mengubah karakter berbahaya menjadi entitas HTML aman menggunakan fungsi htmlspecialchars().

// Bagian ini Aman dari eksekusi script
echo htmlspecialchars($data['isi'], ENT_QUOTES, 'UTF-8');

<img width="1478" height="795" alt="Screenshot 2026-04-28 174856" src="https://github.com/user-attachments/assets/b48240a3-28fb-4d03-9bc4-6cc1131e5cc9" />


Link Artikel: https://medium.com/@marsyanabila293/eksperimen-cross-site-scripting-xss-pada-form-komentar-website-sederhana-de88775e34d1



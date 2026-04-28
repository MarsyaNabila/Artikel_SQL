<?php
// 1. KONFIGURASI DATABASE
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_komentar";

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi agar tidak muncul Fatal Error jika database belum siap
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. PROSES SIMPAN DATA
if(isset($_POST['kirim'])){
    // mysqli_real_escape_string mencegah error SQL saat ada tanda petik (') pada input
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']); 
    
    // Query untuk menyimpan komentar ke tabel
    $query = "INSERT INTO tabel_komentar (isi) VALUES ('$pesan')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Eksperimen XSS - UTS Pemrograman Web</title>
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        .container { max-width: 600px; margin: auto; }
        textarea { width: 100%; height: 100px; margin-bottom: 10px; }
        .komentar-item { border-bottom: 1px solid #ccc; padding: 10px 0; }
        .aman { color: green; font-weight: bold; }
        .rentan { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Komentar Sederhana (Eksperimen XSS)</h2>
        
        <form method="POST">
            <textarea name="pesan" placeholder="Masukkan payload XSS di sini..."></textarea><br>
            <button type="submit" name="kirim">Post Komentar</button>
        </form>

        <hr>
        <h3>Daftar Komentar:</h3>

        <?php
        $ambil = mysqli_query($conn, "SELECT * FROM tabel_komentar ORDER BY id DESC");
        
        if (mysqli_num_rows($ambil) > 0) {
            while($data = mysqli_fetch_array($ambil)){
                echo "<div class='komentar-item'>";
                echo htmlspecialchars($data['isi'], ENT_QUOTES, 'UTF-8');
                echo "</div>";
            }
        } else {
            echo "<p>Belum ada komentar.</p>";
        }
        ?>
    </div>
</body>
</html>
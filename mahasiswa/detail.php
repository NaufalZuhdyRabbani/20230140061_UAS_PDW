<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

$praktikum_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ambil daftar modul dari praktikum
$modul = mysqli_query($conn, "SELECT * FROM modul WHERE praktikum_id = $praktikum_id");

echo "<h2>Detail Praktikum</h2>";

while ($m = mysqli_fetch_assoc($modul)) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px'>";
    echo "<h3>{$m['judul']}</h3>";

    // Link unduh materi
    if ($m['file_materi']) {
        echo "<p><a href='../materi/{$m['file_materi']}' target='_blank'>📄 Unduh Materi</a></p>";
    }

    // Form upload laporan
    echo "<form method='POST' enctype='multipart/form-data'>
        <input type='file' name='laporan' required>
        <input type='hidden' name='modul_id' value='{$m['id']}'>
        <button name='upload'>Upload Laporan</button>
    </form>";

    // Tampilkan nilai jika ada
    $lap = mysqli_query($conn, "SELECT * FROM laporan WHERE user_id=$user_id AND modul_id={$m['id']}");
    if ($r = mysqli_fetch_assoc($lap)) {
        echo "<p>✅ Laporan terkumpul</p>";
        echo "<p>📝 Nilai: <strong>{$r['nilai']}</strong></p>";
        echo "<p>💬 Feedback: {$r['feedback']}</p>";
    }

    echo "</div>";
}

// Proses upload laporan
if (isset($_POST['upload'])) {
    $modul_id = $_POST['modul_id'];
    $file = $_FILES['laporan']['name'];
    $tmp  = $_FILES['laporan']['tmp_name'];

    move_uploaded_file($tmp, "../laporan/$file");

    mysqli_query($conn, "INSERT INTO laporan(user_id, modul_id, file_laporan) 
                         VALUES($user_id, $modul_id, '$file') 
                         ON DUPLICATE KEY UPDATE file_laporan='$file'");

    echo "<script>window.location.reload();</script>";
}

include '../includes/footer.php';
?>

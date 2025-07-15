<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Proses input nilai
if (isset($_POST['nilai'])) {
    $lap_id = $_POST['laporan_id'];
    $nilai = $_POST['nilai'];
    $feedback = $_POST['feedback'];

    mysqli_query($conn, "UPDATE laporan SET nilai=$nilai, feedback='$feedback' WHERE id=$lap_id");
    echo "<script>alert('Nilai disimpan!');window.location.href='laporan_masuk.php';</script>";
}

// Ambil semua laporan masuk
$laporan = mysqli_query($conn, "
    SELECT l.id, u.nama, m.judul, l.file_laporan, l.nilai, l.feedback 
    FROM laporan l
    JOIN users u ON l.user_id = u.id
    JOIN modul m ON l.modul_id = m.id
    ORDER BY l.id DESC
");

echo "<h2>Laporan Masuk</h2>";
while ($r = mysqli_fetch_assoc($laporan)) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px'>";
    echo "<p><strong>{$r['nama']}</strong> - {$r['judul']}</p>";
    echo "<p>File: <a href='../laporan/{$r['file_laporan']}' target='_blank'>{$r['file_laporan']}</a></p>";

    echo "<form method='POST'>
        <input type='hidden' name='laporan_id' value='{$r['id']}'>
        <label>Nilai:</label> <input type='number' name='nilai' value='{$r['nilai']}' required><br>
        <label>Feedback:</label><br>
        <textarea name='feedback' rows='3' cols='40'>{$r['feedback']}</textarea><br>
        <button name='nilai'>Simpan</button>
    </form>";
    echo "</div>";
}

include '../includes/footer.php';
?>

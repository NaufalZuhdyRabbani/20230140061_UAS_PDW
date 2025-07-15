<?php /* dashboard asisten */ ?>
<?php
session_start();
include '../includes/header.php';

echo "<h2>Dashboard Asisten</h2>";
echo "<ul>
    <li><a href='kelola_praktikum.php'>Kelola Mata Praktikum</a></li>
    <li><a href='kelola_modul.php'>Kelola Modul</a></li>
    <li><a href='laporan_masuk.php'>Laporan Mahasiswa</a></li>
    <li><a href='kelola_akun.php'>Kelola Akun</a></li>
</ul>";

include '../includes/footer.php';
?>

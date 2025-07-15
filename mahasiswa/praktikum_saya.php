<?php /* daftar praktikum saya */ ?>
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT p.id, p.nama FROM praktikum p
JOIN pendaftaran d ON p.id = d.praktikum_id
WHERE d.user_id = $user_id";
$result = mysqli_query($conn, $query);

echo "<h2>Praktikum Saya</h2><ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>{$row['nama']} - <a href='detail.php?id={$row['id']}'>Detail</a></li>";
}
echo "</ul>";

include '../includes/footer.php';
?>

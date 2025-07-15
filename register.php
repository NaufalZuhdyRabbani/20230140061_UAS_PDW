<?php /* register logic here */ ?>
<?php
include 'includes/db.php';

if (isset($_POST['register'])) {
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $pass   = $_POST['password'];
    $role   = $_POST['role'];

    $query = "INSERT INTO users(nama, email, password, role) VALUES('$nama', '$email', '$pass', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "Registrasi berhasil. <a href='login.php'>Login sekarang</a>";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>

<h2>Registrasi</h2>
<form method="POST">
    <input type="text" name="nama" placeholder="Nama Lengkap" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <select name="role" required>
        <option value="">Pilih Role</option>
        <option value="mahasiswa">Mahasiswa</option>
        <option value="asisten">Asisten</option>
    </select><br><br>
    <button name="register">Register</button>
</form>

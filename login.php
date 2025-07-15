<?php /* login logic here */ ?>
<?php
session_start();
include 'includes/db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role']    = $row['role'];

        if ($row['role'] == 'mahasiswa') {
            header("Location: mahasiswa/praktikum_saya.php");
        } else {
            header("Location: asisten/dashboard.php");
        }
    } else {
        echo "<p style='color:red'>Login gagal. Coba lagi.</p>";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>

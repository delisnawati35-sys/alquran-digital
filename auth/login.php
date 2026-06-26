<?php
session_start();
include __DIR__ . '/../config/koneksi.php';/*
|--------------------------------------------------------------------------
| Jika sudah login langsung ke dashboard
|--------------------------------------------------------------------------
*/
if(isset($_SESSION['login'])){
        header("Location: /alquran_digital/dashboard.php");
        exit;
}

/*
|--------------------------------------------------------------------------
| Proses Login
|--------------------------------------------------------------------------
*/
if(isset($_POST['login'])){

    $username = mysqli_real_escape_string(
        $koneksi,
        $_POST['username']
    );

    $password = md5($_POST['password']);

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM admin
        WHERE username='$username'
        AND password='$password'"
    );

    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['login'] = true;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];

            header("Location: /alquran_digital/dashboard.php");
        exit;

    } else {

        $error = "Username atau Password salah!";

    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(
        135deg,
        #198754,
        #14532d
    );

    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;
}

.card-login{
    width:420px;
    border:none;
    border-radius:15px;
    box-shadow:0 0 20px rgba(0,0,0,.2);
}

.logo{
    font-size:60px;
}
</style>

</head>
<body>

<div class="card card-login p-4">

    <div class="text-center mb-3">
        <div class="logo">📖</div>
        <h3>Sistem Pembelajaran Al-Qur'an</h3>
        <p class="text-muted">
            Login Administrator
        </p>

        <hr>

        <small class="text-secondary">
            Project Pemrograman Web 2
        </small>
    </div>

    <?php if(isset($error)){ ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
    <label class="form-label">
        Username
    </label>

    <input
        type="text"
        name="username"
        class="form-control"
        placeholder="Masukkan Username"
        required>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Password
        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Masukkan Password"
            required>
    </div>

        <button
            type="submit"
            name="login"
            class="btn btn-success w-100">

            Login
        </button>

    </form>

    <div class="text-center mt-3">

    <small class="text-muted">

        © 2026 Sistem Pembelajaran Al-Qur'an Digital

    </small>

</div>
</div>

</body>
</html>
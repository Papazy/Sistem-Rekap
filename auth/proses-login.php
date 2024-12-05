<?php 

    session_start();
    require_once "../config/conn.php";

    // jika tombol login ditekan
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

        // cek username
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                // set session
                $_SESSION['ssLogin'] = true;
                $_SESSION['ssUser'] = $username;
                header("location:../index.php");
                exit;
            } else {
                echo "<script>
                        alert('password yang anda masukan salah');
                        document.location.href= 'login.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('username anda tidak terdaftar');
                    document.location.href= 'login.php';
                  </script>";
        }
    }

?>
<?php

session_start();
        
if (!isset($_SESSION["ssLogin"])) {
    header("location: auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "function/functions.php";
require_once "function/mode-user.php";


// Add user
if (isset($_POST['simpan'])) {

    // Ambil value elemen yang diposting
    $username   = trim(htmlspecialchars($_POST["username"]));
    $nama       = trim(htmlspecialchars($_POST["nama"]));
    $role       = trim(htmlspecialchars($_POST["role"]));
    $jabatan    = trim(htmlspecialchars($_POST["jabatan"]));
    $alamat     = trim(htmlspecialchars($_POST["alamat"]));
    $gambar     = $_FILES["image"]["name"];

    $password   = 12345; // Default password
    $pass       = password_hash($password, PASSWORD_DEFAULT);

    // Cek username
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($cekUsername) > 0) {
        header("location:user.php?msg=cancel");
        return;
    }

    // Upload gambar
    if (!empty($gambar)) {
        $namafile   = $_FILES['image']['name'];
        $ukuran     = $_FILES['image']['size'];
        $tmp        = $_FILES['image']['tmp_name'];

        // Validasi file gambar yang boleh diupload
        $ekstensiGambarValid    = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar         = explode('.', $namafile);
        $ekstensiGambar         = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            header("location:user.php?msg=notimage");
            return;
        }

        // Validasi ukuran gambar 1 MB
        if ($ukuran > 1000000) {
            header("location:user.php?msg=oversize");
            return;
        }

        $namaFileBaru = rand(10, 1000) . '-' . $namafile;
        move_uploaded_file($tmp, '../asset/upload_img/' . $namaFileBaru);
        $gambar = $namaFileBaru;
    } else {
        $gambar = 'default.png';
    }

    // Insert data user ke database
    $query = "INSERT INTO user (username, password, nama, alamat, jabatan, role, foto) 
              VALUES ('$username', '$pass', '$nama', '$alamat', '$jabatan', '$role', '$gambar')";
    mysqli_query($koneksi, $query);

    // Redirect dengan pesan sukses
    header("location:user.php?msg=added");
    return;
}

// Edit user
if (isset($_POST['update'])) {
    // Ambil value elemen yang diposting
    $id         = trim(htmlspecialchars($_POST["id"]));
    $username   = trim(htmlspecialchars($_POST["username"]));
    $nama       = trim(htmlspecialchars($_POST["nama"]));
    $role       = trim(htmlspecialchars($_POST["role"]));
    $jabatan    = trim(htmlspecialchars($_POST["jabatan"]));
    $alamat     = trim(htmlspecialchars($_POST["alamat"]));
    $gambar     = $_FILES["image"]["name"];
    $fotoLama   = trim(htmlspecialchars($_POST["oldImage"]));

    // Cek username sekarang
    $queryUsername = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $dataUsername  = mysqli_fetch_assoc($queryUsername);
    $curUsername   = $dataUsername['username'];

    // Cek username baru
    if ($username !== $curUsername) {
        $newUsername   = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
        if (mysqli_num_rows($newUsername) > 0) {
            header("location:user.php?msg=cancel");
            return;
        }
    }

    // Upload gambar
    if (!empty($gambar)) {
        $namafile   = $_FILES['image']['name'];
        $ukuran     = $_FILES['image']['size'];
        $tmp        = $_FILES['image']['tmp_name'];

        // Validasi file gambar yang boleh diupload
        $ekstensiGambarValid    = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar         = explode('.', $namafile);
        $ekstensiGambar         = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            header("location:user.php?msg=notimage");
            return;
        }

        // Validasi ukuran gambar 1 MB
        if ($ukuran > 1000000) {
            header("location:user.php?msg=oversize");
            return;
        }

        $namaFileBaru = rand(10, 1000) . '-' . $namafile;
        move_uploaded_file($tmp, '../asset/upload_img/' . $namaFileBaru);

        // Hapus foto lama jika bukan default
        if ($fotoLama != 'default.png') {
            @unlink('../asset/upload_img/' . $fotoLama);
        }

        $imgUser = $namaFileBaru;
    } else {
        $imgUser = $fotoLama;
    }

    // Update data user di database
    $query = "UPDATE user 
              SET username = '$username', nama = '$nama', alamat = '$alamat', jabatan = '$jabatan', role = '$role', foto = '$imgUser'
              WHERE id = $id";
    mysqli_query($koneksi, $query);

    // Redirect dengan pesan sukses
    header("location:user.php?msg=update");
    return;
}

?>
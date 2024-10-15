<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $divisi = $_POST['divisi'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tahun_lahir = $_POST['tahun_lahir'];

   
    if (isset($_FILES['foto_diri']) && $_FILES['foto_diri']['error'] == UPLOAD_ERR_OK) {
        $foto_diri = basename($_FILES['foto_diri']['name']);
        $target_dir = "foto/";
        $target_file = $target_dir . $foto_diri;

        if (move_uploaded_file($_FILES['foto_diri']['tmp_name'], $target_file)) {
            
            $sql = "INSERT INTO daftar_kepanitiaan (NIK, nama, program_studi, divisi, jabatan, alamat, tempat_lahir, tahun_lahir, foto_diri)
                    VALUES ('$nik', '$nama', '$program_studi', '$divisi', '$jabatan', '$alamat', '$tempat_lahir', '$tahun_lahir', '$foto_diri')";

            if ($conn->query($sql) === TRUE) {
                echo "Data berhasil ditambahkan";
                header('Location: home.php'); 
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengupload file.";
        }
    } else {
        echo "Harap upload foto diri.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
</head>
<body>
    <h1>Tambah Data Kepanitiaan</h1>
    <form action="insert.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="nik">NIK:</label>
            <input type="text" name="nik" id="nik" required>
        </p>
        <p>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>
        </p>
        <p>
            <label for="program_studi">Program Studi:</label>
            <input type="text" name="program_studi" id="program_studi" required>
        </p>
        <p>
            <label for="divisi">Divisi:</label>
            <input type="text" name="divisi" id="divisi" required>
        </p>
        <p>
            <label for="jabatan">Jabatan:</label>
            <input type="text" name="jabatan" id="jabatan" required>
        </p>
        <p>
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" required>
        </p>
        <p>
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" required>
        </p>
        <p>
            <label for="tahun_lahir">Tahun Lahir:</label>
            <input type="number" name="tahun_lahir" id="tahun_lahir" required>
        </p>
        <p>
            <label for="foto_diri">Foto Diri: (bentuk file harus jpg)</label>
            <input type="file" name="foto_diri" id="foto_diri" accept="image/*" required>
        </p>
        <p>
            <input type="submit" value="Tambah Data">
        </p>
    </form>

    <br>
    <a href="home.php">Kembali ke Home</a>
</body>
</html>

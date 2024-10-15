<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM daftar_kepanitiaan WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nik = $row['NIK'];
        $nama = $row['nama'];
        $program_studi = $row['program_studi'];
        $divisi = $row['divisi'];
        $jabatan = $row['jabatan'];
        $alamat = $row['alamat'];
        $tempat_lahir = $row['tempat_lahir'];
        $tahun_lahir = $row['tahun_lahir'];
        $foto_diri = $row['foto_diri'];
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $program_studi = $_POST['program_studi'];
    $divisi = $_POST['divisi'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tahun_lahir = $_POST['tahun_lahir'];
    $foto_diri = $_POST['foto_diri']; // Asumsi ini adalah path foto diri yang di-upload

    $sql = "UPDATE daftar_kepanitiaan SET 
            NIK = '$nik', 
            nama = '$nama', 
            program_studi = '$program_studi', 
            divisi = '$divisi', 
            jabatan = '$jabatan', 
            alamat = '$alamat',
            tempat_lahir = '$tempat_lahir',
            tahun_lahir = '$tahun_lahir',
            foto_diri = '$foto_diri'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: home.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kepanitiaan</title>
</head>
<body>
    <h1>Edit Data Kepanitiaan</h1>
    
    <form action="" method="post">
        <label for="nik">NIK:</label>
        <input type="text" id="nik" name="nik" value="<?php echo $nik; ?>"><br><br>
        
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>"><br><br>

        <label for="program_studi">Program Studi:</label>
        <input type="text" id="program_studi" name="program_studi" value="<?php echo $program_studi; ?>"><br><br>

        <label for="divisi">Divisi:</label>
        <input type="text" id="divisi" name="divisi" value="<?php echo $divisi; ?>"><br><br>

        <label for="jabatan">Jabatan:</label>
        <input type="text" id="jabatan" name="jabatan" value="<?php echo $jabatan; ?>"><br><br>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>"><br><br>

        <label for="tempat_lahir">Tempat Lahir:</label>
        <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>"><br><br>

        <label for="tahun_lahir">Tahun Lahir:</label>
        <input type="text" id="tahun_lahir" name="tahun_lahir" value="<?php echo $tahun_lahir; ?>"><br><br>

        <label for="foto_diri">Foto Diri (URL):</label>
        <input type="text" id="foto_diri" name="foto_diri" value="<?php echo $foto_diri; ?>"><br><br>

        <input type="submit" name="submit" value="Update Data"  onclick="return confirm('Apakah Anda yakin ingin mengeditnya?');">
    </form>

    <br>
    <a href="home.php">Kembali ke Home</a>
</body>
</html>

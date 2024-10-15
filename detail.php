<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


include 'db.php';
$id = $_GET['id'];

$sql = "SELECT * FROM daftar_kepanitiaan WHERE id = $id";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data Belum Ada";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<body>
<p><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
    <p><strong>Tempat Lahir:</strong> <?php echo $row['tempat_lahir']; ?></p>
    <p><strong>Tahun Lahir:</strong> <?php echo $row['tahun_lahir']; ?></p>
  
    <?php if (!empty($row['foto_diri'])): ?>
        <p><strong>Foto Diri:</strong></p>
        <img src="foto/<?php echo $row['foto_diri']; ?>" alt="Foto Diri" width="150px">
    <?php else: ?>
        <p><strong>Foto Diri:</strong> Tidak ada foto</p>
    <?php endif; ?>

    <br>
    <a href="home.php">Kembali ke Home</a>
</body>
</body>
</html>
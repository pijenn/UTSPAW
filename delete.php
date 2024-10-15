<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';


$id = $_GET['id'];


if (isset($id)) {
    
    $sql = "DELETE FROM daftar_kepanitiaan WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ada";
}

header('Location: home.php');
exit;
?>

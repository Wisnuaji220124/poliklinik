<?php
session_start();
include 'koneksi.php';
include 'navbar.php';

if (!isset($_SESSION['username'])) {
    header("Location: loginUser.php");
    exit();
}

// Tambah Data Dokter
if (isset($_POST['add'])) {
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $sql = "INSERT INTO dokter (nama_dokter, spesialis) VALUES ('$nama_dokter', '$spesialis')";
    $conn->query($sql);
}

// Hapus Data Dokter
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM dokter WHERE id_dokter='$id'";
    $conn->query($sql);
}

// Ambil Data Dokter
$sql = "SELECT * FROM dokter";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Data Dokter</h2>
    
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID Dokter</th>
                <th>Nama Dokter</th>
                <th>Spesialis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_dokter']; ?></td>
                <td><?php echo $row['nama_dokter']; ?></td>
                <td><?php echo $row['spesialis']; ?></td>
                <td>
                    <a href="dokter.php?delete=<?php echo $row['id_dokter']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Form Tambah Data Dokter -->
    <h3>Tambah Dokter</h3>
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Dokter</label>
            <input type="text" name="nama_dokter" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Spesialis</label>
            <input type="text" name="spesialis" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Tambah Dokter</button>
    </form>
</div>

</body>
</html>


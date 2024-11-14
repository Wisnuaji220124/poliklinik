<?php
session_start();
include 'koneksi.php';
include 'navbar.php';

if (!isset($_SESSION['username'])) {
    header("Location: loginUser.php");
    exit();
}

// Tambah Data Pasien
if (isset($_POST['add'])) {
    $nama_pasien = $_POST['nama_pasien'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $sql = "INSERT INTO pasien (nama_pasien, alamat, no_telp) VALUES ('$nama_pasien', '$alamat', '$no_telp')";
    $conn->query($sql);
}

// Hapus Data Pasien
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM pasien WHERE id_pasien='$id'";
    $conn->query($sql);
}

// Ambil Data Pasien
$sql = "SELECT * FROM pasien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Data Pasien</h2>
    
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID Pasien</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_pasien']; ?></td>
                <td><?php echo $row['nama_pasien']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['no_telp']; ?></td>
                <td>
                    <a href="pasien.php?delete=<?php echo $row['id_pasien']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Form Tambah Data Pasien -->
    <h3>Tambah Pasien</h3>
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="no_telp" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Tambah Pasien</button>
    </form>
</div>

</body>
</html>


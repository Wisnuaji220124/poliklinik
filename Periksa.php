<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Tambah Data Periksa
if (isset($_POST['add'])) {
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];
    $obat = $_POST['obat'];

    $sql = "INSERT INTO periksa (pasien_id, dokter_id, obat) VALUES ('$pasien_id', '$dokter_id', '$obat')";
    if ($conn->query($sql) === TRUE) {
        echo "Data periksa berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Data Periksa
if (isset($_GET['edit'])) {
    $id_periksa = $_GET['edit'];
    $edit_state = true;

    // Ambil data yang akan diedit
    $record = $conn->query("SELECT * FROM periksa WHERE id_periksa='$id_periksa'");
    if ($record->num_rows > 0) {
        $n = $record->fetch_assoc();
        $pasien_id = $n['pasien_id'];
        $dokter_id = $n['dokter_id'];
        $obat = $n['obat'];
    }
}

// Update Data Periksa
if (isset($_POST['update'])) {
    $id_periksa = $_POST['id_periksa'];
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];
    $obat = $_POST['obat'];

    $sql = "UPDATE periksa SET pasien_id='$pasien_id', dokter_id='$dokter_id', obat='$obat' WHERE id_periksa='$id_periksa'";
    if ($conn->query($sql) === TRUE) {
        echo "Data periksa berhasil diupdate!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus Data Periksa
if (isset($_GET['delete'])) {
    $id_periksa = $_GET['delete'];
    $sql = "DELETE FROM periksa WHERE id_periksa='$id_periksa'";
    if ($conn->query($sql) === TRUE) {
        echo "Data periksa berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan Data Periksa
$sql = "SELECT * FROM periksa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Periksa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h2 class="mt-5">Data Periksa</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Periksa</th>
                <th>ID Pasien</th>
                <th>ID Dokter</th>
                <th>Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_periksa']; ?></td>
                <td><?php echo $row['pasien_id']; ?></td>
                <td><?php echo $row['dokter_id']; ?></td>
                <td><?php echo $row['obat']; ?></td>
                <td>
                    <a href="periksa.php?edit=<?php echo $row['id_periksa']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="periksa.php?delete=<?php echo $row['id_periksa']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Form Tambah/Edit Data Periksa -->
    <h3><?php echo isset($edit_state) ? 'Edit' : 'Tambah'; ?> Data Periksa</h3>
    <form method="POST" action="periksa.php">
        <input type="hidden" name="id_periksa" value="<?php echo isset($id_periksa) ? $id_periksa : ''; ?>">
        <div class="form-group">
            <label>ID Pasien</label>
            <input type="text" name="pasien_id" class="form-control" required value="<?php echo isset($pasien_id) ? $pasien_id : ''; ?>">
        </div>
        <div class="form-group">
            <label>ID Dokter</label>
            <input type="text" name="dokter_id" class="form-control" required value="<?php echo isset($dokter_id) ? $dokter_id : ''; ?>">
        </div>
        <div class="form-group">
            <label>Obat</label>
            <input type="text" name="obat" class="form-control" required value="<?php echo isset($obat) ? $obat : ''; ?>">
        </div>
        <button type="submit" name="<?php echo isset($edit_state) ? 'update' : 'add'; ?>" class="btn btn-success">
            <?php echo isset($edit_state) ? 'Update' : 'Tambah'; ?> Data
        </button>
    </form>
</div>

</body>
</html>

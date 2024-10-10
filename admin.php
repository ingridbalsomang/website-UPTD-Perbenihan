<?php
include('db.php');

// Tambah Kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $hari_tanggal = $_POST['hari_tanggal'];
    $waktu = $_POST['waktu'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO kegiatan (nama_kegiatan, hari_tanggal, waktu, jumlah, keterangan) 
            VALUES ('$nama_kegiatan', '$hari_tanggal', '$waktu', '$jumlah', '$keterangan')";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit Kegiatan
if (isset($_GET['edit'])) {
    $id_kegiatan = $_GET['edit'];
    $result = $conn->query("SELECT * FROM kegiatan WHERE id_kegiatan=$id_kegiatan");
    $row = $result->fetch_assoc();
}

// Simpan Perubahan Kegiatan
if (isset($_POST['update'])) {
    $id_kegiatan = $_POST['id_kegiatan'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $hari_tanggal = $_POST['hari_tanggal'];
    $waktu = $_POST['waktu'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE kegiatan SET nama_kegiatan='$nama_kegiatan', hari_tanggal='$hari_tanggal', waktu='$waktu', jumlah='$jumlah', keterangan='$keterangan' WHERE id_kegiatan=$id_kegiatan";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Hapus Kegiatan
if (isset($_GET['hapus'])) {
    $id_kegiatan = $_GET['hapus'];
    $conn->query("DELETE FROM kegiatan WHERE id_kegiatan=$id_kegiatan");
}

// Fungsi untuk menandai kegiatan sebagai selesai
if (isset($_POST['selesai'])) {
    $id_kegiatan_array = $_POST['selesai'];

    // Loop melalui semua id_kegiatan yang dicentang
    foreach ($id_kegiatan_array as $id_kegiatan) {
        $sql = "UPDATE kegiatan SET status = 'selesai' WHERE id_kegiatan = $id_kegiatan";
        mysqli_query($conn, $sql);
    }
}

// Fungsi untuk menandai kegiatan sebagai selesai
if (isset($_GET['selesai'])) {
    $id_kegiatan = $_GET['selesai'];
    $sql = "UPDATE kegiatan SET status = 'selesai' WHERE id_kegiatan = $id_kegiatan";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header><img src="logoo.png" alt=""></header>
        <li><a href="index.html">Logout</a></li>
    </div>
    <h2>TAMBAH KEGIATAN</h2>

    <!-- Form Tambah/Edit Kegiatan -->
    <form action="admin.php" method="POST">
        <input type="hidden" name="id_kegiatan"
            value="<?php echo isset($row['id_kegiatan']) ? $row['id_kegiatan'] : ''; ?>">
        <label>Nama Kegiatan:</label>
        <input type="text" name="nama_kegiatan"
            value="<?php echo isset($row['nama_kegiatan']) ? $row['nama_kegiatan'] : ''; ?>" required><br><br>
        <label>Hari/Tanggal:</label>
        <input type="date" name="hari_tanggal"
            value="<?php echo isset($row['hari_tanggal']) ? $row['hari_tanggal'] : ''; ?>" required><br><br>
        <label>Waktu:</label>
        <input type="time" name="waktu" value="<?php echo isset($row['waktu']) ? $row['waktu'] : ''; ?>"
            required><br><br>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?php echo isset($row['jumlah']) ? $row['jumlah'] : ''; ?>"
            required><br><br>
        <label>Keterangan:</label>
        <textarea name="keterangan"
            required><?php echo isset($row['keterangan']) ? $row['keterangan'] : ''; ?></textarea><br><br>

        <input type="submit" name="<?php echo isset($row['id_kegiatan']) ? 'update' : 'tambah'; ?>"
            value="<?php echo isset($row['id_kegiatan']) ? 'Update Kegiatan' : 'Tambah Kegiatan'; ?>"><br>
        <a href="kegiatan.php" class="btn-text">Lihat Data</a>
    </form>



    <!-- Tabel Kegiatan -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kegiatan</th>
                <th>Hari/Tanggal</th>
                <th>Waktu</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM kegiatan");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_kegiatan']; ?></td>
                    <td><?php echo $row['nama_kegiatan']; ?></td>
                    <td><?php echo $row['hari_tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td><?php echo $row['keterangan']; ?></td>
                    <td>
                        <a href="admin.php?edit=<?php echo $row['id_kegiatan']; ?>">Edit</a>
                        <a href="admin.php?hapus=<?php echo $row['id_kegiatan']; ?>"
                            onclick="return confirm('Anda yakin ingin menghapus kegiatan ini?');">Hapus</a>
                        <a href="admin.php?selesai=<?php echo $row['id_kegiatan']; ?>"
                            onclick="return confirm('Anda yakin kegiatan ini sudah selesai?');">Sudah Selesai</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #A2CA71;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 20px;

    }

    form {
        width: 40%;
        margin: 10px auto;
        background-color: #BEDC74;
        padding: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }



    label,
    input,
    textarea {
        display: block;
        margin-bottom: 20px;
        width: 100%;
        margin-top: -20px;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    input[type="number"],
    textarea {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: black;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    

    a:hover {
        background-color: #45a049;
        color: black;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
        color: black;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    .container header img {
        width: 500px;
        margin-left: 20px;
    }

    .container li a {
        margin-right: 20px;
        color: black;
    }

    .container {
        width: 100%;
        height: 100px;
        background-color: #387F39;
        justify-content: space-between;
        font-size: 12px;
        align-items: center;
        display: flex;
        flex-direction: row;

    }

    .container h2 {
        display: flex;
        flex-direction: row;
        margin-right: 100px;
        margin-bottom: 10px;
        font-size: 18px;

    }
</style>

</html>
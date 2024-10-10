<?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jadwal_kegiatan Kegiatan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <header><img src="logoo.png" alt=""></header>
        <h2>APLIKASI KEGIATAN PERBANYAKAN BENIH/BIBIT MANGGA BERSERTIFIKAT</h2>
    </div>
    <div class="sidebar">
        <ul>
            <li><a href="kegiatan.php">Jadwal Kegiatan</a></li>
            <li><a href="sudah_selesai.php">Kegiatan yang sudah selesai</a></li>
            <li><a href="utama.html">Menu utama</a></li>
            <li><a href="login.html">Admin</a></li>

        </ul>
    </div>

    <?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Sudah Selesai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Daftar Kegiatan yang Sudah Selesai</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kegiatan</th>
                <th>Hari/Tanggal</th>
                <th>Waktu</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM kegiatan WHERE status='selesai'");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_kegiatan']; ?></td>
                    <td><?php echo $row['nama_kegiatan']; ?></td>
                    <td><?php echo $row['hari_tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td><?php echo $row['keterangan']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

</body>
<style>
    body {
    font-family: 'Roboto', sans-serif;
    background: #A2CA71;
}
*{
    margin: 0;
    padding: 0;
    list-style: none;
    text-decoration: none;

}
.sidebar{
    position: fixed;
    left: 0 ;
    width: 350px;
    height: 100%;
    background: #BEDC74;
}
.container header img{
    width: 400px; 
    margin-left: 20px;
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
.container h2{
    display: flex;
    flex-direction: row;
    margin-right: 150px;
    margin-bottom: 10px;
    font-size: 18px;

}
.sidebar ul a{
    display: block;
    height: 100%;
    width: 100% ;
    line-height: 65px;
    font-size: 20px;
    color: black;
    padding-left: 40px;
    box-sizing: border-box;
    border-top: 1px solid rgba(255, 255, 255, .1);
}

ul li:hover a{
    padding-left: 50px;
}

h3 {
    text-align: center;
    margin-top: 20px;
    margin-left: 22%;
}

form {
    width: 50%;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label, input, textarea {
    display: block;
    margin-bottom: 10px;
    width: 100%;
}

input[type="text"], input[type="date"], input[type="time"], input[type="number"], textarea {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

table {
    width: 72%;
    margin: 20px auto;
    border-collapse: collapse;
    margin-right: 20px;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 12px;
    text-align: left;
}

</style>
</html>

<?php

// var_dump($_REQUEST);
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'dbtedc');

$nama_foto = null;
if ($_FILES['foto']['name'] != '') {
    $name = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];

    // Check if the uploaded file is an image
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $file_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (in_array($file_extension, $allowed_extensions)) {
        // Generate a unique name for the photo
        $nama_foto = time() . '_' . $name;

        // Move the uploaded file to the "foto" folder
        move_uploaded_file($tmp_name, "foto/" . $nama_foto);
    } else {
        // Handle if the uploaded file is not an image
        $_SESSION['error'] = 'Only JPG, JPEG, and PNG files are allowed.';
        header("Location: insert.php");
        exit;
    }
}

$nim = $_REQUEST['nim'];
$nama = $_REQUEST['nama'];
$periode = $_REQUEST['periode'];
$kelas = $_REQUEST['kelas'];
$prodi = $_REQUEST['prodi'];
$foto = $nama_foto;

$insert = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, periode, kelas, prodi, foto)
                               VALUES ('$nim', '$nama', '$periode', '$kelas', '$prodi', '$foto')");

if ($insert) {
    $_SESSION['message'] = 'Data Mahasiswa Berhasil Tambah.';
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($conn);
}

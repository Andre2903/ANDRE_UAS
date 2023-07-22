<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'dbtedc');

$nim = $_REQUEST ['nim'];

$delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($delete){
    $_SESSION['message'] = 'Data Mahasiswa Berhasil Dihapus.';
    header("Location: index.php");

}else{
    echo "Error: " . mysqli_error($conn);
}


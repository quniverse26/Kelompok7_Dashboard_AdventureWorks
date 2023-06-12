<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "adventureworks-dw";    

$koneksi = mysqli_connect($host, $user, $password, $database);

if(!$koneksi){
    echo "Koneksi Gagal! : ". mysqli_connect_error();
}

?>
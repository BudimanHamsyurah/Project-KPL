<?php
    $koneksi = mysqli_connect("localhost","root","","jadwal");
 
    if (mysqli_connect_errno()){
    echo "Koneksi database gagal : " . mysqli_connect_error();
    }
    $id = $idValue;
    $status = 'Bersandar';
    mysqli_query($koneksi,"update arrivals set status='$status' where id='$id'");
    
?>
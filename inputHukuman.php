<?php 
	include "koneksi.php";
	
	$nip = $_POST['nip'];
	$nim = $_POST['nim'];
	$kompen = $_POST['kompen'];
	$alasan = $_POST['alasan'];

	$datauser = array();

    
	$sqldataD = mysqli_query($koneksi, "select * from dosen where nip = '".$nip."'");
	$countD = mysqli_num_rows($sqldataD);

	$sqldataM = mysqli_query($koneksi, "select * from mahasiswa where nim = '".$nim."'");
	$countM = mysqli_num_rows($sqldataM);

    if($countD == 0){
        echo json_encode("ID Dosen Salah");
    }else if($countM == 0){
        echo json_encode("ID Mahasiswa Salah");
    }else  if($countD == 1 && $countM == 1){
        $insert = "INSERT INTO hukuman(nip, nim, jam_kompen, alasan, tgl)
                   VALUES('".$nip."','".$nim."','".$kompen."','".$alasan."',NOW())";
        
        $query = mysqli_query($koneksi, $insert);
        if($query){
        echo json_encode("Succes");
        }
    }

?>
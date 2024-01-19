<?php
include_once "koneksi.php";

$nip = isset($_POST['nip']) ? $_POST['nip'] : null;
$nama = isset($_POST['nama']) ? $_POST['nama'] : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

$nim = '1122334';
// Check if the 'foto' key exists in $_FILES and if the file was uploaded successfully
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
} else {}


		$datauser = array();		
		$sql = "SELECT m.`nim`, `nama_lengkap`, `th_masuk`, `prodi`, `jalurmasuk`, `email`, `no_telp`, `username`, `password`, `foto`, SUM(t.kompen) terkompen FROM `mahasiswa` m LEFT join tugas_selesai t on m.nim = t.nim AND t.status = 'Completed' WHERE m.nim = '1122334'" ;

		$sqldatamahasiswa = mysqli_query($koneksi,$sql);
		$count = mysqli_num_rows($sqldatamahasiswa);

		if($count > 0){
			while($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)){
				$datauser[] = array(
					'nim' => $rowdatauser['nim'],
					'nama_lengkap' => $rowdatauser['nama_lengkap'],
					'th_masuk' => $rowdatauser['th_masuk'],
					'prodi' => $rowdatauser['prodi'],	
					'jalurmasuk' => $rowdatauser['jalurmasuk'],
					'email' => $rowdatauser['email'],
					'no_telp' => $rowdatauser['no_telp'],
					'username' => $rowdatauser['username'],
					'password' => $rowdatauser['password'],
					'foto' => $rowdatauser['foto'],
					'terkompen' => $rowdatauser['terkompen'],
				);
			}
			echo json_encode($datauser);
		}else{
			http_response_code(404);
		}
?>

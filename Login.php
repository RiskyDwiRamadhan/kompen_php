<?php
include_once "koneksi.php";

$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : null;
$nama = isset($_POST['nama']) ? $_POST['nama'] : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$no_telp = isset($_POST['no_telp']) ? $_POST['no_telp'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
	$foto = date('dmYHis') . str_replace(" ", "", basename($_FILES['foto']['name']));
        $imagePath = "uploads/".$foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);
} else {
	$foto = null;
}

//get Data Dosen
if ("get_dosen" == $action) {
	$datauser = array();

	$sqldatadosen = mysqli_query($koneksi, "SELECT nip, nama_lengkap, username, password, email, no_telp, foto, level FROM dosen 
											where username = '" . $username . "' and password = '" . $password . "'");

	if ($sqldatadosen) {
		$count = mysqli_num_rows($sqldatadosen);

		if ($count > 0) {
			while ($rowdatauser = mysqli_fetch_array($sqldatadosen)) {
				$datauser[] = array(
					'id_user' => $rowdatauser['nip'],
					'nama_lengkap' => $rowdatauser['nama_lengkap'],
					'username' => $rowdatauser['username'],
					'password' => $rowdatauser['password'],
					'email' => $rowdatauser['email'],
					'no_telp' => $rowdatauser['no_telp'],
					'foto' => $rowdatauser['foto'],
					'status' => $rowdatauser['level']
				);
			}
			echo json_encode($datauser);
		} else {
			http_response_code(404);
		}
	}
}

//get Data mahasiswa
if ("get_mahasiswa" == $action) {
	$datauser = array();

	$sqldatadosen = mysqli_query($koneksi, "SELECT nim, nama_lengkap, username, password, email, no_telp, foto FROM mahasiswa 
											where username = '" . $username . "' and password = '" . $password . "'");

	if ($sqldatadosen) {
		$count = mysqli_num_rows($sqldatadosen);

		if ($count > 0) {
			while ($rowdatauser = mysqli_fetch_array($sqldatadosen)) {
				$datauser[] = array(
					'id_user' => $rowdatauser['nim'],
					'nama_lengkap' => $rowdatauser['nama_lengkap'],
					'username' => $rowdatauser['username'],
					'password' => $rowdatauser['password'],
					'email' => $rowdatauser['email'],
					'no_telp' => $rowdatauser['no_telp'],
					'foto' => $rowdatauser['foto'],
					'status' => 'Mahasiswa'
				);
			}
			echo json_encode($datauser);
		} else {
			http_response_code(404);
		}
	}
}


	// Update Data Mahasiswa
	if("update_mahasiswa" == $action){
        // $imagePath = "uploads/".$foto;
        // move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);

		$sql = "update mahasiswa set nama_lengkap = '".$nama."', no_telp = '".$no_telp."',
									 username = '".$username."',password = '".$password."',email = '".$email."',foto = '".$foto."'
								 	 where nim = '".$idUser."'";
		$sqldatamahasiswa = mysqli_query($koneksi, $sql);
		if($sqldatamahasiswa){
			echo json_encode("Succes");
		}else{
			http_response_code(404);
		}
	}

	// Update Data Dosen
	if("update_dosen" == $action){
        $imagePath = "uploads/".$foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);

		$sql = "update dosen set  nama_lengkap = '".$nama."', no_telp = '".$no_telp."',
									 username = '".$username."',password = '".$password."',email = '".$email."',foto = '".$foto."'
								 	 where nip = '".$idUser."'";
		$sqldatadosen = mysqli_query($koneksi, $sql);
		if($sqldatadosen){
			echo json_encode("Succes");
		}else{
			http_response_code(404);
		}
	}


?>
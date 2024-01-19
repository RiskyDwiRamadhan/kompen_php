<?php 
	include_once "koneksi.php";

	$id_tugas = isset($_POST['id_tugas']) ? $_POST['id_tugas'] : null;
	$nim = isset($_POST['nim']) ? $_POST['nim'] : null;
	$nip = isset($_POST['nip']) ? $_POST['nip'] : null;
	$status = isset($_POST['status']) ? $_POST['status'] : null;
	$judul_tugas = isset($_POST['judul_tugas']) ? $_POST['judul_tugas'] : null;
	$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : null;
	$tgl = isset($_POST['tgl']) ? $_POST['tgl'] : null;
	$kuota = isset($_POST['kuota']) ? $_POST['kuota'] : null;
	$jumlah_kompen = isset($_POST['jumlah_kompen']) ? $_POST['jumlah_kompen'] : null;
	$deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : null;
	$action = isset($_POST['action']) ? $_POST['action'] : null;

	//All Data Tugas
	if("get_all" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tugas ORDER BY id_tugas DESC");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tugas' => $rowdatauser['id_tugas'],
						'fotod' => $rowdatauser['fotod'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl' => $rowdatauser['tgl'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//All Data Tugas Ready
	if("get_ready" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tugas where status = 'Ready' ORDER BY id_tugas DESC");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tugas' => $rowdatauser['id_tugas'],
						'fotod' => $rowdatauser['fotod'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl' => $rowdatauser['tgl'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//All Data Tugas where nip
	if("where_nip" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tugas where nip = '".$nip."' and status = '".$status."'");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tugas' => $rowdatauser['id_tugas'],
						'fotod' => $rowdatauser['fotod'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl' => $rowdatauser['tgl'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//All Data History Tugas
	if("all_history" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tugas where status = '".$status."'");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tugas' => $rowdatauser['id_tugas'],
						'fotod' => $rowdatauser['fotod'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl' => $rowdatauser['tgl'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//data where
	if("get_nim" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tnim ORDER BY id_tugas DESC");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tugas' => $rowdatauser['id_tugas'],
						'fotod' => $rowdatauser['fotod'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl' => $rowdatauser['tgl'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	// Add Data
	if("add_data" == $action){
        $sqldataD = mysqli_query($koneksi, "select * from dosen where nip = '".$nip."'");
        $countD = mysqli_num_rows($sqldataD);

        if($countD == 0){
            echo json_encode("ID Dosen Salah");
        }else {
            $insert = "INSERT INTO tugas(nip, judul_tugas, kategori, tgl, kuota, jumlah_kompen, status, deskripsi)
                    VALUES('".$nip."','".$judul_tugas."','".$kategori."',NOW(),'".$kuota."','".$jumlah_kompen."', 'Ready','".$deskripsi."')";
            
            $query = mysqli_query($koneksi, $insert);
            if($query){
                echo json_encode("Succes");
            }
        }
	}

	// Update Data
	if("update" == $action){

		$sql = "update tugas set judul_tugas = '".$judul_tugas."',kategori = '".$kategori."',
								 kuota = '".$kuota."',jumlah_kompen = '".$jumlah_kompen."',deskripsi = '".$deskripsi."'
								 where id_tugas = '".$id_tugas."'";
		$sqldataTugas = mysqli_query($koneksi, $sql);
		if($sqldataTugas){
			echo json_encode("Succes");
		}else{
			echo json_encode("Error");
		}
	}

	// Update Status Tugas
	if("update_status" == $action){

		$sql = "update tugas set status = 'Completed'
								 where id_tugas = '".$id_tugas."'";
		$sqldataTugas = mysqli_query($koneksi, $sql);
		if($sqldataTugas){
			echo json_encode("Succes");
		}else{
			echo json_encode("Error");
		}
	}

	// Delete Data
	if("Delete" == $action){
		$datauser = array();
		$sql = "delete from tugas where id_tugas = '".$id_tugas."'";
		$sqldataTugas = mysqli_query($koneksi, $sql);

		if($sqldataTugas){
			echo json_encode("Succes");
		}else{
			echo json_encode("Error");
		}
	}
?>
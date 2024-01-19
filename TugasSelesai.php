<?php 
	include_once "koneksi.php";

	$id_tselesai = isset($_POST['id_tselesai']) ? $_POST['id_tselesai'] : null;
	$id_tugas = isset($_POST['id_tugas']) ? $_POST['id_tugas'] : null;
	$nim = isset($_POST['nim']) ? $_POST['nim'] : null;
	$kompen = isset($_POST['kompen']) ? $_POST['kompen'] : null;
	$tgl = isset($_POST['tgl']) ? $_POST['tgl'] : null;
	$status = isset($_POST['status']) ? $_POST['status'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

	//All Data Tugas
	if("get_all" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tselesai");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tselesai' => $rowdatauser['id_tselesai'],
						'id_tugas' => $rowdatauser['id_tugas'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl_selesai' => $rowdatauser['tgl_selesai'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
						'namam' => $rowdatauser['namam'],
						'terkompen' => $rowdatauser['terkompen'],
						'status' => $rowdatauser['status'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//All Data Tugas completed
	if("get_completed" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tselesai where nim = '".$nim."'");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tselesai' => $rowdatauser['id_tselesai'],
						'id_tugas' => $rowdatauser['id_tugas'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl_selesai' => $rowdatauser['tgl_selesai'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
						'namam' => $rowdatauser['namam'],
						'terkompen' => $rowdatauser['terkompen'],
						'status' => $rowdatauser['status'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//All Data Ambil Tugas
	if("where_get_tugas" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM v_tselesai where id_tugas = '".$id_tugas."'");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'id_tselesai' => $rowdatauser['id_tselesai'],
						'id_tugas' => $rowdatauser['id_tugas'],
						'namad' => $rowdatauser['namad'],
						'judul_tugas' => $rowdatauser['judul_tugas'],
						'kategori' => $rowdatauser['kategori'],
						'tgl_selesai' => $rowdatauser['tgl_selesai'],
						'kuota' => $rowdatauser['kuota'],
						'jumlah_kompen' => $rowdatauser['jumlah_kompen'],
						'deskripsi' => $rowdatauser['deskripsi'],
						'namam' => $rowdatauser['namam'],
						'terkompen' => $rowdatauser['terkompen'],
						'status' => $rowdatauser['status'],
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
        $sqldata = mysqli_query($koneksi, "select * from mahasiswa where nim = '".$nim."'");
        $count = mysqli_num_rows($sqldata);

        if($count == 0){
            echo json_encode("ID Mahasiswa Salah");
        }else {
            $insert = "INSERT INTO tugas_selesai(id_tugas, nim, kompen, tgl, status)
                    VALUES('".$id_tugas."','".$nim."','".$kompen."',NOW(),'Proses')";
            
            $query = mysqli_query($koneksi, $insert);
            if($query){
                echo json_encode("Succes");
            }
        }
	}

	// Update Data
	if("update" == $action){

		$sql = "update tugas_selesai set status = 'Completed'
								 where id_tselesai = '".$id_tselesai."'";
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
		$sql = "delete from tugas_selesai where id_tselesai = '".$id_tselesai."'";
		$sqldataTugas = mysqli_query($koneksi, $sql);

		if($sqldataTugas){
			echo json_encode("Succes");
		}else{
			echo json_encode("Error");
		}
	}
?>
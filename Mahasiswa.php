<?php 
	include_once "koneksi.php";

	$nim = isset($_POST['nim']) ? $_POST['nim'] : null;
	$nama = isset($_POST['nama']) ? $_POST['nama'] : null;
	$prodi = isset($_POST['prodi']) ? $_POST['prodi'] : null;
	$no_telp = isset($_POST['no_telp']) ? $_POST['no_telp'] : null;
	$username = isset($_POST['username']) ? $_POST['username'] : null;
	$password = isset($_POST['password']) ? $_POST['password'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$action = isset($_POST['action']) ? $_POST['action'] : null;
	$th_masuk = isset($_POST['th_masuk']) ? $_POST['th_masuk'] : null;

	if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
		$foto = date('dmYHis') . str_replace(" ", "", basename($_FILES['foto']['name']));
        $imagePath = "uploads/".$foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);

	} else {
		$foto = null;
	}

	// if(empty($_FILES['foto'])){
	// 	$foto = isset($_POST['foto']) ? $_POST['foto'] : null;
	// }else{
	// 	$foto = date('dmYHis') . str_replace(" ", "", basename($_FILES['foto']['name']));
    //     $imagePath = "uploads/".$foto;
    //     move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);
	// }

	//All Data mahasiswa
	if("get_all" == $action){
		$datauser = array();
				
		$sqldatamahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim DESC");
		
		if ($sqldatamahasiswa) {
			$count = mysqli_num_rows($sqldatamahasiswa);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)) {
					$datauser[] = array(
						'nim' => $rowdatauser['nim'],
						'nama_lengkap' => $rowdatauser['nama_lengkap'],
						'prodi' => $rowdatauser['prodi'],
						'no_telp' => $rowdatauser['no_telp'],
						'th_masuk' => $rowdatauser['th_masuk'],
						'username' => $rowdatauser['username'],
						'password' => $rowdatauser['password'],
						'email' => $rowdatauser['email'],
						'foto' => $rowdatauser['foto'],
					);
				}
				echo json_encode($datauser);
			} else {
				http_response_code(404);
			}
		}
	}

	//data where
	if("get_where" == $action){
		$datauser = array();
		$sqldatamahasiswa = mysqli_query($koneksi, "select * from mahasiswa where nim = '".$nim."' ");
		$count = mysqli_num_rows($sqldatamahasiswa);

		if($count > 0){
			while($rowdatauser = mysqli_fetch_array($sqldatamahasiswa)){
				$datauser[] = array(
					'nim' => $rowdatauser['nim'],
					'nama_lengkap' => $rowdatauser['nama_lengkap'],
					'prodi' => $rowdatauser['prodi'],
					'no_telp' => $rowdatauser['no_telp'],
					'th_masuk' => $rowdatauser['th_masuk'],
					'username' => $rowdatauser['username'],
					'password' => $rowdatauser['password'],
					'email' => $rowdatauser['email'],
					'foto' => $rowdatauser['foto'],
				);
			}
			echo json_encode($datauser);
		}else{
			http_response_code(404);
		}
	}

	//data where
	if("alpa_mahasiswa" == $action){
		$datauser = array();		
		$sql = "SELECT m.`nim`, `nama_lengkap`, `th_masuk`, `prodi`, `jalurmasuk`, `email`, `no_telp`, `username`, `password`, `foto`, COALESCE(SUM(t.kompen),0) terkompen FROM `mahasiswa` m LEFT join tugas_selesai t on m.nim = t.nim AND t.status = 'Completed' WHERE m.nim = '".$nim."'" ;

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
	}

	// Add Data
	if("add_data" == $action){
        $imagePath = "uploads/".$foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);

        $datauser = array();
        $sql = "select * from mahasiswa where username = '".$username."' and password = '".$password."'";
        $sqldatamahasiswa = mysqli_query($koneksi, $sql);
        $count = mysqli_num_rows($sqldatamahasiswa);

        if($count == 1){
            http_response_code(404);
        }else{
			$insert = "INSERT INTO mahasiswa(nim, nama_lengkap, th_masuk, prodi, email, no_telp, username, password, foto)
						VALUES('".$nim."','".$nama."','".$th_masuk."','".$prodi."','".$email."','".$no_telp."','".$username."','".$password."','".$foto."')";
			$query = mysqli_query($koneksi, $insert);
            if($query){
                echo json_encode("Succes");
            }else{
                http_response_code(404);
            }
        }
	}

	// Update Data
	if("update" == $action){
		if($foto == ""){			
		$sql = "update mahasiswa set nama_lengkap = '".$nama."',th_masuk= '".$th_masuk."',prodi= '".$prodi."',no_telp = '".$no_telp."',username = '".$username."',password = '".$password."',email = '".$email."' where nim = '".$nim."'";
		}else{			
		$sql = "update mahasiswa set nama_lengkap = '".$nama."',th_masuk= '".$th_masuk."',prodi= '".$prodi."',no_telp = '".$no_telp."',username = '".$username."',password = '".$password."',email = '".$email."',foto = '".$foto."'
								 	 where nim = '".$nim."'";
		}
		$sqldatamahasiswa = mysqli_query($koneksi, $sql);
		if($sqldatamahasiswa){
			echo json_encode("Succes");
		}else{
			http_response_code(404);
		}
	}

	// Delete Data
	if("Delete" == $action){
		$datauser = array();
		$sql = "delete from mahasiswa where nim = '".$nim."'";
		$sqldatamahasiswa = mysqli_query($koneksi, $sql);

		if($sqldatamahasiswa){
			echo json_encode("Succes");
		}else{
			http_response_code(404);
		}
	}
?>
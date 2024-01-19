<?php 
	include_once "koneksi.php";

	$nip = isset($_POST['nip']) ? $_POST['nip'] : null;
	$nama = isset($_POST['nama']) ? $_POST['nama'] : null;
	$username = isset($_POST['username']) ? $_POST['username'] : null;
	$password = isset($_POST['password']) ? $_POST['password'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$status = isset($_POST['status']) ? $_POST['status'] : null;
	$action = isset($_POST['action']) ? $_POST['action'] : null;

	if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
		$foto = date('dmYHis') . str_replace(" ", "", basename($_FILES['foto']['name']));
        $imagePath = "uploads/".$foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $imagePath);

	} else {
		$foto = null;
	}

	//All Data Dosen
	if("get_all" == $action){
		$datauser = array();
				
		$sqldatadosen = mysqli_query($koneksi, "SELECT nip, nama_lengkap, username, password, email, foto, level FROM dosen ORDER BY nip DESC");
		
		if ($sqldatadosen) {
			$count = mysqli_num_rows($sqldatadosen);
			
			if ($count > 0) {
				while ($rowdatauser = mysqli_fetch_array($sqldatadosen)) {
					$datauser[] = array(
						'nip' => $rowdatauser['nip'],
						'nama_lengkap' => $rowdatauser['nama_lengkap'],
						'username' => $rowdatauser['username'],
						'password' => $rowdatauser['password'],
						'email' => $rowdatauser['email'],
						'foto' => $rowdatauser['foto'],
						'level' => $rowdatauser['level']
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
		$sqldatadosen = mysqli_query($koneksi, "select nip, nama_lengkap,username, password, email, foto, level from dosen where nip = '".$nip."' ");
		$count = mysqli_num_rows($sqldatadosen);

		if($count > 0){
			while($rowdatauser = mysqli_fetch_array($sqldatadosen)){
				$datauser[] = array(
					'nip' => $rowdatauser['nip'],
					'nama_lengkap' => $rowdatauser['nama_lengkap'],
					'username' => $rowdatauser['username'],
					'password' => $rowdatauser['password'],
					'email' => $rowdatauser['email'],
					'foto' => $rowdatauser['foto'],
					'level' => $rowdatauser['level']
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
        $sql = "select * from dosen where username = '".$username."' and password = '".$password."'";
        $sqldatadosen = mysqli_query($koneksi, $sql);
        $count = mysqli_num_rows($sqldatadosen);

        if($count == 1){
            http_response_code(404);
        }else{
            $insert = "INSERT INTO dosen(nip, nama_lengkap, username, password, email, foto, level)
                        VALUES('".$nip."','".$nama."','".$username."','".$password."','".$email."','".$foto."','".$status."')";
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
		$sql = "update dosen set nama_lengkap = '".$nama."',username = '".$username."',password = '".$password."',
								 email = '".$email."',level = '".$status."'
								 where nip = '".$nip."'";
		}else{
		$sql = "update dosen set nama_lengkap = '".$nama."',username = '".$username."',password = '".$password."',
								 email = '".$email."',foto = '".$foto."',level = '".$status."'
								 where nip = '".$nip."'";
		}
		$sqldatadosen = mysqli_query($koneksi, $sql);
		if($sqldatadosen){
			echo json_encode("Succes");
		}else{
			http_response_code(404);
		}
	}

	// Delete Data
	if("Delete" == $action){
		$datauser = array();
		$sql = "delete from dosen where nip = '".$nip."'";
		$sqldatadosen = mysqli_query($koneksi, $sql);

		if($sqldatadosen){
			echo json_encode("Succes");
		}else{
			http_response_code(404);
		}
	}
?>
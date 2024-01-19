<?php 
	include_once "koneksi.php";

	$id_alpa = isset($_POST['id_alpa']) ? $_POST['id_alpa'] : null;
	$nim = isset($_POST['nim']) ? $_POST['nim'] : null;
	$semester = isset($_POST['semester']) ? $_POST['semester'] : null;
	$action = isset($_POST['action']) ? $_POST['action'] : null;
    

	//All Data Alpaku
	if("get_all" == $action){
		$data = array();
				
		$sqldata = mysqli_query($koneksi, "SELECT * FROM alpa ORDER BY nim DESC");
		
		if ($sqldata) {
			$count = mysqli_num_rows($sqldata);
			
			if ($count > 0) {
				while ($rowdata = mysqli_fetch_array($sqldata)) {
					$data[] = array(
						'id_alpa' => $rowdata['id_alpa'],
						'nim' => $rowdata['nim'],
						'jml_alpa' => $rowdata['jml_alpa'],
						'semester' => $rowdata['semester'],
					);
				}
				echo json_encode($data);
			} else {
				http_response_code(404);
			}
		}
	}
    
	//All Data Alpaku
	if("get_where" == $action){
		$data = array();
				
		$sqldata = mysqli_query($koneksi, "SELECT * FROM alpa where nim = '".$nim."'");
		
		
		if ($sqldata) {
			$count = mysqli_num_rows($sqldata);
			
			if ($count > 0) {
				while ($rowdata = mysqli_fetch_array($sqldata)) {
					$data[] = array(
						'id_alpa' => $rowdata['id_alpa'],
						'nim' => $rowdata['nim'],
						'jml_alpa' => $rowdata['jml_alpa'],
						'semester' => $rowdata['semester'],
					);
				}
				echo json_encode($data);
			} else {
				http_response_code(404);
			}
		}
	}

	//All Detail Alpaku
	if("get_detail" == $action){
		$data = array();
		
		$sql = "SELECT `id_alpa`, `nim`, SUM(`jml_alpa`) jamAlpa, SUM(`menitalpa`) menitAlpa, SUM(`jamsakit`) jamSakit, SUM(`menitsakit`) menitSakit, SUM(`jamijin`) jamIjin, SUM(`menitijin`) menitIjin, `semester` FROM `alpa` WHERE nim = '".$nim."' AND semester = '".$semester."'";
		$sqldata = mysqli_query($koneksi, $sql);
		
		
		if ($sqldata) {
			$count = mysqli_num_rows($sqldata);
			
			if ($count > 0) {
				while ($rowdata = mysqli_fetch_array($sqldata)) {
					$data[] = array(
						'id_alpa' => $rowdata['jamAlpa'],
						'nim' => $rowdata['nim'],
						'jamAlpa' => $rowdata['jamAlpa'],
						'menitAlpa' => $rowdata['menitAlpa'],
						'jamSakit' => $rowdata['jamSakit'],
						'menitSakit' => $rowdata['menitSakit'],
						'jamIjin' => $rowdata['jamIjin'],
						'menitIjin' => $rowdata['menitIjin'],
						'semester' => $rowdata['semester'],
					);
				}
				echo json_encode($data);
			} else {
				http_response_code(404);
			}
		}
	}

	// Add Data
	if("add_data" == $action){
        $sql = "select * from alpa where nim = '".$nim."' and semester = '".$semester."'";
        $sqldata = mysqli_query($koneksi, $sql);
        $count = mysqli_num_rows($sqldata);

        if($count == 1){
            http_response_code(404);
        }else{
			$insert = "INSERT INTO alpa(nim, semester)
						VALUES('".$nim."','".$semester."')";
			$query = mysqli_query($koneksi, $insert);
            if($query){
                echo json_encode("Succes");
            }else{
                http_response_code(404);
            }
        }
	}

?>

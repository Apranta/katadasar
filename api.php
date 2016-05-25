<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept");



$action = $_GET['action'];

	switch ($action) {
				case 'ambil'://untuk mengambil data
				$host = "ap-cdbr-azure-southeast-b.cloudapp.net";
				$user = "b45b328da2be2a";
				$pass = "b829be01";
				$db = "acsm_a2561e6f848ef10";
				$conn = new mysqli("$host", "$user", "$pass", "$db");
						$result = $conn->query("SELECT * FROM tb_katadasar order by time asc");

						$outp = "";
						while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
						    if ($outp != "") {$outp .= ",";}
						    $outp .= '{"id":"'. $rs["id"] . '",';
						    $outp .= '"kata":"' . $rs["kata"] . '",';
						    $outp .= '"suku_kata":"'  . $rs["suku_kata"] . '"}';
						}
						$outp ='{"records":['.$outp.']}';
						$conn->close();

						echo($outp);
					break;
				case 'kirim':
					$postdata = file_get_contents("php://input");
					$request = json_decode($postdata);
					$isu = $request->permasalahan;
					$kategori = $request->kategori;

					$con = mysql_connect("cicak.cicak.di.dinding.lo","db_bem","frKuM8H0") or die(mysql_error());
					mysql_select_db('db_bem2',$con);

					if ($isu=='') {
						echo "gagal";
					}
					else{
					$qry_em = 'INSERT INTO aspirasi_isu (id,permasalahan,suka,time,kategori) VALUES ("","'.$isu.'","","","'.$kategori.'")';
					$qry_res = mysql_query($qry_em);
					}
					break;
				case 'get':
					$connection = mysqli_connect("localhost:8080", "root", "", "kata_dasar");
					$query = mysqli_query($connection, "SELECT * FROM tb_katadasar");
					$data = array();

					if (mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							$data []= $row;
						}
					} 
					echo json_encode($data);
					break;
				default:
				break;
			}

?>
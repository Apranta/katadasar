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
					$kata = $request->kata_dasar;
					$suku_kata = $request->suku_kata;

					$con = mysql_connect("ap-cdbr-azure-southeast-b.cloudapp.net","b45b328da2be2a","b829be01") or die(mysql_error());
					mysql_select_db('acsm_a2561e6f848ef10',$con);

					if ($isu=='') {
						echo "gagal";
					}
					else{
					$qry_em = 'INSERT INTO tb_katadasar (id,kata,suku_kata) VALUES ("","'.$kata.'","","","'.$suku_kata.'")';
					$qry_res = mysql_query($qry_em);
					}
					break;
				default:
				break;
			}

?>
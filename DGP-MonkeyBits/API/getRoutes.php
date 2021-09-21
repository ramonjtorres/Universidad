<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
$json2 = array();

	if(isset($_GET["Start"])){
		$Start = $_GET['Start'];

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		$sql="SELECT * FROM route LIMIT $Start,10";
		$result=mysqli_query($connection,$sql);

		if($sql){
			$x = 0;
			$json['OPERATIONS'][0]="GET_ROUTES";
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple['IdRoute'] = $reg['IdRoute'];
				$jsonTuple['Email'] = $reg['Email'];
				$jsonTuple['MadeBy'] = $reg['MadeBy'];
				$jsonTuple['Name'] = $reg['Name'];
				$jsonTuple['Description'] = $reg['Description'];
				$jsonTuple['Image'] = $reg['Image'];
				$jsonTuple['ImageDescription'] = $reg['ImageDescription'];

				$json['GET_ROUTES'][$x]=$jsonTuple;
				$x++;

			}
			
			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

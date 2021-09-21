<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
	if(isset($_GET["IdPlace"])){
		$IdPlace = $_GET['IdPlace'];

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		//$sql="SELECT IdRoute FROM favoriteroutes WHERE Email IN ('".$Email."')";
		$sql = "SELECT AVG(Rating) FROM visit WHERE IdPlace IN ('".$IdPlace."')";
		$result=mysqli_query($connection,$sql);

		if($sql){
			$json['OPERATIONS'][0]="GET_AVERAGE_SCORE_PLACE";
			if($reg=mysqli_fetch_array($result)){
				$jsonTuple['Rating'] = $reg['AVG(Rating)'];

				$json['GET_AVERAGE_SCORE_PLACE'][0]=$jsonTuple;
			}
			
			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

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
		
		$sql = "SELECT placecomments.IdPlace, placecomments.Email, placecomments.Content, placecomments.Date, placecomments.Time, user.Name FROM placecomments, user WHERE IdPlace = '{$IdPlace}'  AND placecomments.Reported = 0 and placecomments.Email = user.Email order by placecomments.Date desc, placecomments.Time desc";
		$result=mysqli_query($connection,$sql);

		if($sql){
			$x = 0;
			$json['OPERATIONS'][0] = "GET_PLACE_COMMENTS";
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple['IdPlace'] = $reg['IdPlace'];
				$jsonTuple['Email'] = $reg['Email'];
				$jsonTuple['Content'] = $reg['Content'];
				$jsonTuple['Date'] = $reg['Date'];
				$jsonTuple['Time'] = $reg['Time'];
				$jsonTuple['Reported'] = $reg['Reported'];

				$json['GET_PLACE_COMMENTS'][$x]=$jsonTuple;
				$x++;
			}
			
			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

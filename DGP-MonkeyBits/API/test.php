<?PHP
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
	// ESTO ESTÁ BASADO EN EL CÓDIGO DE getPlacesFromRoute.php
	if(isset($_GET["IdRoute"])){
		$IdRoute = $_GET['IdRoute'];

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		$sql1="SELECT * FROM place LEFT JOIN appearverified ON place.IdPlace = appearverified.IdPlace WHERE appearverified.IdRoute = '{$IdRoute}'";
		$result=mysqli_query($connection,$sql1);

		if($sql1){
			$x = 0;
			$json['OPERATIONS'][0]="GET_PLACES_FROM_ROUTE";
			$jsonTuple;
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple['IdPlace'] = $reg['IdPlace'];
				$jsonTuple['Email'] = $reg['Email'];
				$jsonTuple['MadeBy'] = $reg['MadeBy'];
				$jsonTuple['Name'] = $reg['Name'];
				$jsonTuple['Description'] = $reg['Description'];
				$jsonTuple['Localitation'] = $reg['Localitation'];
				$jsonTuple['Image'] = $reg['Image'];
				$jsonTuple['RedMovility'] = $reg['RedMovility'];
				$jsonTuple['RedVision'] = $reg['RedVision'];
				$jsonTuple['ColourBlind'] = $reg['ColourBlind'];
				$jsonTuple['Deaf'] = $reg['Deaf'];
				$jsonTuple['Foreigner'] = $reg['Foreigner'];

				$json['GET_PLACES_FROM_ROUTE'][$x]=$jsonTuple;
				$x++;
			}
		}

		// Segunda consulta:
		$sql2="SELECT * FROM routecomments WHERE IdRoute = '{$IdRoute}'";
		$result=mysqli_query($connection,$sql2);

		if($sql2){
			$jsonTuple2;
			$x = 0;
			$json['OPERATIONS'][1]="GET_COMMENTS_FROM_ROUTE";
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple2['IdRoute'] = $reg['IdRoute'];
				$jsonTuple2['Email'] = $reg['Email'];
				$jsonTuple2['Content'] = $reg['Content'];
				// Faltan el resto de atributos....
				echo '<pre>';
				echo json_encode($jsonTuple2);
				echo '</pre>';

				$json['GET_COMMENTS_FROM_ROUTE'][$x]=$jsonTuple2;
				$x++;
			}
		}

		if ($sql1 && $sql2) {
			mysqli_close($connection);
			echo json_encode($json);
			echo '<pre>';
			echo "Tuplas encontradas: ";
			echo (int)$x;
			echo '</pre>';
		}
	}
?>
<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
	if(isset($_GET["IdRoute"])){
		$IdRoute = $_GET['IdRoute'];

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		$sql1="SELECT IdRoute, Email, MadeBy, Name, Description, Image, ImageDescription FROM route WHERE IdRoute = '{$IdRoute}'";
		$result=mysqli_query($connection,$sql1);

		if($sql1){
			$json['OPERATIONS'][0]="GET_ROUTE";
			$jsonTuple1;
			if($reg=mysqli_fetch_array($result)){
				$jsonTuple1['IdRoute'] = $reg['IdRoute'];
				$jsonTuple1['Email'] = $reg['Email'];
				$jsonTuple1['MadeBy'] = $reg['MadeBy'];
				$jsonTuple1['Name'] = $reg['Name'];
				$jsonTuple1['Description'] = $reg['Description'];
				$jsonTuple1['Image'] = $reg['Image'];
				$jsonTuple1['ImageDescription'] = $reg['ImageDescription'];
				$json['GET_ROUTE']=$jsonTuple1;
			}
		}

		$sql2="SELECT * FROM place LEFT JOIN appearverified ON place.IdPlace = appearverified.IdPlace WHERE appearverified.IdRoute = '{$IdRoute}'";
		$result=mysqli_query($connection,$sql2);

		if($sql2){
			$x = 0;
			$json['OPERATIONS'][1]="GET_PLACES_FROM_ROUTE";
			$jsonTuple2;
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple2['IdPlace'] = $reg['IdPlace'];
				$jsonTuple2['Email'] = $reg['Email'];
				$jsonTuple2['MadeBy'] = $reg['MadeBy'];
				$jsonTuple2['Name'] = $reg['Name'];
				$jsonTuple2['Description'] = $reg['Description'];
				$jsonTuple2['Localitation'] = $reg['Localitation'];
				$jsonTuple2['Image'] = $reg['Image'];
				$jsonTuple2['RedMovility'] = $reg['RedMovility'];
				$jsonTuple2['RedVision'] = $reg['RedVision'];
				$jsonTuple2['ColourBlind'] = $reg['ColourBlind'];
				$jsonTuple2['Deaf'] = $reg['Deaf'];
				$jsonTuple2['Foreigner'] = $reg['Foreigner'];

				$json['GET_PLACES_FROM_ROUTE'][$x]=$jsonTuple2;
				$x++;
			}
		}

		// Tercera consulta:
		$sql3= "SELECT routecomments.IdRoute, routecomments.Email, routecomments.Content, routecomments.Date, routecomments.Time, routecomments.Reported, user.Name FROM routecomments, user WHERE IdRoute = '{$IdRoute}'  AND routecomments.Reported = 0 and routecomments.Email = user.Email order by routecomments.Date desc, routecomments.Time desc";
		$result=mysqli_query($connection,$sql3);

		if($sql3){
			$jsonTuple3;
			$x = 0;
			$json['OPERATIONS'][2]="GET_COMMENTS_FROM_ROUTE";
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple3['IdRoute'] = $reg['IdRoute'];
				$jsonTuple3['Email'] = $reg['Email'];
				$jsonTuple3['Content'] = $reg['Content'];
				$jsonTuple3['Date'] = $reg['Date'];
				$jsonTuple3['Time'] = $reg['Time'];

				$json['GET_COMMENTS_FROM_ROUTE'][$x]=$jsonTuple3;
				$x++;
			}
		}

		$sql4 = "SELECT AVG(Rating) FROM visit WHERE IdRoute IN ('".$IdRoute."')";
		$result=mysqli_query($connection,$sql4);

		if($sql4){
			$jsonTuple4;
			$json['OPERATIONS'][3]="GET_AVERAGE_SCORE_ROUTE";
			if($reg=mysqli_fetch_array($result)){
				$jsonTuple4['score']=$reg[0];
				$json['GET_AVERAGE_SCORE_ROUTE']=$jsonTuple4['score'];
			}
		}

		if ($sql1 && $sql2  && $sql3 && $sql4) {
			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
$json2 = array();

	if(isset($_GET["Search"])){
		$searchItems = $_GET['Search'];

		$searchAccessibility = NULL;

		if(!isset($_GET["RedMovility"])){
			$RedMovility = 0;
		}else{
			$RedMovility = $_GET["RedMovility"];
			$searchAccessibility .= "AND RedMovility = {$_GET["RedMovility"]} ";
		}

		if(!isset($_GET["RedVision"])){
			$RedVision = 0;
		}else{
			$RedVision = $_GET["RedVision"];
			$searchAccessibility .= "AND RedVision = {$_GET["RedVision"]} ";
		}

		if(!isset($_GET["ColourBlind"])){
			$ColourBlind = 0;
		}else{
			$ColourBlind = $_GET["ColourBlind"];
			$searchAccessibility .= "AND ColourBlind = {$_GET["ColourBlind"]} ";
		}

		if(!isset($_GET["Deaf"])){
			$Deaf = 0;
		}else{
			$Deaf = $_GET["Deaf"];
			$searchAccessibility .= "AND Deaf = {$_GET["Deaf"]} ";
		}

		if(!isset($_GET["Foreigner"])){
			$Foreigner = 0;
		}else{
			$Foreigner = $_GET["Foreigner"];
			$searchAccessibility .= "AND Foreigner = {$_GET["Foreigner"]} ";
		}



		$names = array();
		$names = explode(" ", $searchItems);
		$numberNames = count($names);
		$searchString = "(";
		$searchDescription = "(";
		$searchLocalitation = "(";

		for ($i = 0; $i < $numberNames; $i++){
			$searchString .= "Name LIKE '%{$names[$i]}%'";
			$searchDescription .= "Description LIKE '%{$names[$i]}%'";
			$searchLocalitation .= "Localitation LIKE '%{$names[$i]}%'";

			if($i != $numberNames-1){
				$searchString .= " OR ";
				$searchDescription .= " OR ";
				$searchLocalitation .= " OR ";
			}else{
				$searchString .= ")";
				$searchDescription .= ")";
				$searchLocalitation .= ")";
			}
		}


		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		//$sql1="SELECT * FROM place WHERE {$searchString}/* OR {$searchDescription} OR {$searchLocalitation} */AND RedMovility = {$RedMovility} AND RedVision = {$RedVision} AND ColourBlind = {$ColourBlind} AND Deaf = {$Deaf} AND Foreigner = {$Foreigner}";
		
		//$sql2 = "SELECT * FROM route WHERE {$searchString} OR {$searchDescription}";
		if(isset($_GET["Email"])){
		   $Email = $_GET['Email'];
		   $sql2="SELECT * FROM route LEFT JOIN favoriteroutes ON route.IdRoute = favoriteroutes.IdRoute WHERE favoriteroutes.Email = '{$Email}' AND ({$searchString} OR {$searchDescription})";
			//$sql2 = "SELECT * FROM route WHERE {$searchString} OR {$searchDescription}";
		}else{
		  	$sql2 = "SELECT * FROM route WHERE {$searchString} OR {$searchDescription}";
		  }
		$result=mysqli_query($connection,$sql2);

		if($sql2){
			$jsonTuple2;
			$x = 0;
			$json['OPERATIONS'][0]="SEARCH_BY_NAME_ROUTES";
			while($reg = mysqli_fetch_array($result)){
				echo mysqli_error($connection);
				$jsonTuple['IdRoute'] = $reg['IdRoute'];
				$jsonTuple['Email'] = $reg['Email'];
				$jsonTuple['MadeBy'] = $reg['MadeBy'];
				$jsonTuple['Name'] = $reg['Name'];
				$jsonTuple['Description'] = $reg['Description'];
				$jsonTuple['Image'] = $reg['Image'];
				$jsonTuple['ImageDescription'] = $reg['ImageDescription'];

				$json['SEARCH_BY_NAME_ROUTES'][$x]=$jsonTuple;
				$x++;
			}

			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

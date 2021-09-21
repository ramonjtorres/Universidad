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
		//$sql1="SELECT * FROM place WHERE ({$searchString} OR {$searchDescription} OR {$searchLocalitation}) {$searchAccessibility}";
		if(isset($_GET["Email"])){
		   $Email = $_GET['Email'];
		   $sql1="SELECT * FROM place LEFT JOIN favoriteplaces ON place.IdPlace = favoriteplaces.IdPlace WHERE favoriteplaces.Email = '{$Email}' AND (({$searchString} OR {$searchDescription} OR {$searchLocalitation}) {$searchAccessibility})";
		  }else{
		   $sql1="SELECT * FROM place WHERE (({$searchString} OR {$searchDescription} OR {$searchLocalitation}) {$searchAccessibility})";
		  }
		$result=mysqli_query($connection,$sql1);

		if($sql1){
			echo mysqli_error($connection);
			$jsonTuple1;
			$x = 0;
			$json['OPERATIONS'][0]="SEARCH_BY_NAME_PLACES";
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple1['IdPlace'] = $reg['IdPlace'];
				$jsonTuple1['Email'] = $reg['Email'];
				$jsonTuple1['MadeBy'] = $reg['MadeBy'];
				$jsonTuple1['Name'] = $reg['Name'];
				$jsonTuple1['Description'] = $reg['Description'];
				$jsonTuple1['Localitation'] = $reg['Localitation'];
				$jsonTuple1['Image'] = $reg['Image'];
				$jsonTuple1['RedMovility'] = $reg['RedMovility'];
				$jsonTuple1['RedVision'] = $reg['RedVision'];
				$jsonTuple1['ColourBlind'] = $reg['ColourBlind'];
				$jsonTuple1['Deaf'] = $reg['Deaf'];
				$jsonTuple1['Foreigner'] = $reg['Foreigner'];

				$json['SEARCH_BY_NAME_PLACES'][$x]=$jsonTuple1;
				$x++;
			}

			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

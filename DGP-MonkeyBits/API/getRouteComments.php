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
		
		$sql = "SELECT routecomments.IdRoute, routecomments.Email, routecomments.Content, routecomments.Date, routecomments.Time, routecomments.Reported, user.Name FROM routecomments, user WHERE IdRoute = '{$IdRoute}'  AND routecomments.Reported = 0 and routecomments.Email = user.Email order by routecomments.Date desc, routecomments.Time desc";
		$result=mysqli_query($connection,$sql);

		if($sql){
			$x = 0;
			$json['OPERATIONS'][0] = "GET_ROUTE_COMMENTS";
			while($reg = mysqli_fetch_array($result)){
				$jsonTuple['IdRoute'] = $reg['IdRoute'];
				$jsonTuple['Email'] = $reg['Email'];
				$jsonTuple['Content'] = $reg['Content'];
				$jsonTuple['Date'] = $reg['Date'];
				$jsonTuple['Time'] = $reg['Time'];
				$jsonTuple['Reported'] = $reg['Reported'];

				$json['GET_ROUTE_COMMENTS'][$x]=$jsonTuple;
				$x++;
			}
			
			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

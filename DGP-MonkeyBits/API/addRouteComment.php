<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
	if(isset($_GET["IdRoute"]) && isset($_GET["Email"]) && isset($_GET["Content"])){
		$IdRoute = $_GET['IdRoute'];
		$Email =$_GET['Email'];
		$Content = $_GET['Content'];
		$Date = new DateTime("now", new DateTimeZone('Europe/Madrid'));
		$Date = $Date->format('Y-m-d');
		$Time = new DateTime("now", new DateTimeZone('Europe/Madrid'));
		$Time = $Time->format('H:i:s');
		$Reported = 0;

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		$sql = "INSERT INTO routecomments (IdRoute, Email, Content, Date, Time, Reported) VALUES ('{$IdRoute}', '{$Email}', '{$Content}', '{$Date}', '{$Time}', '{$Reported}')";
		$result=mysqli_query($connection,$sql);

		if($sql){
			echo mysqli_error($connection);
			$json['OPERATIONS'][0]="ADD_ROUTE_COMMENT";
			mysqli_close($connection);
			echo json_encode($json);
		}	
	}
?>
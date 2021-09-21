<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
	if(isset($_GET["Email"]) && isset($_GET["Name"])){
		$Email =$_GET['Email'];
		$Name = $_GET['Name'];
		$Banned = 0;
		$Reported = 0;

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		$sql = "INSERT INTO user (Email, Name, Banned, Reported) VALUES ('{$Email}', '{$Name}', '{$Banned}', '{$Reported}')";
		$result=mysqli_query($connection,$sql);

		if($sql){
			echo mysqli_error($connection);
			$json['OPERATIONS'][0]="ADD_USER";
			mysqli_close($connection);
			echo json_encode($json);
		}	
	}
?>

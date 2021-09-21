<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();
	/*if(isset($_GET["user"]) && isset($_GET["pwd"])){
		$user=$_GET['user'];
		$pwd=$_GET['pwd'];
		*/
	if(isset($_GET["IdRoute"])){
		$IdRoute=$_GET['IdRoute'];

		$conexion=mysqli_connect($hostname,$username,$password,$database);
		
		//$consulta="SELECT user, pwd, id FROM usuarios WHERE user= '{$user}' AND pwd = '{$pwd}'";
		$consulta="SELECT IdRoute, Email, MadeBy, Name, Description FROM route WHERE IdRoute= '{$IdRoute}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
		
			if($reg=mysqli_fetch_array($resultado)){
				$json['datos'][]=$reg;
			}
			mysqli_close($conexion);
			echo json_encode($json);
		}



		else{
			$results["IdRoute"]='';
			$results["Email"]='';
			$results["MadeBy"]='';
			$results["Name"]='';
			$results["Description"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
		
	}
	else{
			$results["IdRoute"]='';
			$results["Email"]='';
			$results["MadeBy"]='';
			$results["Name"]='';
			$results["Description"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
?>

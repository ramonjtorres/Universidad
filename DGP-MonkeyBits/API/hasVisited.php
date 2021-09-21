<?PHP
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
$hostname="localhost";
$database="bdr";
$username="luis";
$password="12345";
$json=array();

	if(isset($_GET["IdPlace"]) && isset($_GET["Email"])){
		$IdPlace =$_GET['IdPlace'];
		$Email = $_GET['Email'];

		$connection=mysqli_connect($hostname,$username,$password,$database);
		
		$sql = "SELECT `IdPlace`, `Email` FROM `visit` WHERE `IdPlace`= {$IdPlace} AND `Email`= '{$Email}'";
		$result=mysqli_query($connection,$sql);

        if($reg = mysqli_fetch_array($result)){
            
            $resultEmail = $reg["Email"];
            $resultIdPlace = $reg["IdPlace"];
            $json['OPERATIONS'][0]="HAS_VISITED";
            $json['HAS_VISITED']=true;
            
        }
        else{
                
                $json['OPERATIONS'][0]="HAS_VISITED";
                $json['HAS_VISITED']=false;
                
        }
        
		if($sql){
			echo mysqli_error($connection);
			mysqli_close($connection);
			echo json_encode($json);
		}
	}
?>

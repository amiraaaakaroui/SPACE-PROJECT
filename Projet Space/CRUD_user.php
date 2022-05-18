<?php
include ('config.php');
if(count($_POST)>0){
	if($_POST['type']==1){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$type=$_POST['type'];
		$sql = "INSERT INTO `crud`( `name`, `email`,`password`,`type`) 
		VALUES ('$name','$email','$password','$type')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$type=$_POST['type'];
		$sql = "UPDATE `crud` SET `email`='$email',`password`='$password',`type`='$type' WHERE name=$name";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$name=$_POST['name'];
		$sql = "DELETE FROM `crud` WHERE name=$name ";
		if (mysqli_query($conn, $sql)) {
			echo $name;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$name=$_POST['name'];
		$sql = "DELETE FROM crud WHERE name in ($name)";
		if (mysqli_query($conn, $sql)) {
			echo $name;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>
<?php
	// functions.php
	// siia tulevd funktsioonid, k�ik mis seotud AB'ga
	
	// Loon AB'i �henduse
	require_once("../configGlobal.php");
	$database = "if15_toomloo_3";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	// v�tab kasutaja andmed ja sisestab AB'i
	function createUser(){
		
		//Salvestame AB'i
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		//echo $mysqli->error;
		//echo $stmt->error;
		// asendame ? m�rgid, ss - s on string email, s on string password
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
	}
	
	// vaatab kas selline kasutaja on AB'is olemas
	function loginUser(){
		
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
				
		//muutujad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
				
		//Kontrollin kas tulemusi leiti
		if($stmt->fetch()){
			// ab'i oli midagi
			echo "Email ja parool �iged, kasutaja id=".$id_from_db;
		}else{
			// ei leidnud
			echo "Wrong credentials!";
		}
				
		$stmt->close();
		
	}

	// Paneme �henduse kinni
	$mysqli->close();
?>
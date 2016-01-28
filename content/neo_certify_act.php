<?php

// List of validation errors
$errors = "";

function validateFormFields()
{
	global $errors; // Make global variable available
	$passedValidation = true;

	// First Name
	if (empty($_POST["firstName"])){
		$errors .= "*First Name is required<br />";
		$passedValidation = false;
	}
	else if(!preg_match("/^[a-zA-z ]*$/", $_POST["firstName"])){
		$errors .= "*First Name must contain only letters and spaces<br />";
		$passedValidation = false;
	}

	// Last Name
	if (empty($_POST["lastName"])){
		$errors .= "*Last Name is required<br />";
		$passedValidation = false;
	}
	else if(!preg_match("/^[a-zA-z ]*$/", $_POST["lastName"])){
		$errors .= "*Last Name must contain only letters and spaces<br />";
		$passedValidation = false;
	}

	// Email
	if (empty($_POST["email"])){
		$errors .= "*Email is required<br />";
		$passedValidation = false;
	}
	else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		$errors .= "*Invalid email format<br />";
	}

	// Employee ID
	if (empty($_POST["dept"])){
		$errors .= "*Department is required<br />";
		$passedValidation = false;
	}

	return $passedValidation;
}

/** If this page was POSTed to **/
if ($_SERVER["REQUEST_METHOD"] == "POST"){

	// Validation
	if (validateFormFields()){

		include "../../shared/query_UDFs.php";
		include "../../shared/dbInfo.php";

		// Connect to DB
		$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
		if ($conn->connect_errno){
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		}

		$sql_insert_empInfo = "
			INSERT INTO neo_certification (FName, LName, Email, DeptID, DateCertified)
			VALUES (" .
				"'" . mysqli_real_escape_string($conn, $_POST['firstName']) . "'," .
				"'" . mysqli_real_escape_string($conn, $_POST['lastName']) . "'," .
				"'" . mysqli_real_escape_string($conn, $_POST['email']) . "'," .
				$_POST['dept'] . "," .
				"'" . date("Y-m-d H:i:s") . "'" .
				")";

		// Insert employee info
		$qry_result = $conn->query($sql_insert_empInfo);

		// If query failed, display failure message, else display success message
		if (!$qry_result){
			echo "Query Failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			echo '<span style="font-weight:bold; font-size:1.1em; color:#00824A;">Submission Confirmed!</span>';
		}

		// Disconnect from DB
		mysqli_close($conn);

		// Disable the form fields
		echo "<script>";
			echo "$('#certifyForm input').prop('disabled', true);";
			echo "$('#certifyForm select').prop('disabled', true);";
		echo "</script>";
	}
	else{
		// Validation did not pass, so output error messages
		echo '<span style="color:red;">' . $errors . '</span>';
	}
}
else{
	// Redirect to ODT Homepage
	echo '<script>window.location="http://www.famu.edu/?odtraining";</script>';
}

?>
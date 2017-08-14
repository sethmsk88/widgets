<html>
	<head>
		<style type="text/css">
		.panel-group > .panel-famuOrangeLight{
			background-color:#FFBA3D;
		}

		.panel-group > .panel-famuOrangeLight .panel-body{
			background-color:#FFE9A1;
		}

		.panel-group > .panel-famuOrangeLight .panel-body a{
			color:#333;
		}

		.content{
			width:300px;
		}

		.noScroll_body p{
			font-size:1.1em;
		}

		.js_link{
			color:#FF6309;
			border-bottom:1px dotted #FF6309;
			cursor:pointer;
		}
		.js_link:hover{
			color:#FFBA3D;
			border-bottom:1px solid #FFBA3D;
		}

		.form-group > input{
			margin-bottom:10px;
		}
		</style>

		<!-- Bootstrap -->
		<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		    <!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			/*** Get Departments ***/
			// Include my database info
	        include "../../shared/dbInfo.php";
			$allActives_table = "all_active_fac_staff";

			// Select all distinct DeptIDs
			$sql = "
				SELECT DISTINCT DeptID, WorkingDept
				FROM $allActives_table
				ORDER BY WorkingDept ASC
			";

			// Connect to DB
			$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
			if ($conn->connect_errno){
				echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
			}

			// Run Query
			$all_depts = $conn->query($sql);

			// Disconnect from DB
			mysqli_close($conn);
		?>

		<p>
			To certify your completion of the New Employee Orientation, please fill out the form below and click "Submit".
		</p>

		<form
			id="certifyForm"
			name="certifyForm"
			method="post"
			role="form"
			action="./neo_certify_act.php"
			>

			<div class="form-group">
				<input
					type="text"
					name="firstName"
					id="firstName"
					class="form-control"
					placeholder="First Name"
					maxlength="64"
					>
					
				<input
					type="text"
					name="lastName"
					id="lastName"
					class="form-control"
					placeholder="Last Name"
					maxlength="64"
					>
			
				<input
					type="text"
					name="email"
					id="email"
					class="form-control"
					placeholder="Email"
					maxlength="128"
					>

				<select
					name="dept"
					id="dept"
					class="form-control"
					style="padding-left:8px;"
					>
					<option
						value=""
						selected="selected"
						disabled="disabled"
						style="color:#999999 !important;"
						>
						Department
					</option>
					
					<?php
					// Create options for each department
					while ($row = $all_depts->fetch_assoc()){
						echo '<option ' . 'value="' . $row['DeptID'] . '">';
							echo $row['WorkingDept'];
						echo '</option>';
					}
					?>
				</select>
				<br />

				<p>
					I verify by this submission I have viewed all the New Employee Orientation modules, and their requirements including: Benefits &amp; Retirement, iRattler, Time &amp; Labor, Equal Opportunity Programs, Anti-Hazing, and Environmental Health &amp; Safety.
				</p>

				<input
					type="submit"
					name="submitCertify"
					id="submitCertify"
					class="btn btn-md btn-default"
					value="Submit"
					>

				<div id="confirmation">
					<!-- To be filled by AJAX response -->
				</div>
			</div>
		</form>
	</body>
</html>

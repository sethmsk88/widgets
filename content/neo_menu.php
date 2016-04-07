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

	#page1{
		display:block;
	}
	#page2{
		display:none;
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

	<script>
	$(document).ready(function(){
		// Handler for "click here" link
		$('#clickHere').click(function(){
			// Hide page1
			$('#page1').hide();

			// Show page2
			$('#page2').show();

			// Scroll to top of page
			// This doesn't work b/c it only scrolls within the iFrame
			//$("html, body").animate({ scrollTop:0}, "slow");
		});

		// Handle form submissions
		$('form').on('submit', function(e){
			e.preventDefault();

			$.ajax({
				type: 'post',
				url: 'neo_certify_act.php',
				data: $('form').serialize(),
				success: function(response){
					$('#confirmation').html(response);
				}
			});
		});
	});
	</script>
</head>

<!-- Part of settings to remove iFrame border -->
<body class="noScroll_body" scroll="no" style="overflow:none;">

	<div id="page1">
		<!-- Intro Paragraph -->
		<p>
			Welcome to Florida A&amp;M University!
		</p>
			
		<p>
			Our New Employee Orientation program provides important information, such as obtaining benefits, how to gain access to iRattler, Time &amp; Labor, Equal Opportunity Programs, Anti-Hazing, Environmental Health &amp; Safety, and more valuable tools.
		</p>

		<p>
			Using the menu below, please watch all presentations.
		</p>

		<p>
			To get started with the New Employee Orientation, please click the Introduction.
		</p>
		
		<!-- div.content constrains the width of the orange -->
		<div class="content">

			<!-- NEO Menu -->
			<div id="neo_menu" class="panel-group">
			<?php
				$menuChoices = [
					"Introduction" => "NEO_Intro",
					"Benefits &amp; Retirement" => "NEO_Benefits",
					"iRattler" => "NEO_iRattler",
					"Time &amp; Labor" => "NEO_TimeLabor",
					"Equal Opportunity Programs" => "NEO_EOP",
					"Anti-Hazing" => "NEO_Anti-Hazing",
					"Environmental Health &amp; Safety" => "NEO_EHS"];
				
				$neoPath = "http://168.223.1.35/bootstrap/apps/neo/?page=homepage";

				// For each choice in menuChoices array, create panel
				foreach ($menuChoices as $choice => $presentationName){
					echo '<div class="panel panel-famuOrangeLight">';
						echo '<div class="panel-heading">';
							echo '<h4 class="panel-title">';
								echo '<a href="' . $neoPath . '&pres=' . $presentationName . '" target="_parent">' . $choice . '</a>';
							echo '</h4>';
						echo '</div>';
					echo '</div>';
				}
			?>
				<div class="panel panel-famuOrangeLight">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a 
								data-toggle="collapse"
								data-parent="#neo_menu"
								href="#collapse_1"
								>
								Other
							</a>
						</h4>
					</div>
					<div id="collapse_1"class="panel-collapse collapse">
						<div class="panel-body">
							<p>
								<a href="<?= $neoPath ?>&pres=NEO_ASAP" target="_blank">ASAP</a><br />
								<a href="<?= $neoPath ?>&pres=NEO_BAS" target="_blank">Business &amp; Auxiliary Services</a><br />
								<a href="http://offender.fdle.state.fl.us/offender/homepage.do;jsessionid=K7wTJ91R6oI3DBpQILwivO+O" target="_blank">FDLE Sexual Offender Registry</a><br />
								<a href="<?= $neoPath ?>&pres=NEO_Libraries" target="_blank">University Libraries</a><br />
								<a href="<?= $neoPath ?>&pres=NEO_Parking" target="_blank">University Parking Services</a><br />
							</p>
						</div>
					</div>
				</div>
			</div> <!-- End NEO Menu -->
		</div> <!-- End content -->
		<p>
			Once you have watched all presentations, please <span class="js_link" id="clickHere">click here</span> to certify your completion of the New Employee Orientation.
		</p>

	</div> <!-- End Page 1 -->

	<div id="page2">

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
			action=""
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
	</div>

</body>
</html>
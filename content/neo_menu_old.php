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
	</style>

	<!-- Bootstrap -->
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/bootstrap/js/bootstrap.min.js"></script>
</head>

<!-- Part of settings to remove iFrame border -->
<body scroll="no" style="overflow:none;">

	<div id="page1">
		<!-- Intro Paragraph -->
		<div style="font-size:1.1em;">
			<p>
				Welcome to Florida A&amp;M University!
			</p>
				
			<p>
				Our New Employee Orientation program provides important information, such as obtaining benefits, how to gain access to iRattler, Time &amp; Labor, Equal Opportunity Programs, Anti-Hazing, Environmental Health &amp; Safety, and more valuable tools.
			</p>

			<p>
				Using the menu below, please watch all presenations.
			</p>

			<p>
				To get started with the New Employee Orientation, please click the Introduction.
			</p>
		</div>
		
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
				
				$neoPath = "http://10.123.100.18/bootstrap/apps/neo/?page=homepage";

				// For each choice in menuChoices array, create panel
				foreach ($menuChoices as $choice => $presentationName){
					echo '<div class="panel panel-famuOrangeLight">';
						echo '<div class="panel-heading">';
							echo '<h4 class="panel-title">';
								echo '<a href="' . $neoPath . '&pres=' . $presentationName . '" target="_blank">' . $choice . '</a>';
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
								<?php
								echo '<a href="' . $neoPath . '&pres=NEO_ASAP" target="_blank">ASAP</a><br />';
								echo '<a href="' . $neoPath . '&pres=NEO_BAS" target="_blank">Business &amp; Auxiliary Services</a><br />';
								echo '<a href="' . $neoPath . '&pres=NEO_Libraries" target="_blank">University Libraries</a><br />';
								echo '<a href="' . $neoPath . '&pres=NEO_Parking" target="_blank">University Parking Services</a><br />';
								?>
							</p>
						</div>
					</div>
				</div>
			</div> <!-- End NEO Menu -->
		</div> <!-- End content -->
	</div> <!-- End Page 1 -->
</body>
</html>
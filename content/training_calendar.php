<!-- Use this to include this content on ODT website -->
<!--
<iframe
	src="http://168.223.1.35/bootstrap/apps/widgets/training_calendar.php"
	style="border:0; width:540px; height:1000px; overflow:none;">
	iFrames not supported by your browser
</iframe>
-->

<html>
<head>
	<link href="../css/training_calendar.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		function details_action(id, action)
		{
			if (action == "more"){
				$('#moreDetails_' + id).hide();
				$('#description_' + id).slideDown();
			}
			else if (action == "less"){
				$('#description_' + id).slideUp(function(){
					$('#moreDetails_' + id).show();
				});
			}
		}
	</script>
</head>

<body scroll="no" style="overflow:none;">
	<?php
		// Include my database info
	    include "../../shared/dbInfo.php";

	    $eventTable = "tc_event";

	    // Open DB connection
	    $conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	    if ($conn->connect_errno){
	        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	    }
		
		// Select all active events between now and 1 year in the future
		// NOTE: Not limiting to 7 until the full calendar is built
	    $sql = "
	        SELECT *
	        FROM $eventTable
	        WHERE Active = 1 AND
	        	EventDate BETWEEN '" . date("Y-m-d") . "' AND '" . date('Y-m-d',  strtotime('+365 days')) . "'" . "
	        ORDER BY EventDate ASC
	        /*LIMIT 7*/"
	        ;

	    // Run Query
	    $qry_events = $conn->query($sql);

	    // Output query results
	    if (!$qry_events){
	        echo "Query failed: (" . $conn->errno . ") " . $conn->error;
	    }

		// Close DB connection
	    mysqli_close($conn);
	?>

	<div class="agenda">

		<?php

			// For each event in the query result
			while ($row = $qry_events->fetch_assoc()){

				echo '<div class="event">';
					echo '<div class="dateBox">';
						echo '<div class="dayOfWeek">' . date('D', strtotime($row['EventDate'])) . '</div>';
						echo '<div class="date">';
							echo '<span class="day">' . date('d', strtotime($row['EventDate'])) . '</span><br />';
							echo '<span class="month">' . date('M', strtotime($row['EventDate'])) . '</span>';
							echo '<span class="year"> ' . date('Y', strtotime($row['EventDate'])) . '</span>';
						echo '</div>';
					echo '</div>';
					echo '<div class="descriptionBox">';
						echo '<span class="name">';
							echo $row['Name'];
						echo '</span><br />';
						echo '<span class="time">';
							echo '<span class="sectionTitle">Time: </span>';
							echo date('g:ia', strtotime($row['TimeBegin'])) . ' - ' . date('g:ia', strtotime($row['TimeEnd']));
						echo '</span><br />';
						echo '<span class="location">';
							echo '<span class="sectionTitle">Location: </span>';
							echo $row['Location'];
						echo '</span><br />';
						echo '<span class="instructorName">';
							echo '<span class="sectionTitle">Instructor: </span>';
							echo $row['Instructor'];
						echo '</span>';
						echo '<span class="instructorTitle">';
							if (strlen($row['InstructorTitle']) > 0){
								echo ', ' . $row['InstructorTitle'];
							}
						echo '</span><br />';

						// If a event has a description, display more details link
						if (strlen($row['Description']) > 0){
							echo '<span ' .
									'id="moreDetails_' . $row['EventID'] . '"' .
									'class="detailsLink"' .
									'onclick="details_action(' . $row['EventID'] . ', \'more\');"' .
									'>';
								echo 'More details &gt;&gt;';
							echo '</span>';
							echo '<span id="description_' . $row['EventID'] . '" class="description">';
								echo '<span class="sectionTitle">Description:</span><br />';
								echo $row['Description'];
								echo '<br />';
								echo '<span ' .
										'id="lessDetails_' . $row['EventID'] . '"' .
										'class="detailsLink"' .
										'onclick="details_action(' . $row['EventID'] . ', \'less\');"' .
										'>';
									echo '<br />&lt;&lt; Less Details';
								echo '</span>';
							echo '</span>';
						}

					echo '</div>';
				echo '</div>';
			}
		?>
	</div>
</body>

</html>
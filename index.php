<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle="Widgets"; ?></title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Linked stylesheets -->
    <link href="../../css/master.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Included UDFs -->
    <?php include "../shared/query_UDFs.php"; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <?php

        // Include my database info
        include "../shared/dbInfo.php";

        /***********************************/
        /* Dump table and table info       */
        // Connect to DB
        /*
        $conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
        if ($conn->connect_errno){
            echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
        }

        $eventTable = "tc_event";

        $sql = "
            SELECT *
            FROM $eventTable
            ";

        // Run Query
        $res = $conn->query($sql);

        // Output query results
        if (!$res){
            echo "Query failed: (" . $conn->errno . ") " . $conn->error;
        }
        else{
            dumpQuery($res);
            queryInfo($res);
        }
        // Close DB connection
        mysqli_close($conn);

        */
        /************************************/

        // Set application homepage
        $homepage = "homepage";
        $loadWidget = false;

    	// If a page variable exists, include the page
    	if (isset($_GET["page"])){
    		$filePath = './content/' . $_GET["page"] . '.php';
            $loadWidget = true;
    	}
    	else{
    		$filePath = './content/' . $homepage . '.php';
    	}

    	if (file_exists($filePath)){
            if ($loadWidget){
    ?>
                <iframe
                    src="/bootstrap/apps/widgets/content/<?= $_GET["page"] ?>.php"
                    style="border:1px inset black; width:540px; height:1000px; margin:10px;">
                    iFrames not supported by your browser
                </iframe>;
    <?php
            }
            else{
                include $filePath;
            }
		}
		else{
			echo '<h2>404 Error</h2>Page does not exist';
		}

    ?>




  </body>
</html>

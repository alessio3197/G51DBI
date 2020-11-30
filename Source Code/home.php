<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
        <title>Home</title>
	</head> 
	<body>
		<h1>Home</h1>
        <ul class="toolbar">
            <li class="toolbar"><a href="home.php">Home</a></li>
            <li class="toolbar"><a href="artists.php">Artists</a></li>
            <li class="toolbar"><a href="albums.php">Albums</a></li>
            <li class="toolbar"><a href="tracks.php">Tracks</a></li>
        </ul>
		<h2>Database Metrics</h2>
        <?php 
        require_once('db.php');
        $query1 = "SELECT count(artID) FROM artist";
        $query2 = "SELECT count(cdID) FROM cd";
        $query3 = "SELECT count(trackID) FROM track";
        $results1 = $conn->query($query1) or trigger_error($conn->error);
        $results2 = $conn->query($query2) or trigger_error($conn->error);
        $results3 = $conn->query($query3) or trigger_error($conn->error);
        $result1 = mysqli_fetch_assoc($results1);
        $result2 = mysqli_fetch_assoc($results2);
        $result3 = mysqli_fetch_assoc($results3);
        echo '<ul><li>Number of Artists: '.$result1['count(artID)'].'</li><li>Number of CDs: '.
        $result2['count(cdID)'].'</li><li>Number of Tracks: '.$result3['count(trackID)'].'</li></ul>';
        ?>
        <?php include_once('footer.php'); ?>
	</body>
</html>
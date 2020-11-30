<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
        <title>Tracks</title>
	</head> 
	<body>
		<h1>Tracks</h1>
        <ul class="toolbar">
            <li class="toolbar"><a href="home.php">Home</a></li>
            <li class="toolbar"><a href="artists.php">Artists</a></li>
            <li class="toolbar"><a href="albums.php">Albums</a></li>
            <li class="toolbar"><a href="tracks.php">Tracks</a></li>
        </ul>
        <br>
        <?php
        if(isset($_POST['typeAdd'])){
            require_once('db.php');
            $trackTitle = $_POST['trackTitle'];
            $cdTitle = $_POST['cdTitle'];
            $duration = $_POST['duration'];
            $query1 = "SELECT cdID FROM cd WHERE (cdTitle='$cdTitle')";
            $results1 = $conn->query($query1) or trigger_error($conn->error);
            $result1 = mysqli_fetch_assoc($results1);
            $cdID = $result1['cdID'];
            if($_POST['typeAdd']=='Save'){
                $queryFinal = "INSERT INTO track (cdID,trackTitle,duration) VALUES 
                ($cdID,'$trackTitle',$duration)";
            }elseif($_POST['typeAdd']=='Delete'){
                $queryFinal = "DELETE FROM track WHERE trackTitle=('$trackTitle') AND cdID=($cdID)";
            }
            $results = $conn->query($queryFinal) or trigger_error($conn->error);
        }elseif(isset($_POST['typeEdit'])){
            require_once('db.php');
            $trackTitle = $_POST['trackTitle'];
            $cdTitle = $_POST['cdTitle'];
            $duration = $_POST['duration'];
            $query1 = "SELECT cdID FROM cd WHERE (cdTitle='$cdTitle')";
            $results1 = $conn->query($query1) or trigger_error($conn->error);
            $result1 = mysqli_fetch_assoc($results1);
            $cdID = $result1['cdID'];
            if($_POST['typeEdit']=='Save'){
                $queryFinal = "UPDATE track SET cdID=$cdID, trackTitle='$trackTitle', duration=$duration";
            }elseif($_POST['typeEdit']=='Delete'){
                $queryFinal = "DELETE FROM track WHERE trackTitle=('$trackTitle') AND cdID=($cdID)";
            }
            $results = $conn->query($queryFinal) or trigger_error($conn->error);
        }
        ?>
		<form action="" method="post" id="searchArtists">
            <ul class="form-style-1">
                <li><input type="text" name="search" placeholder="Search" class="field"></li>
            </ul>
        </form>
		<table>
			<thead>
				<tr>
					<th>Track ID</th>
					<th>Artist</th>
					<th>CD</th>
					<th>Title</th>
					<th>Duration</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
                <?php
                require_once('db.php');
                if(isset($_POST['search'])){
                        $x = '%'.$_POST['search'].'%';
                        $query = "SELECT trackID,artName,cdTitle,trackTitle,duration 
                        FROM cd,artist,track WHERE artist.artID=cd.artID 
                        AND track.cdID=cd.cdID AND trackTitle LIKE '$x' ORDER BY trackID ASC";
                    }elseif(isset($_GET['id'])){
                        $x = $_GET['id'];
                        $query = "SELECT trackID,artName,cdTitle,trackTitle,duration 
                        FROM cd,artist,track WHERE artist.artID=cd.artID 
                        AND track.cdID=cd.cdID AND  track.cdID=$x ORDER BY trackID ASC";
                    }else{
                        $query = "SELECT trackID,artName,cdTitle,trackTitle,duration 
                        FROM cd,artist,track WHERE artist.artID=cd.artID 
                        AND track.cdID=cd.cdID ORDER BY trackID ASC";
                    }
                $results = $conn->query($query) or trigger_error($conn->error);
                for($i=0;$i<$results->num_rows;$i++){
                    $result = mysqli_fetch_assoc($results);
                    echo '<tr><td>'.$result['trackID'].'</td><td>'.$result['artName'].'</td><td>'.
                    $result['cdTitle'].'</td><td>'.$result['trackTitle'].'</td><td>'.
                    $result['duration'].'</td><td><a href="editTrack.php?id='.$result['trackID'].'&title='.
                    $result['trackTitle'].'&album='.$result['cdTitle'].'&duration='.$result['duration'].'">
                    Edit</a></td></tr>';
                }
                ?>
			</tbody>
		</table>
		<a href="editTrack.php">Add Track</a>
        <?php include_once('footer.php'); ?>
	</body>
</html>
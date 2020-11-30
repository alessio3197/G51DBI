<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
        <title>Artists</title>
	</head> 
	<body>
		<h1>Artists</h1>
        <ul class="toolbar">
            <li class="toolbar"><a href="home.php">Home</a></li>
            <li class="toolbar"><a href="artists.php">Artists</a></li>
            <li class="toolbar"><a href="albums.php">Albums</a></li>
            <li class="toolbar"><a href="tracks.php">Tracks</a></li>
        </ul>
        <br>
        <?php
        if(isset($_POST['typeAdd']) or isset($_POST['typeEdit'])){
            require_once('db.php');
            $name = $_POST['name'];
            if(isset($_POST['typeAdd'])){
                if($_POST['typeAdd']=='Save'){
                    $queryFinal = "INSERT INTO artist (artName) VALUES ('$name')";
                }elseif($_POST['typeAdd']=='Delete'){
                    $query1 = "SELECT artID FROM artist WHERE artName=('$name')";
                    $results1 = $conn->query($query1) or trigger_error($conn->error);
                    $result1 = mysqli_fetch_assoc($results1);
                    $artID = $result1['artID'];
                    $query2 = "SELECT cdID FROM cd WHERE artID=('$artID')";
                    $results2 = $conn->query($query2) or trigger_error($conn->error);
                    for($i=0;$i<$results2->num_rows;$i++){
                        $result2 = mysqli_fetch_assoc($results2);
                        $cdID = $result2['cdID'];
                        $queryTrackDelete = "DELETE FROM tracks WHERE cdID=$cdID";
                        $resultsTrackDelete = $conn->query($queryTrackDelete) or trigger_error($conn->error);
                    }
                    $queryCDDelete = "DELETE FROM cd WHERE artID=$artID";
                    $queryFinal = "DELETE FROM artist WHERE artID=$artID";
                }
                $results = $conn->query($queryFinal) or trigger_error($conn->error);
            }else if(isset($_POST['typeEdit'])){
                if($_POST['typeEdit']=='Save'){
                    //$queryFinal = "INSERT INTO artist (artName) VALUES ('$name')";
                    $update = $_POST['extra'];
                    $name = $_POST['name'];
                    $queryFinal = "UPDATE artist SET artName='$name' WHERE artName='$update'";
                }elseif($_POST['typeEdit']=='Delete'){
                    $query1 = "SELECT artID FROM artist WHERE artName=('$name')";
                    $results1 = $conn->query($query1) or trigger_error($conn->error);
                    $result1 = mysqli_fetch_assoc($results1);
                    $artID = $result1['artID'];
                    $query2 = "SELECT cdID FROM cd WHERE artID=('$artID')";
                    $results2 = $conn->query($query2) or trigger_error($conn->error);
                    for($i=0;$i<$results2->num_rows;$i++){
                        $result2 = mysqli_fetch_assoc($results2);
                        $cdID = $result2['cdID'];
                        $queryTrackDelete = "DELETE FROM tracks WHERE cdID=$cdID";
                        $resultsTrackDelete = $conn->query($queryTrackDelete) or trigger_error($conn->error);
                    }
                    $queryCDDelete = "DELETE FROM cd WHERE artID=$artID";
                    $queryFinal = "DELETE FROM artist WHERE artID=$artID";
                }
                $results = $conn->query($queryFinal) or trigger_error($conn->error);
            }
            
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
                        <th>Artist ID</th>
                        <th>Artist Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('db.php');
                    if(isset($_POST['search'])){
                        $x = '%'.$_POST['search'].'%';
                        $query = "SELECT * FROM artist WHERE artName LIKE '$x' ORDER BY artID ASC";
                    }else{
                        $query = "SELECT * FROM artist ORDER BY artID ASC";
                    }
                    $results = $conn->query($query) or trigger_error($conn->error);
                    for($i=0;$i<$results->num_rows;$i++){
                        $result = mysqli_fetch_assoc($results);
                        echo '<tr><td>'.$result['artID'].'</td><td>'.$result['artName'].'</td><td>'.
                        '<a href="editArtist.php?id='.$result['artName'].'">Edit</a> <a href="albums.php?id='.$result['artID'].'">Albums</a></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
            <a href="editArtist.php">Add Artist</a>
            <?php include_once('footer.php'); ?>
	</body>
</html>
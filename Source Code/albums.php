<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
        <title>Albums</title>
	</head> 
	<body>
		<h1>Albums</h1>
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
            $cdTitle = $_POST['title'];
            if($_POST['typeAdd']=='Save'){
                $artName = $_POST['artist'];
                $price = $_POST['price'];
                $genre = $_POST['genre'];
                $tracks = $_POST['tracks'];
                $query1 = "SELECT artID FROM artist WHERE (artName='$artName')";
                $results1 = $conn->query($query1) or trigger_error($conn->error);
                $result1 = mysqli_fetch_assoc($results1);
                $artID = $result1['artID'];
                $queryFinal = "INSERT INTO cd (artID,cdTitle,cdPrice,cdGenre,cdNumTracks) VALUES 
                ($artID,'$cdTitle',$price,'$genre',$tracks)";
            }elseif($_POST['typeAdd']=='Delete'){
                $query1 = "SELECT cdID FROM cd WHERE (cdTitle='$cdTitle')";
                $results1 = $conn->query($query1) or trigger_error($conn->error);
                $result1 = mysqli_fetch_assoc($results1);
                $cdID = $result1['cdID'];
                $trackDelete = "DELETE FROM track WHERE cdID=$cdID";
                $queryFinal = "DELETE FROM cd WHERE cdID=$cdID";
                $results2 = $conn->query($trackDelete) or trigger_error($conn->error);
            }
            $results = $conn->query($queryFinal) or trigger_error($conn->error);
        }elseif(isset($_POST['typeEdit'])){
            require_once('db.php');
            $cdTitle = $_POST['title'];
            if($_POST['typeEdit']=='Save'){
                $artName = $_POST['artist'];
                $cdID = $_POST['extra'];
                $price = $_POST['price'];
                $genre = $_POST['genre'];
                $tracks = $_POST['tracks'];
                $query1 = "SELECT artID FROM artist WHERE (artName='$artName')";
                $results1 = $conn->query($query1) or trigger_error($conn->error);
                $result1 = mysqli_fetch_assoc($results1);
                $artID = $result1['artID'];
                $queryFinal = "UPDATE cd SET cdTitle='$cdTitle', cdPrice=$price, cdGenre='$genre', cdNumTracks=$tracks WHERE cdID=$cdID";
            }elseif($_POST['typeEdit']=='Delete'){
                $query1 = "SELECT cdID FROM cd WHERE (cdTitle='$cdTitle')";
                $results1 = $conn->query($query1) or trigger_error($conn->error);
                $result1 = mysqli_fetch_assoc($results1);
                $cdID = $result1['cdID'];
                $trackDelete = "DELETE FROM track WHERE cdID=$cdID";
                $queryFinal = "DELETE FROM cd WHERE cdID=$cdID";
                $results2 = $conn->query($trackDelete) or trigger_error($conn->error);
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
					<th>CD ID</th>
					<th>Artist</th>
					<th>Title</th>
					<th>Genre</th>
					<th>Price</th>
					<th>Tracks</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
                <?php
                require_once('db.php');
                if(isset($_POST['search'])){
                    $x = '%'.$_POST['search'].'%';
                    $query = "SELECT cdID,artName,cdTitle,cdPrice,cdGenre,cdNumTracks 
                    FROM cd,artist WHERE artist.artID=cd.artID ORDER BY cdID ASC";
                }elseif(isset($_GET['id'])){
                    $x = $_GET['id'];
                    $query = "SELECT cdID,artName,cdTitle,cdPrice,cdGenre,cdNumTracks 
                    FROM cd,artist WHERE artist.artID=cd.artID 
                    AND cd.artID=$x ORDER BY cdID ASC";
                }else{
                    $query = "SELECT cdID,artName,cdTitle,cdPrice,cdGenre,cdNumTracks 
                    FROM cd,artist WHERE artist.artID=cd.artID ORDER BY cdID ASC";
                }
                $results = $conn->query($query) or trigger_error($conn->error);
                for($i=0;$i<$results->num_rows;$i++){
                    $result = mysqli_fetch_assoc($results);
                    echo '<tr><td>'.$result['cdID'].'</td><td>'.$result['artName'].'</td><td>'.
                    $result['cdTitle'].'</td><td>'.$result['cdGenre'].'</td><td>'.$result['cdPrice'].
                    '</td><td>'.$result['cdNumTracks'].'</td><td><a href="editCD.php?id='.$result['cdID'].
                    '&title='.$result['cdTitle'].'&artist='.$result['artName'].'&price='.$result['cdPrice'].
                    '&genre='.$result['cdGenre'].'&tracks='.$result['cdNumTracks'].
                    '">Edit</a>  <a href="tracks.php?id='.$result['cdID'].'">Tracks</a></td></tr>';
                }
                ?>
			</tbody>
		</table>
		<a href="editCD.php">Add CD</a>
        <?php include_once('footer.php'); ?>
	</body>
</html>
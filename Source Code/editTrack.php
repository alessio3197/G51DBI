<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<title>Edit Track</title>
	</head> 
	<body>
		<h1>Edit Track</h1>
        <ul class="toolbar">
            <li class="toolbar"><a href="home.php">Home</a></li>
            <li class="toolbar"><a href="artists.php">Artists</a></li>
            <li class="toolbar"><a href="albums.php">Albums</a></li>
            <li class="toolbar"><a href="tracks.php">Tracks</a></li>
        </ul>
		<br>
		<form action="tracks.php" method="post" id="editCD">
            <ul class="form-style-1">
			<?php
			if(isset($_GET['id'])){
                echo '<li><label>Title <span class="required">*</span></label>';
                echo '<input type="text" name="trackTitle" class="field" value="'.$_GET['title'].'" onblur="return empty(this)" oninput="return empty(this)">';
				echo '</li><li>';
                echo '<label>Album <span class="required">*</span></label>';
                echo '<select name="cdTitle" class="field">';
                        include_once('db.php');
                        $query = "SELECT cdTitle FROM cd";
                        $results = $conn->query($query) or trigger_error($conn->error);
                        for($i=0;$i<$results->num_rows;$i++){
                            $result = mysqli_fetch_assoc($results);
							if($result['cdTitle']==$_GET['album']){
								echo '<option selected name="cdTitle">'.$result['cdTitle'].'</option>';
							}else{
                            	echo '<option name="cdTitle">'.$result['cdTitle'].'</option>';
							}
                        }
                echo '</select></li><li><label>Duration</label>';
                echo '<input type="number" name="duration" class="field" value='.$_GET['duration'].' onblur="return empty(this)" oninput="return empty(this)">';
                echo '</li><li>';
				echo '<input type="submit" name="typeEdit" value="Save">';
				echo '</li><li>';
				echo '<input type="submit" name="typeEdit" value="Delete">';
				echo '</li><input type="hidden" name="extra" value="'.$_GET['id'].'">';
			}else{
				echo '<li><label>Title <span class="required">*</span></label>';
                echo '<input type="text" name="trackTitle" class="field" onblur="return empty(this)" oninput="return empty(this)">';
				echo '</li><li>';
                echo '<label>Album <span class="required">*</span></label>';
                echo '<select name="cdTitle" class="field">';
                        include_once('db.php');
                        $query = "SELECT cdTitle FROM cd";
                        $results = $conn->query($query) or trigger_error($conn->error);
                        for($i=0;$i<$results->num_rows;$i++){
                            $result = mysqli_fetch_assoc($results);
                            echo '<option name="cdTitle">'.$result['cdTitle'].'</option>';
                        }
                echo '</select></li><li><label>Duration <span class="required">*</span></label>';
                echo '<input type="number" name="duration" class="field" value=0 onblur="return empty(this)" oninput="return empty(this)"> seconds';
                echo '</li><li>';
				echo '<input type="submit" name="typeAdd" value="Save">';
				echo '</li><li>';
				echo '<input type="submit" name="typeAdd" value="Delete">';
			}
            ?>
            </ul>
            <br><a href="tracks.php"><-- Return to Tracks</a>
			<script type="text/javascript">
                function validate(form){
                    if(form.trackTitle.value==""){
                        return false;
                    }else if(form.duration.value==""){
                        return false;
                    }else{
                        return true;
                    }
                }
                function empty(form){
                    if(form.value==""){
                        form.style.borderColor = "red";
                        form.style.borderWidth = "2px";
                    }else{
                        form.style.borderColor = '#BEBEBE';
                        form.style.borderWidth = "2px";
                    }
                }
            </script>
		</form>
		<?php include_once('footer.php'); ?>
	</body>
</html>
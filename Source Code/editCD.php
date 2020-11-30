<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
        <title>Edit CD</title>
</style>
	</head> 
	<body>
		<h1>Edit CD</h1>
        <ul class="toolbar">
            <li class="toolbar"><a href="home.php">Home</a></li>
            <li class="toolbar"><a href="artists.php">Artists</a></li>
            <li class="toolbar"><a href="albums.php">Albums</a></li>
            <li class="toolbar"><a href="tracks.php">Tracks</a></li>
        </ul>
		<br>
        <form action="albums.php" method="post" id="editCD" onSubmit="return validate(this)">
            <ul class="form-style-1">
            <?php
            if(isset($_GET['id'])){
                echo '<li><label>Title <span class="required">*</span></label>';
                echo '<input type="text" name="title" class="field" value="'.$_GET['title'].' onblur="return empty(this)" oninput="return empty(this)"">';
                echo '</li><li>';
                echo '<label>Artist <span class="required">*</span></label>';
                echo '<select name="artist" class="field">';
                        include_once('db.php');
                        $query = "SELECT artName FROM artist";
                        $results = $conn->query($query) or trigger_error($conn->error);
                        for($i=0;$i<$results->num_rows;$i++){
                            $result = mysqli_fetch_assoc($results);
                            if($result['artName']==$_GET['artist']){
								echo '<option selected name="artName">'.$result['artName'].'</option>';
							}else{
                            	echo '<option name="artName">'.$result['artName'].'</option>';
							}
                        }
                echo '</select>';
                echo '</li><li><label>Price <span class="required">*</span></label>';
                echo '<input type="text" name="price" class="field" value="'.$_GET['price'].' onblur="return empty(this)" oninput="return empty(this)"">';
                echo '</li><li><label>Genre <span class="required">*</span></label>';
                echo '<input type="text" name="genre" class="field" value="'.$_GET['genre'].' onblur="return empty(this)" oninput="return empty(this)"">';
                echo '</li><li><label>Tracks</label>';
                echo '<input type="number" name="tracks" class="field" value='.$_GET['tracks'].'>';
                echo '</li>';
                echo '<li><input type="submit" name="typeEdit" value="Save"></li>';
                echo '<li><input type="submit" name="typeEdit" value="Delete"></li>';
                echo '<input type="hidden" name="extra" value="'.$_GET['id'].'">';
            }else{
                echo '<li><label>Title <span class="required">*</span></label>';
                echo '<input type="text" name="title" class="field" onblur="return empty(this)" oninput="return empty(this)">';
                echo '</li><li>';
                echo '<label>Artist <span class="required">*</span></label>';
                echo '<select name="artist" class="field">';
                        include_once('db.php');
                        $query = "SELECT artName FROM artist";
                        $results = $conn->query($query) or trigger_error($conn->error);
                        for($i=0;$i<$results->num_rows;$i++){
                            $result = mysqli_fetch_assoc($results);
                            echo '<option name="artName">'.$result['artName'].'</option>';
                        }
                echo '</select>';
                echo '</li><li><label>Price <span class="required">*</span></label>';
                echo '<input type="number" name="price" class="field" onblur="return empty(this)" oninput="return empty(this)">';
                echo '</li><li><label>Genre <span class="required">*</span></label>';
                echo '<input type="text" name="genre" class="field" onblur="return empty(this)" oninput="return empty(this)">';
                echo '</li><li><label>Tracks</label>';
                echo '<input type="number" name="tracks" class="field">';
                echo '</li>';
                echo '<li><input type="submit" name="typeAdd" value="Save"></li>';
                echo '<li><input type="submit" name="typeAdd" value="Delete"></li>';
            }
            ?>
            </ul>
            <br><a href="albums.php"><-- Return to Albums</a>
            <script type="text/javascript">
                function validate(form){
                    if(form.title.value==""){
                        return false;
                    }else if(form.price.value==""){
                        return false;
                    }else if(form.genre.value==""){
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
<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
        <title>Edit Artist</title>
	</head> 
	<body>
		<h1>Edit Artist</h1>
        <ul class="toolbar">
            <li class="toolbar"><a href="home.php">Home</a></li>
            <li class="toolbar"><a href="artists.php">Artists</a></li>
            <li class="toolbar"><a href="albums.php">Albums</a></li>
            <li class="toolbar"><a href="tracks.php">Tracks</a></li>
        </ul>
		<br>
        <form action="artists.php" method="post" id="editArtist"  onSubmit="return validate(this)">
            <ul class="form-style-1">
                <li><label>Name <span class="required">*</span></label>
                <?php
                if(isset($_GET['id'])){
                    echo '<input type="text" name="name" value="'.$_GET['id'].'" class="field" onblur="return empty(this)" oninput="return empty(this)"></li>';
                    echo '<li><input type="submit" name="typeEdit" value="Save"></li>';
                    echo '<li><input type="submit" name="typeEdit" value="Delete"></li>';
                    echo '<input type="hidden" name="extra" value="'.$_GET['id'].'">';
                }else{
                    echo '<input type="text" name="name" class="field" onblur="return empty(this)" oninput="return empty(this)"></li>';
                    echo '<li><input type="submit" name="typeAdd" value="Save"></li>';
                    echo '<li><input type="submit" name="typeAdd" value="Delete"></li>';
                }
                ?>
            </ul>
            <br><a href="artists.php"><-- Return to Artists</a>
            <script>
                function validate(form){
                    if(form.name.value==""){
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
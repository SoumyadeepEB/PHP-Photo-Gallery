<?php
	include "config.php";
	
	if(isset($_POST["upload"]))
	{
		$photo=$_FILES["photo"]["name"];
		$temp=$_FILES["photo"]["tmp_name"];
		$title=$_POST["title"];
		$content=$_POST["content"];
		$ext=pathinfo($photo,PATHINFO_EXTENSION);
		
		$newimg="image_".$title.".".$ext;
		$path="photos/".$newimg;
		
		move_uploaded_file($temp,$path);
		
		$sql="INSERT INTO data (photo,title,content) VALUES ('$newimg','$title','$content')";
		$result=mysqli_query($link,$sql);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Photo Gallery</title>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
	<body>
	<div class="w3-container">
	<h1>Photo Upload</h1>
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="photo">
			<p>
				Photo Title: <input type="text" name="title">
			</p>
			<p>
				About Photo: <input type="text" name="content">
			</p>
			<button type="submit" name="upload">Upload</button>
		</form>
	</div>
	<hr>
		<div class="w3-container w3-row">
		<h1>PHP Photo Gallery</h1>
			
			<?php
				$info="SELECT * FROM data";
				$res=mysqli_query($link,$info);
				$arr=mysqli_fetch_all($res);
				if(mysqli_num_rows($res)>0)
				{
					foreach($arr as $row)
					{
						echo "<div class='w3-card-4 w3-col m5 w3-margin-right w3-margin-bottom'>";
						echo "<img src='photos/$row[1]' height='300' width='100%'>";
						echo "<h1 class='w3-center'>$row[2]</h1>";
						echo "<p class='w3-center'>$row[3]</p>";
						echo "</div>";
					}
				}
			?>
		</div>
	</body>
</html>
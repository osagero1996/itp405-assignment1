<?php 
	$pdo = new PDO('sqlite:chinook.db');
	$sql = "
		SELECT 
		genres.Name
		from genres 
		";

		$statement = $pdo->prepare($sql);
		$statement->execute();
		$genres = $statement->fetchAll(PDO::FETCH_OBJ);
		$statement->closeCursor();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Assignment 1</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
	<table class="table">
		<tr>
			<th>Genres</th>
		</tr>
		<?php foreach($genres as $genre) : ?>
			<tr>
				<td>
					<?php
						$url= "tracks.php?genre=" . urlencode($genre->Name) ;
						$name = $genre->Name
					?>
					 <?php echo "<a href=$url>$name</a>" ?> 
				</td>
			</tr>
		<?php endforeach ?>
	</table>

</body>
</html>
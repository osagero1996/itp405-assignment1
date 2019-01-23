<?php
	$pdo = new PDO('sqlite:chinook.db');

	$sqlgenre="
		SELECT
		genres.GenreId
		FROM genres
		WHERE genres.Name='" . $_GET['genre'] . "'";

		$statement = $pdo->prepare($sqlgenre);
		$statement->execute();
		$genreID = $statement->fetchAll(PDO::FETCH_OBJ);

	$sql = "
		SELECT 
		t.Name as track,
		albums.Title,
		artists.Name as artist, 
		t.UnitPrice 
		FROM tracks t
		INNER JOIN albums
		ON t.AlbumId = albums.AlbumId
		INNER JOIN artists
      	ON albums.artistId = artists.artistId
      	WHERE t.GenreId=" . $genreID[0]->GenreId ;

	
      	$statement = $pdo->prepare($sql);
		$statement->execute();
		$songs = $statement->fetchAll(PDO::FETCH_OBJ);
		
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
			<th>Track</th>
			<th>Album</th>
			<th>Artist</th>
			<th>Price</th>
		</tr>
		<?php foreach($songs as $song) : ?>
			<tr>
				<td>
					<?php echo $song->track ?> 
				</td>
				<td>
					<?php echo $song->Title ?> 
				</td>
				<td>
					 <?php echo $song->artist ?>  
				</td>
				<td>
					<?php echo $song->UnitPrice ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>

</body>
</html>


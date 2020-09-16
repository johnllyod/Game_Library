<!DOCTYPE html>
</html>
<html>
<head>
	<title>Game Library</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/glib_logo.png">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.5.2-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-dark" style="background-image: url('images/bg.png');">
	<div class="container pt-lg-2 pb-lg-2" style="background-image: url('images/Border.png');">
		<a href="index.php" class="col-md-4 col-sm-12">
			<img src="images/glib_logo.png"><h4 style="display: inline; border: none;" class="ml-2 text-light">GAME LIBRARY</h4></a>
		<span class="col-md-8 col-sm-12 form-inline float-right">
			<a href="index.php" class="col-md-3 col-sm-12 btn"><h5 class="text-light">Home</h5></a>
			<form method="post" class="col-md-9 col-sm-12">
				<input class="col-md-6 col-sm-4 form-control" type="text" name="search">
				<input class="col-md-3 col-sm-6 text-light" type="submit" value="Search" style="border: none; background: none; outline:inherit;">
			</form>
		</span>
	</div>
	<br><br>
	<div class="container pt-lg-2 pb-lg-2" style="background-image: url('images/bg.png');">
		<div class="row form-inline">
			<form method="post" class="mx-auto">
				<div class="dropdown d-md-none mt-5 mb-5 pt-5">
					<button class="col-12 btn btn-outline-secondary btn-md dropdown-toggle text-light" data-toggle="dropdown" id="dropmenu" aria-haspopup="true" aria-expanded="false">Genre</button>
					<div class="dropdown-menu bg-dark" aria-labelledby="dropmenu" x-placement="bottom-start" style="position: absolute;will-change: transform; top: 0px; left: 0px; transform: translate3d(63px, 31px, 0px);">
						<button class="dropdown-item text-light mr-2 btn btn-dark" type="submit" value="" name="genre"><h5>All</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-dark" type="submit" value="Open world" name="genre"><h5>Open world</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-secondary" type="submit" value="Platformer" name="genre"><h5>Platformer</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-secondary" type="submit" value="First person" name="genre"><h5>First person</h5></button>
						<button class="dropdown-item text-light mr-3 btn btn-secondary" type="submit" value="Stealth" name="genre"><h5>Stealth</h5></button>
						<button class="dropdown-item text-light mr-3 btn btn-secondary" type="submit" value="Action" name="genre"><h5>Action</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-secondary" type="submit" value="Singleplayer" name="genre"><h5>Singleplayer</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-secondary" type="submit" value="Multiplayer" name="genre"><h5>Multiplayer</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-secondary" type="submit" value="VR" name="genre"><h5>VR</h5></button>
						<button class="dropdown-item text-light mr-2 btn btn-secondary" type="submit" value="RPG" name="genre"><h5>RPG</h5></button>
					</div>
				</div>
				<div class="col-md-12 d-none d-md-block">
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="" name="genre"><h5>All</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="Open world" name="genre"><h5>Open world</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="Platformer" name="genre"><h5>Platformer</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="First person" name="genre"><h5>First person</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="Stealth" name="genre"><h5>Stealth</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="Action" name="genre"><h5>Action</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="Singleplayer" name="genre"><h5>Singleplayer</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="Multiplayer" name="genre"><h5>Multiplayer</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="VR" name="genre"><h5>VR</h5></button>
					<button class="text-light mr-1 mt-1 btn btn-secondary" type="submit" value="RPG" name="genre"><h5>RPG</h5></button>
			</form>
		</div>
	</div>
	<div class="container">
			<?php
				include 'config/database.php';
				if (isset($_POST['search']))
				{
					if ($_POST['search'] == "")
					{
						$section = "All";
						$sqlCond = "SELECT * FROM game_list";	
					}
					else 
					{
						$section = "";
						$sqlCond = "SELECT * FROM game_list where Name = '".$_POST['search']."'";	
					}
				}
				else if (isset($_POST['genre']))
				{
					if ($_POST['genre'] == "")
					{
						$section = "All";
						$sqlCond = "SELECT * FROM game_list";	
					}
					else 
					{
						$section = $_POST['genre'];
						$sqlCond = "SELECT * FROM game_list where Genre like '%".$_POST['genre']."%'";
					}
				}
				else 
				{
					$section = "All";
					$sqlCond = "SELECT * FROM game_list";	
				}
				$results = mysqli_query($conn, $sqlCond);

				echo '<h4 class="text-light">'.$section.' GAMES</h4><div class="row">';

				if ($results)
				{
					while ($row = mysqli_fetch_array($results))
					{
						echo '<div class="col-lg-4 col-md-12">
							<a href="game_page.php?game='.$row["Name"].'" class="float-left">
								<img src="images/'.$row["Name"].'.png">
								<h5 class="text-light"><center>'.$row["Name"].'</center></h5>
							</a>
						</div>';
					}
				}
				else 
				{
					echo '<h4 class="text-light">No data available</h4>';
				}
				echo '</div>';
			?>
	</div>
	<br><br>
	<div class="container" style="background-image: url('images/Border.png'); height: 70px;">
		<center><p class="pt-lg-4 text-light">This is for educational purposes only</p></center>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<?php 
	if (session_status() != PHP_SESSION_ACTIVE) 
	{
		session_start();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Game Library</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/glib_logo.png">
	<link rel="stylesheet" type="text/css" href="pagestyle.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.5.2-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-dark" style="background-image: url('images/bg.png');">
	<center><div class="bg-success text-light successNotif" id="caution"></div></center>
	<?php
		include 'Add.php';
		include 'Remove.php';
	?>
	<div class="container pt-lg-2 pb-lg-2" style="background-image: url('images/Border.png');">
		<a href="index.php" class="col-lg-4 col-md-12 mr-lg-3">
			<img src="images/glib_logo.png"><h4 style="display: inline; border: none;" class="ml-2 text-light">GAME LIBRARY</h4></a>
		<span class="col-lg-4 col-md-12 form-inline float-right">
			<span class="col-lg-3"></span>
			<a href="index.php" class="btn"><h5 class="text-light">Home</h5></a>
			<?php
				if (isset($_SESSION['user']))
				{
					echo '<a href="profile.php" class="btn"><h5 class="text-light">'.$_SESSION['user'].'</h5></a>
					<a href="login_reg.php?id=2" class="btn"><h5 class="text-light">Logout</h5></a>';
				}
				else 
				{
					echo '<a href="login_reg.php?id=0" class="btn"><h5 class="text-light">Login</h5></a>
					<a href="login_reg.php?id=1" class="btn"><h5 class="text-light">Register</h5></a>';	
				}
			?>
		</span>
	</div>
	<div class="container mt-lg-3">
		<div class="col-lg-5 col-md-0"></div>
		<form method="post" class="col-lg-7 col-md-12 form-inline float-right">
			<span class=" col-md-6"></span>
			<input class="col-md-4 col-sm-4 form-control" type="text" name="search">
			<input class="col-md-2 col-sm-8 text-light" type="submit" value="Search" style="border: none; background: none; outline:inherit;">
		</form>
	</div>
	<br><br>
	<div class="container pt-lg-2 pb-lg-2" style="background-image: url('images/bg.png');">
		<div class="row form-inline">
			<form method="post" class="">
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
				<div class="col-lg-12 d-none d-md-block">
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
				</div>
			</form>
		</div>
	</div>
	<div class="container">
			<?php
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
						echo '<div class="col-lg-4 col-md-6">
								<div class="gImage">
									<img src="images/'.$row["Name"].'.png">';
									echo'<div class="linkTogame d-none d-md-block">
										<a href="game_page.php?game='.$row["Name"].'" class="btn btn-dark">
											View Details
										</a>';
									if (strpos($userFav ?? "", $row["Id"]) !== false)
									{
										echo '<form action="index.php" method="post"><button class="btn btn-danger addFav" type="submit" value="'.$row["Id"].'" name="removeFav">
										Remove Favorite
									</button></form>';
									}
									else 
									{
										echo '<form action="index.php" method="post">
											<button class="btn btn-dark addFav" type="submit" value="'.$row["Id"].'" name="fav" id="caution">
												Add to Favorite
											</button>
										</form>';
									}
									echo'</div>
								</div>
								<div class="d-md-none ml-4 mt-2">
									<a href="game_page.php?game='.$row["Name"].'" class="btn btn-primary">
										View Details
									</a>';
									if (strpos($userFav ?? "", $row["Id"]) !== false)
									{
										echo '<form action="index.php" method="post"><button class="btn btn-danger" type="submit" value="'.$row["Id"].'" name="removeFav">
												Remove Favorite
											</button></form>';
									}
									else 
									{
										echo $row["Id"].'<form action="index.php" method="post">
												<button class="btn btn-warning" type="submit" value="'.$row["Id"].'" name="fav" id="caution">
													Add to Favorite
												</button>
											</form>';
									}
								echo'</div>';
									if (strpos($userFav ?? "", $row["Id"]) !== false)
									{
										echo'<span class="float-left"><img src="images/fav_tag.png"></span>';
									}
									echo'<h5 class="text-light"><center>'.$row["Name"].'</center></h5>
							</div>';
					}
				}
				else 
				{
					echo '<h4 class="text-light">No data available</h4>';
				}
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
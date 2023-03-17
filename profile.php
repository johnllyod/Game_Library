<?php 
	if (session_status() != PHP_SESSION_ACTIVE) 
	{
		session_start();
	}
?>
<!DOCTYPE html>
</html>
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
		include 'Change.php';
		include 'Remove.php';?>
	<div class="container pt-lg-2 pb-lg-2" style="background-image: url('images/Border.png');">
		<a href="index.php" class="col-md-4 col-sm-12">
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
	<br><br>
	<div class="container text-light">
		<?php
			include 'config/database.php';
			if (isset($_SESSION['user']))
			{
				echo"<h4 class='mb-lg-3'>Profile</h4>";
				if (isset($_GET['id']))
				{	
					echo'<form action="profile.php" method="post">
						<h4>New username</h4>
						<input type="text" name="newUsername" required></input>
						<input type="submit" name="changeUser" value="Submit" class="btn btn-dark"></input>
					</form>
					<a href="profile.php" class="bg-danger text-light">Cancel</a>';
				}
				else 
				{
					echo"<h5 class='mb-lg-3 float-left'>".$_SESSION['user']."</h5><a href='profile.php?id=1' class='bg-danger text-light ml-1'>Change</a>";
				}
				echo "<h5 class='ml-lg-2'>Favorites</h5>";

				$sqlUserCond = "SELECT * FROM accounts where Username = '".$_SESSION['user']."'";
				$sqlUserQuery = mysqli_query($conn, $sqlUserCond);
				if ($sqlUserQuery)
				{
					while ($userRow = mysqli_fetch_array($sqlUserQuery))
					{
						$userFav = $userRow['Favorites'];
						$sqlGameCond = "SELECT Id, Name FROM game_list";
						$sqlGameQuery = mysqli_query($conn, $sqlGameCond);
						if ($sqlGameQuery)
						{
							while ($gameRow = mysqli_fetch_array($sqlGameQuery)) 
							{
								if (strstr($userFav, $gameRow["Id"]))
								{
									echo'<div class="col-lg-4 col-md-6 float-left">
											<div class="gImage">
												<img src="images/'.$gameRow["Name"].'.png">
												<div class="linkTogame d-none d-md-block">
													<a href="game_page.php?game='.$gameRow["Name"].'" class="btn btn-dark">
														View Details
													</a>
													<form action="profile.php" method="post">
														<button class="btn btn-danger removeFav" type="submit" value="'.$gameRow["Id"].'" name="removeFav">
															Remove Favorite
														</button>
													</form>
												</div>
											</div>

										<div class="d-md-none ml-4 mt-2">
											<a href="game_page.php?game='.$gameRow["Name"].'" class="btn btn-dark">
												View Details
											</a>
											<form action="profile.php" method="post">
												<button class="btn btn-danger" type="submit" value="'.$gameRow["Id"].'" name="removeFav">
													Remove Favorite
												</button>
											</form>
										</div>
										<h5 class="text-light"><center>'.$gameRow["Name"].'</center></h5>
										</div>
										';
								}
							}	
						}
						else 
						{
							echo'<h4>You do not hove any favorites yet.</h4>';
						}
					}
				}
				else 
				{
					echo '<h5>Failed to connect</h5>';
				}
			}
			else 
			{
				echo "<script> window.location.replace('index.php'); </script>";
			}
		?>
	</div>
</body>
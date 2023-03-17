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
	<link rel="stylesheet" type="text/css" href="bootstrap-4.5.2-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-dark" style="background-image: url('images/bg.png');">
	<div class="container pt-lg-2 pb-lg-2" style="background-image: url('images/Border.png');">
		<a href="index.php" class="col-md-4 col-sm-12">
			<img src="images/glib_logo.png"><h4 style="display: inline; border: none;" class="ml-2 text-light">GAME LIBRARY</h4></a>
		<span class="col-lg-4 col-md-12 form-inline float-right">
			<span class="col-lg-3"></span>
			<a href="index.php" class="btn"><h5 class="text-light">Home</h5></a>
			<a href="login_reg.php?id=0" class="btn"><h5 class="text-light">Login</h5></a>
			<a href="login_reg.php?id=1" class="btn"><h5 class="text-light">Register</h5></a>
		</span>
	</div>
	<div class="container mt-5">
		<?php
			include 'config/database.php';
			if (isset($_GET['id']))
			{
				if ($_GET['id'] == 1)
				{
					echo '<center><h4 class="text-light mb-lg-3"><u>REGISTER</u></h4><form action="login_reg.php" method="post" class="text-light">
							<h5>Username</h5>
							<input type="text" name="username" required>
							<h5>Password</h5>
							<input type="password" name="pass" required><br><br>
							<input type="submit" name="register" value="Register" class="btn btn-success">
						</form></center>';
				}
				else if ($_GET['id'] == 2)
				{
					$_SESSION['user'] = null;
					echo '<center><p class="text-light">Logout successfully</p><h4 class="text-light mb-lg-3"><u>LOGIN</u></h4><form action="login_reg.php" method="post" class="text-light">
							<h5>Username</h5>
							<input type="text" name="username">
							<h5>Password</h5>
							<input type="password" name="pass"><br><br>
							<input type="submit" name="login" value="Login" class="btn btn-light">
						</form></center>';
				}
				else {
					echo '<center><h4 class="text-light mb-lg-3"><u>LOGIN</u></h4><form action="login_reg.php" method="post" class="text-light">
							<h5>Username</h5>
							<input type="text" name="username">
							<h5>Password</h5>
							<input type="password" name="pass"><br><br>
							<input type="submit" name="login" value="Login" class="btn btn-light">
						</form></center>';
					if (isset($_SESSION['loginWarning']))
					{
						echo '<center><div class="bg-warning text-dark col-lg-3 mt-3">'.$_SESSION['loginWarning'].'</div><center>';
					}
				}
			}
			else 
			{
				if (isset($_POST['login']))
				{
					$_SESSION['loginWarning'] = "";
					$sqlCond = "SELECT * FROM accounts WHERE Username = '".$_POST['username']."'";
					$sqlQuery = mysqli_query($conn, $sqlCond);

					if ($sqlQuery)
					{
						if ($row = mysqli_fetch_array($sqlQuery))
						{
							$md5Pass = md5($_POST['pass']);
							if ($_POST['username'] == $row['Username'])
							{
								if ($md5Pass == $row['Password'])
								{
									$_SESSION['user'] = $row['Username'];
									$_SESSION['loginWarning'] = null;
									echo "<script> window.location.replace('index.php'); </script>";
									exit();
								}
								else
								{
									$_SESSION['loginWarning'] = "Username or Password is incorrect";
									echo "<script> window.location.replace('login_reg.php?id=0'); </script>";
								}
							}
							else
							{
								$_SESSION['loginWarning'] = "Username or Password is incorrect";
								echo "<script> window.location.replace('login_reg.php?id=0'); </script>";
							}
						}
						else
						{
							$_SESSION['loginWarning'] = "Username or Password is incorrect";
							echo "<script> window.location.replace('login_reg.php?id=0'); </script>";
						}
					}
					else 
					{
						$_SESSION['loginWarning'] = null;
						echo '<center><h4 class="text-light mb-lg-3"><u>LOGIN</u></h4><form action="login_reg.php" method="post" class="text-light">
								<h5>Username</h5>
								<input type="text" name="username">
								<h5>Password</h5>
								<input type="password" name="pass"><br><br>
								<input type="submit" name="login" value="Login" class="btn btn-light">
								<p>Username or password is incorrect</p>
							</form></center><center><div class="bg-warning text-dark col-lg-3 mt-3">Failed to connect</div><center>';
					}
				}
				else if (isset($_POST['register']))
				{
					$mdPass = md5($_POST['pass']);
					$sqlCond = "INSERT INTO accounts (Username, Password) VALUES ('".$_POST['username']."','".$mdPass."')";
					$sqlQuery = mysqli_query($conn, $sqlCond);
					if ($sqlQuery)
					{
						$_SESSION['regWarning'] = null;
						$_SESSION['loginWarning'] = "Registered successfully";
						echo "<script> window.location.replace('login_reg.php?id=0'); </script>";
					}
					else 
					{
						echo '<center><h4 class="text-light mb-lg-3"><u>REGISTER</u></h4><form action="login_reg.php" method="post" class="text-light">
								<h5>Username</h5>
								<input type="text" name="username" required>
								<h5>Password</h5>
								<input type="password" name="pass" required><br><br>
								<input type="submit" name="register" value="Register" class="btn btn-success">
								<center><div class="bg-warning text-dark col-lg-3 mt-3">Username is already taken</div><center>
							</form></center>';
					}
				}
				else 
				{
					echo '<center><h4 class="text-light mb-lg-3"><u>LOGIN</u></h4><form method="post" class="text-light">
							<h5>Username</h5>
							<input type="text" name="username" required>
							<h5>Password</h5>
							<input type="password" name="pass" required><br><br>
							<input type="button" name="login" value="Login" class="btn btn-light">
						</form></center>';
				}
			}
		?>
	</div>
</body>
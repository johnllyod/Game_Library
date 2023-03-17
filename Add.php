<?php
	include 'config/database.php';
	$userFav = '';
	if (isset($_SESSION['user']))
	{
		$sqlCond = "SELECT Favorites FROM accounts where Username = '".$_SESSION['user']."'";
		$sqlQuery = mysqli_query($conn, $sqlCond);
		if ($sqlQuery)
		{
			while ($row = mysqli_fetch_array($sqlQuery)) 
			{
				$userFav = $row['Favorites'];
				if (isset($_POST['fav']))
				{
					if(isset($row['Favorites']))
					{
						if ($row['Favorites'] == "")
						{
							$sqlFavCond = "UPDATE accounts SET Favorites='".$_POST['fav'].",'";
							$sqlFavQry = mysqli_query($conn, $sqlFavCond);
							
							$sqlGetFav = "SELECT Favorites FROM accounts where Username = '".$_SESSION['user']."'";
							$sqlGetFavQ = mysqli_query($conn, $sqlGetFav);
							if ($sqlGetFavQ)
							{
								while ($row = mysqli_fetch_array($sqlGetFavQ)) 
								{
									$userFav = $row['Favorites'];
								}
							}
							
							echo '<script type="text/javascript">
								function ShowNotif()
								{
									document.getElementById("caution").style.display="block";
									document.getElementById("caution").innerHTML="Successfully added to favorites";
									document.getElementById("caution").className="bg-success text-light successNotif";
								}

								function RemoveNotif()
								{
									setTimeout(
										function(){
											document.getElementById("caution").style.display="none";
										}, 5000);
								}
							</script>';
							echo'<script>ShowNotif();</script>';
							echo'<script>RemoveNotif();</script>';
						}
						else 
						{
							$sqlFavCond = "UPDATE accounts SET Favorites='".$userFav.$_POST['fav'].",'";
							$sqlFavQry = mysqli_query($conn, $sqlFavCond);

							$sqlGetFav = "SELECT Favorites FROM accounts where Username = '".$_SESSION['user']."'";
							$sqlGetFavQ = mysqli_query($conn, $sqlGetFav);
							if ($sqlGetFavQ)
							{
								while ($row = mysqli_fetch_array($sqlGetFavQ)) 
								{
									$userFav = $row['Favorites'];
								}
							}
							echo '<script type="text/javascript">
								function ShowNotif()
								{
									document.getElementById("caution").style.display="block";
									document.getElementById("caution").innerHTML="Successfully added to favorites";
									document.getElementById("caution").className="bg-success text-light successNotif";
								}

								function RemoveNotif()
								{
									setTimeout(
										function(){
											document.getElementById("caution").style.display="none";
										}, 5000);
								}
							</script>';
							echo'<script>ShowNotif();</script>';
							echo'<script>RemoveNotif();</script>';
						}
					}
				}
			}
		}
		else
		{
			echo '<script type="text/javascript">
					function ShowNotif()
					{
						document.getElementById("caution").style.display="block";
						document.getElementById("caution").innerHTML="Failed to connect";
						document.getElementById("caution").className="bg-danger text-light successNotif";
					}

					function RemoveNotif()
					{
						setTimeout(
							function(){
								document.getElementById("caution").style.display="none";
							}, 5000);
					}
				</script>';
				echo'<script>ShowNotif();</script>';
				echo'<script>RemoveNotif();</script>';
		}
	}
	else 
	{
		if (isset($_POST['fav']))
		{
			echo "<script> window.location.replace('login_reg.php'); </script>";
		}
	}
?>
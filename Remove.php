<?php
	include 'config/database.php';
	if (isset($_POST['removeFav']))
	{
		$sqlUserCond = "SELECT Favorites FROM accounts where Username = '".$_SESSION['user']."'";
		$sqlUserQuery = mysqli_query($conn, $sqlUserCond);
		if ($sqlUserQuery)
		{
			while($row = mysqli_fetch_array($sqlUserQuery))
			{
				$deleteFav = str_replace($_POST['removeFav'].',', '', $row['Favorites']);
				$sqlRmvCond = "UPDATE accounts SET Favorites = '".$deleteFav."'";
				$sqlRmvQuery = mysqli_query($conn, $sqlRmvCond);

				$sqlGetFav = "SELECT Favorites FROM accounts where Username = '".$_SESSION['user']."'";
				$sqlGetFavQ = mysqli_query($conn, $sqlGetFav);
				if ($sqlGetFavQ)
				{
					while ($row = mysqli_fetch_array($sqlGetFavQ)) 
					{
						$userFav = $row['Favorites'];
					}
				}
				
				if ($sqlRmvQuery)
				{
					echo '<script type="text/javascript">
						function ShowNotif()
						{
							document.getElementById("caution").style.display="block";
							document.getElementById("caution").innerHTML="Removed successfully";
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
					echo '<script type="text/javascript">
						function ShowNotif()
						{
							document.getElementById("caution").style.display="block";
							document.getElementById("caution").innerHTML="Failed to remove item. check your network and try again.";
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
		}
	}
?>
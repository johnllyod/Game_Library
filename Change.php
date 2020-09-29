<?php
	include 'config/database.php';
	if (isset($_SESSION['user']))
	{
		if (isset($_POST['newUsername']))
		{
			$sqlCond = "UPDATE accounts SET Username= '".$_POST['newUsername']."'";
			$sqlQuery = mysqli_query($conn, $sqlCond);
			if ($sqlQuery)
			{
				$_SESSION['user'] = $_POST['newUsername'];
				echo '<script type="text/javascript">
					function ShowNotif()
					{
						document.getElementById("caution").style.display="block";
						document.getElementById("caution").innerHTML="Successfully change your username";
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
						document.getElementById("caution").innerHTML="Username already taken";
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
?>
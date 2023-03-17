<?php
	include 'config/database.php';
	if (isset($_SESSION['user']))
	{
		if (isset($_POST['newUsername']))
		{
			mysqli_report(MYSQLI_REPORT_OFF);
			$sqlCond = "UPDATE accounts SET Username = '".$_POST['newUsername']."' WHERE Username = '".$_SESSION['user']."'";
			$sqlResult = mysqli_query($conn, $sqlCond);
			$error_message = mysqli_error($conn);

			if ($error_message == "")
			{
				echo "Success";
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
				if (strpos($error_message ?? "", "Duplicate") !== false)
				{
					$error_message = "Username is already taken.";
				}
				echo '<script type="text/javascript">
					function ShowNotif()
					{
						document.getElementById("caution").style.display="block";
						document.getElementById("caution").innerHTML="'.$error_message.'";
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
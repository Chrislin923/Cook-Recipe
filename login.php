<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Log in</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div class="header">
		<p class="h2">Log in
		
		
		<p>
	
	</div>
	<div class="login">
		<form class="login" action="index.html" method="post">
			Username: <input type="text" name="username" required><br> Password: <input
				type="password" name="password" required><br> <input type="submit"
				value="Log in" class="button">

			<?php if (isset($_SESSION['error']) == - 1) { ?>
				<p id="incorrectPassword">Incorrect email or password.</p>
			<?php session_destroy(); session_regenerate_id(TRUE); } ?>

		</form>
	</div>

	<div class="login">
		<form class="login" action="register.php" method="post">
			<div class="centerAlign">Not registered?</div>
			<input type="submit" value="Register" class="button" />
		</form>
	</div>
</body>
</html>
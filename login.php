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
			Email: <input type="text" name="email" required><br> Password: <input
				type="password" name="password" required><br> <input type="submit"
				value="Log in" class="button">

			<!-- need to validate!! -->

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
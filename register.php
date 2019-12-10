
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

	<div class="header">
		<p class="h2">Register</p>
	</div>
	
	<div id="newAccount">
		<form id="newAccount" class="login" action="valid.php" method="post">

			First Name: <input type="text" id="firstName" name="firstName"
				pattern="[A-Z a-z]*" required autocomplete='given-name'> <br> <br>

			Last Name: <input type="text" id="lastName" name="lastName"
				pattern="[A-Z a-z]*" required autocomplete='given-name'> <br> <br>

			Username: <input type="text" id="username" name="username"
				pattern="[a-z]*" required autocomplete='user-name'> <br> <br>

			Password: <input type="password" name="password"
				pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required
				autocomplete='given-password'
				oninvalid="setCustomValidity('Minimum eight characters, at least one letter and one number:')"
				onchange="try{setCustomValidity('')}catch(e){}"> <br> <br> <input
				type="hidden" name="newUser"> <input type="submit" value="Register"
				class="button">

		</form>

	</div>
</body>
</html>
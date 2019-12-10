
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
	
	<div>
		<form class="login" action="index.html" method="post">

			First Name: <input type="text" id="firstName" name="firstName"
				pattern="[A-Z a-z]*" required autocomplete='given-name'> <br> <br>

			Last Name: <input type="text" id="lastName" name="lastName"
				pattern="[A-Z a-z]*" required autocomplete='given-name'> <br> <br>

			Email: <input type="text" id="email" name="email"
				pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$"
				required autocomplete='given-email'> <br> <br> Password: <input
				type="password" name="password"
				pattern="(?=.*[A-Z])(?=.*[0-9])(?=.{6,})" required
				oninvalid="setCustomValidity('Password must be at least 6 characters and contain at least one uppercase and one special character.')"
				onchange="try{setCustomValidity('')}catch(e){}"> <br> <br> 
				
			<input type="submit" value="Register" class="button">
		
		</form>

	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	
	<style type="text/css">
		form {
			width: 350px;
			margin: 0 auto;
			text-align: center;
		}
		input[type="text"], input[type="password"] {
			padding: 20px;
			margin-bottom: 100px;
			width: 100%;
			box-sizing: border-box;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<form method="post" action="login.php">
		<h2>Login</h2>
		<input type="text" name="username" placeholder="Username" required>
		<input type="password" name="password" placeholder="Password" required>
		<input type="submit" value="Login">
	</form>
</body>
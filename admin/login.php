<?php
	$dbservername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "rest";

	// Create connection
	$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT id, username, password FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
//	        echo "id: ".$row["id"]."<br> Name: ".$row["username"]."<br> Password: ".$row["password"]. "<br>";
	        $usernameFromDB = $row["username"];
	        $passwordFromDB = $row["password"];
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();

	$username = null;
	$password = null;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(!empty($_POST["username"]) && !empty($_POST["password"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	if($username == $usernameFromDB && $password == $passwordFromDB) {
		session_start();
		$_SESSION["authenticated"] = 'true';
		header('Location: index.php');
	}
	else {
		header('Location: login.php');
	}

	} else {
		header('Location: login.php');
	}
	} else {
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
 <link rel="stylesheet" href="assets/css/login.css">
 <title>Login</title>
</head>
<body>
	<div id="login">
	 <h1>Login</h1>
 <form method="post">
 <label for="username">Username: </label>
 <input id="username" name="username" type="text" required autofocus>
 <label for="password">Password: </label>
 <input id="password" name="password" type="text" required>
 <br />
 <input type="submit" value="Login">
 </form>
	</div>
</body>
</html>
<?php } ?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>

	<label>Username: </label>
	<br>
	<input type="text" placeholder="Username" id="username">
	<br><br>
	<label>Password: </label>
	<br>
	<input type="password" placeholder="Password" id="password">

	<button id="loginButton">Login</button>


<script src="./assets/js/jquery.min.js"></script>
<script>
	var username, password,
		tempUrl = window.location.href + '';


		
	$.ajax({
		type: 'GET',
		url: 'http://localhost/rest/api/api.php/users?transform=1',
		success: function(items){
			$.each(items, function(i, item) {
				$.each(item, function(i, item) {
					username = item.username;
					password = item.password;
				});
			});
		},
		error: function(){
			console.log('ERROR!!!')
		}
	})

	$('#loginButton').on('click', function(event) {
		var inputUsername = $('#username').val(),
			inputPassword = $('#password').val(),
			localUrl = window.location.href;

		event.preventDefault();

		if (inputUsername == username && inputPassword == password) {
			window.location = localUrl + 'dashboard.php';
		}else{
			console.log('ERROR!')
		}
	});

</script>
	
</body>
</html> -->
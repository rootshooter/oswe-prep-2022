<?php
   ob_start();
   session_start();
?>
<!DOCTYPE html>
<html>
<head><title>DVPA - PHP Type Juggling</title>
<link rel="shortcut icon" href="../Images/icons8-hacker-2.png">
<link rel="stylesheet" href="../assets/PHP-Type-Juggling.css"></head>
<body>

<?php
	
	if (isset($_POST['login']) && !empty($_POST['username']) 
	   && !empty($_POST['password'])) {

		$password = $_POST['password'];
		$password = str_replace(array("aaK1STfY","10932435112","aaO8zKZF")," ",$password);
	   
		if ($_POST['username'] == 'admin' && sha1($password) == sha1('aaK1STfY') ) {
		echo "<script>";  
		echo 'alert("Congratulations ^-^ ")';
		echo "</script>";

	   }else {

		  echo "<script>";  
		  echo 'alert("Wrong Username or Password")';
		  echo "</script>";
	   }
	}
?>
    <div class="login">
        <h2>Admin Panel Login SHA1</h2>
        <form role="form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method = "post">
			 <input type="text" name="username" placeholder="Enter Username" required="required" />
			 <input type="password" name="password" placeholder="Enter Password" required="required" />
			 <button type="submit" name="login"  class="btn">login</button>
      </form>
    </div>
</body>
</html>


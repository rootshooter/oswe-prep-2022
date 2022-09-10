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
	   && !empty($_POST['password'])) 
	  
	   $password = $_POST['password'];
	   
	   if ($_POST['username'] == 'admin' &&  strlen($password) == 9 && preg_match('/t5$/', $password) && hash('sha224',$password) == hash('sha224','10885164793773') ) {
		
		echo "<script>";  
		echo 'alert("Congratulations ^-^ ")';
		echo "</script>";

	   }else {

		  echo "<script>";  
		  echo 'alert("Wrong Username or Password")';
		  echo "</script>";
	   
	}
	
?>
    <div class="login">
        <h2>Admin Panel Login SHA224</h2>
        <form role="form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  method = "post">			 
			 <input type="text" name="username" placeholder="Enter Username" required="required" />
			 <input type="password" name="password" placeholder="Enter Password" required="required" />
			 <button type="submit" name="login"  class="btn">login</button>  
      </form>
    </div>
</body>
</html>


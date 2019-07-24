<?php session_start(); ?>
<?php include('dbcon.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Login here</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
  </form>
  <?php
	if (isset($_POST['login']))
		{
			$username = mysqli_real_escape_string($con, $_POST['user']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);
			
			$query 		= mysqli_query($con, "SELECT * FROM users WHERE  password='$password' and username='$username'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
			if ($num_row > 0) 
				{			
					$_SESSION['user_id']=$row['user_id'];
					header('location:home.php');
					
				}
			else
				{
					echo 'Invalid Username and Password Combination';
				}
		}
  ?>
  <div class="reminder">
    <script type="text/javascript">
    function AlertIt() {
    var answer = confirm ("Admin username and password can be found on the text file home/public/HVAC/credentials.txt, located on the SCR Linux Machine (192.160.0.2), on newtwork SCR_AP in CII 7003")
    if (answer)
        window.location;
    }
    </script>
    <br/>
    <p><a href="javascript:AlertIt();">Forgot username/password?</a></p>
</div>

</div>

</body>
</html>

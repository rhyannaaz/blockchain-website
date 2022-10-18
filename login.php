<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.inc';?>
	<title>Log In | Blockchain</title>
	<!-- Description: Supervisor Log In Page -->
    <!-- Author: Rhyanna Arisya 103698709 -->
    <!-- Last Modified: 23/6/2021 -->
</head>
<body>
	
    <?php include 'header.inc';?>
	<?php include 'menu.inc';?>

	<form method="POST" action="login.php">
		<fieldset id='fheight' class='quiz'>
			<legend class='quizalign'>LOG IN</legend>
			<br><br>
			<p class='quizalign'>Please log in to manage quiz attempts</p>
			<br><br>
			<p class='quizalign'>
			    <label>Username: </label><input type="text" name="username" placeholder="Enter Username"/>
			    <br><br>
			    <label>Password: </label><input type="password" name="password" placeholder="Enter Password"/>
			</p>
			<p class='quizalign'>
			    <input type="submit" name="submit" value="LOGIN"/>
			</p>
			<br><br>
			<p class='quizalign'>*This is only applicable for quiz supervisors only.</p>
		</fieldset>
	</form>

    <?php
        include 'settings.php';

        // start a new session
        session_start();
        // check if username and password have been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // store variables, sanitised
            $myusername = trim(stripslashes(htmlspecialchars($_POST['username'])));
            $mypassword = trim(stripslashes(htmlspecialchars($_POST['password'])));

            //check if the username is in the database
            $query = "SELECT * FROM supervisors WHERE username = '$myusername' and password = '$mypassword'";
            $result = @mysqli_query($db, $query);

            // If result matched $myusername and $mypassword, table row must be 1 row
            if(@mysqli_num_rows($result)) {
                // remember the user has been logged in on the session
                $_SESSION['username'] = $myusername;
                header ("location:manage.php");
            } else {
            	// redirect back to login page, do not allow access to manage.php
	            header("location:login.php");
            }
        }
    ?>

	<br><br><br><br><br><br><br><br><br>
	<?php include 'footer.inc';?>

</body>
</html>
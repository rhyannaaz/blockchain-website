<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'head.inc';?>
	<title>PHP Enhancements | Blockchain</title>
	<!-- Description: PHP Enhancements Page -->
    <!-- Author: Rhyanna Arisya 103698709 -->
    <!-- Last Modified: 24/6/2021 -->
</head>
<body>
	<?php include 'header.inc';?>
	<?php include 'menu.inc';?>

	<section>
    	<h2>1. Login Page</h2>
    	<p>
    		To manage the quiz attempts, the quiz supervisor must log into the manage page. The link in the navigation bar labelled 'MANAGE' is provided which will direct the user to the login page if they have not yet log in. The username and password are stored in a separate table named 'supervisors' in the database. The username and passwords must match to allow the user to login. 
    		<br><br>
    		The website keeps track of the users login via the session storage. The user is logged out if they close the session. The user is able to logout via the logout button. The manage page cannot be accessed directly from a url if user has not logged in. When the user logs out, the session is destroyed.
    		<br><br>
    		The Enhancement can be found <a href="login.php">here</a>.
    	</p>
    </section>

    <section>
    	<h2>2. Indicate which column to sort the table by</h2>
    	<p>
    		The supervisor is able to display the quiz attempt records by selecting a desired column to sort by order. This is executed by using a select form element which includes all of the field names in the table. The MySQL command "ORDER BY" is used to perform this action.
    		<br><br>
    		The Enhancement can be found <a href="manage.php">here</a>.
    	</p>
    </section>

    <br><br><br><br><br>
    <?php include 'footer.inc';?>
	
</body>
</html>
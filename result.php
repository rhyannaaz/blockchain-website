<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'head.inc';?>
	<title>Results | Blockchain</title>
	<!--<script src="scripts/quiz.js"></script>-->
</head>
<body id="resultPage">
	
	<?php include 'header.inc';?>
	<?php include 'menu.inc';?>

	<?php
	// If a user just entered this url, redirect them to the form
    if (!isset($_POST["studentid"])) {
        header("location:quiz.php");
    }
    ?>


    <form>
	<fieldset class="quiz">
		<legend class='quizalign'>QUIZ RESULTS</legend>
		<br>
		<p>First Name: <span id="firstname"></span></p>
		<p>Last Name: <span id="lastname"></span></p>
		<p>Student ID: <span id="studentid"></span></p>                 
		<p>Attempt: <input type="text" id="attempt" readonly></p>
		<p>Score: <input type="text" id="score" readonly></p>
		<br><br>
		
		<p><a href="quiz.php" id="attemptbtn">MAKE ANOTHER ATTEMPT</a></p>
    </fieldset>
    </form>

    <br><br><br><br><br><br><br><br><br><br><br>
    <?php include 'footer.inc';?>

</body>
</html>
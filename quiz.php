<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.inc';?>
	<title>Quiz | Blockchain</title>
	<!--<script src="scripts/quiz.js"></script>-->
	<!-- Description: Quiz Page -->
    <!-- Author: Rhyanna Arisya 103698709 -->
    <!-- Last Modified: 23/6/2021 -->
</head>
<body id="quizPage">
	
	<?php include 'header.inc';?>
	<?php include 'menu.inc';?>

    <form id="quizForm" method="post" action="markquiz.php" novalidate="novalidate">
	<fieldset class="quiz">
		<legend class='quizalign'>BLOCKCHAIN QUIZ</legend>
		<fieldset id="person">
		<legend>Student Identification</legend>
		<p><label for="firstname">First Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name= "firstname" id="firstname" required="required" pattern="^[A-Za-z -]{1,25}$" placeholder="Enter your first name"/></p>

		<p><label for="lastname">Last Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name= "lastname" id="lastname" required="required" pattern="^[A-Za-z -]{1,25}$" placeholder="Enter your last name"/></p>

		<p><label for="studentid">Student ID</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name= "studentid" id="studentid" required="required" pattern="^([0-9]{7}|[0-9]{10})$" placeholder="Enter your student ID"/></p>
		</fieldset>

		<br><br>

		<fieldset>
		<legend>Questions (2 mark each)</legend>
		<p><label for="question1">1. Define Blockchain.</label></p>
		<p><textarea id="question1" name="question1" rows="3" cols="90"></textarea></p>

		<br>

		<p><label>2. Who was/were the first to outline blockchain technology ?</label></p>
		<p><input type="checkbox" id="stuarthaber" name="stuarthaber" value="stuarthaber"/>
			<label for="stuarthaber">Stuart Haber</label></p>
		<p><input type="checkbox" id="satoshinakamoto" name="satoshinakamoto" value="satoshinakamoto"/>
			<label for="satoshinakamoto">Satoshi Nakamoto</label></p>
		<p><input type="checkbox" id="lukeconway" name="lukeconway" value="lukeconway"/>
			<label for="lukeconway">Luke Conway</label></p>
		<p><input type="checkbox" id="wscottstornetta" name="wscottstornetta" value="wscottstornetta"/>
			<label for="wscottstornetta">W. Scott Stornetta</label></p>

		<br>

		<p><label>3. Which statement is considered <strong>false</strong> regarding the growth of blockchain technology ?</label></p>
		<p><input type="radio" id="ico" name="question3" value="ico"/>
			<label for="ico">ICO investments increased 16 times.</label></p>
		<p><input type="radio" id="percent" name="question3" value="percent"/>
			<label for="percent">45% banks currently experimenting with Blockchain Technology.</label></p>
		<p><input type="radio" id="countries" name="question3" value="countries"/>
			<label for="countries">14 countries exploring developing official cryptocurrencies.</label></p>
		<p><input type="radio" id="ethereum" name="question3" value="ethereum"/>
			<label for="ethereum">Ethereum grew 50 times.</label></p>

		<br>

		<p><label for="question4">4. What does Blockchain intend to make business and government operations ?</label></p>
		<p><select name="question4" id="question4">
			<option value="">Please Select</option>
			<option value="reliable and dependable">reliable and dependable</option>
			<option value="more efficient, reliable, stable, and cost-effective">more efficient, reliable, stable, and cost-effective</option>
			<option value="more effective, reliable, dependable, and cost-effective">more effective, reliable, dependable, and cost-effective</option>
			<option value="more cost-effective">more cost-effective</option>
		    </select></p>

		<br>

		<p><label for="question5">5. According to the blockchain related technologies table, how many network are running on the Blockchain platform ?</label></p>
		<p><input type="number" name= "question5" id="question5" required="required" min="1" max="5"/></p>
	    </fieldset>


	<p><input type="reset" value="RESET"/><input type="submit" id ="submitquizbtn" value="SUBMIT"/></p>

    </fieldset>
    </form>
    <br>

	<?php include 'footer.inc';?>

</body>
</html>
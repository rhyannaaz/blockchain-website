<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.inc';?>
	<title>Quiz | Blockchain</title>
    <!-- Description: Mark Quiz Page -->
    <!-- Author: Rhyanna Arisya 103698709 -->
    <!-- Last Modified: 23/6/2021 -->
</head>
<body>
	
    <?php include 'header.inc';?>
	<?php include 'menu.inc';?>


<?php

    // If a user just entered this url, redirect them to the form
    if (!isset($_POST["studentid"])) {
        header("location:quiz.php");
    }

    require_once("settings.php");
    $conn = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );
    if (!$conn) {
        //display an error message
        $errMsg .= "<p>Database connection failure</p>";
    } 
    else {
    	// Sanitise Data
    	function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);                
            $data = htmlspecialchars($data);                
            return $data;
        }

        $errMsg = "";
        $score = 0;
        $attempt = 0;

        // Get form data and validate
        //First name
        if (isset($_POST["firstname"])) {
        	$firstname = $_POST["firstname"];
        	$firstname = sanitise_input($firstname);
        }
        else {
            $errMsg .= "<p>Enter your first name.</p>\n";
        }
        //Last name
        if (isset($_POST["lastname"])) {
        	$lastname = $_POST["lastname"];
        	$lastname = sanitise_input($lastname);
        }
        else {
            $errMsg .= "<p>Enter your last name.</p>\n";
        }
        //Student ID
        if (isset($_POST["studentid"])) {
        	$studentid = $_POST["studentid"];
        	$studentid = sanitise_input($studentid);
        } 
        else {
            $errMsg .= "<p>Enter your student ID.</p>\n";
        }
        //Question 1
        if (isset($_POST["question1"])) {
        	$question1 = $_POST["question1"];
        	$question1 = sanitise_input($question1);
        }
        else {
            $errMsg .= "<p>Please provide an answer for Question 1.</p>\n";
        }
        //Question 4
        if (isset($_POST["question4"])) {
        	$question4 = $_POST["question4"];
        	$question4 = sanitise_input($question4);
        } 
        else {
            $errMsg .= "<p>Please provide an answer for Question 4.</p>\n";
        }
        //Question 5
        if (isset($_POST["question5"])) {
        	$question5 = $_POST["question5"];
        	$question5 = sanitise_input($question5);
        }
        else {
            $errMsg .= "<p>Please provide an answer for Question 5.</p>\n";
        }
        
        //Check inputs for student identification
        if ($firstname=="") {
            $errMsg .= "<p>You must enter your first name.</p>\n";
        }
        else if (!preg_match("/^[A-Za-z -]{1,20}$/", $firstname)) {
            $errMsg .= "<p>Only a maximum of 20 alpha letters, spaces and hyphen characters are allowed in your first name.</p>\n";
        }
        if ($lastname=="") {
            $errMsg .= "<p>You must enter your last name.</p>\n";
        }
        else if (!preg_match("/^[A-Za-z -]{1,20}$/", $lastname)) {
            $errMsg .= "<p>Only a maximum of 20 alpha letters, spaces and hyphen characters are allowed in your last name.</p>\n";
        }
        if ($studentid=="") {
            $errMsg .= "<p>You must enter your student ID.</p>\n";
        }
        else if (!is_numeric($studentid)) {
            $errMsg .= "<p>Only numeric values allowed in your student ID.</p>\n";
        }
        else if (!preg_match("/^([0-9]{7})$|(^[0-9]{10})$/", $studentid)) {
            $errMsg .= "<p>Only 7 or 10 digits are allowed for your student ID.</p>\n";
        }

        //Mark questions
        //Question 1
        if ($question1 == "") { //checks if answer is empty
            $errMsg .= "<p>Please provide an answer for Question 1.</p>\n";
        }
        else if (preg_match('/\bdecentralized\b/', $question1)) { //checks if answer includes "decentralised"
            $score += 2;
        }
        //Question 2
        if (!isset($_POST["stuarthaber"]) && !isset($_POST["wscottstornetta"]) && !isset($_POST["satoshinakamoto"]) && !isset($_POST["lukeconway"])) { //checks if any of the checkboxes are selected
            $errMsg .= "<p>Please provide an answer for Question 2.</p>\n";
        }
        else if (isset($_POST["stuarthaber"]) && isset($_POST["wscottstornetta"]) && !isset($_POST["satoshinakamoto"]) && !isset($_POST["lukeconway"])) { //checks if  "stuarthaber" and "wscottstornetta" checkboxes are checked
            $score += 2;
        }
        //Question 3
        if (isset($_POST["question3"]) == '') { //checks if any of the radio buttons are selected
            $errMsg .= "<p>Please provide an answer for Question 3.</p>\n";
        }
        else if (isset($_POST["question3"]) == 'percent') { //checks if the "percent" radio button is checked
            $score += 2;
        }
        //Question 4
        if ($question4 == "") { //checks if answer is empty
            $errMsg .= "<p>Please provide an answer for Question 4.</p>\n";
        }
        else if ($question4 == "more efficient, reliable, stable, and cost-effective") { //checks if answer given by user is equal to the correct answer
            $score += 2;
        }
        //Question 5
        if ($question5 == "") { //checks if answer is empty
            $errMsg .= "<p>Please provide an answer for Question 5.</p>\n";
        }
        else if (!preg_replace( '/[^0-9]/', '', $question5)) { //checks if answer is a number
            $errMsg .= "<p>Question 5: Please enter a valid number.</p>\n";
        }
        else if ($question5 < 1) { //checks if answer is less than 1
            $errMsg .= "<p>Question 5: Number must be 1 or more.</p>\n";
        }
        else if ($question5 > 5) { //checks if answer is more than 5
            $errMsg .= "<p>Question 5: Number must be 5 or less.</p>\n";
        }
        else if ($question5 == 2) { //checks if answer given by user is equal to 5
            $score += 2;
        }

        //Set table
        $sql_table = "attempts";

        if ($errMsg != "") { //display error message and a back button to fix error
            echo (
            "<form><fieldset id='fheight' class='quiz'>
            <legend class='quizalign'>QUIZ ERRORS</legend>
            $errMsg
            <br><br><br><br>
            <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p> 
            </fieldset>
            </form>");
        } // javascript:history.go(-1) method loads a specific URL from the history list.
        else if ($score == 0) { //display error message when score is zero
            echo ("<p>Score is zero :(</p>\n");
        }
        else {
            $check_studentid = "SELECT * FROM $sql_table WHERE studentid = '$studentid'";
            $result = mysqli_query($conn, $check_studentid);
            if ($result->num_rows == 0) {
                $attempt += 1;
                // Check if table does not exist, create table
                $create_table = "CREATE TABLE IF NOT EXISTS $sql_table (
                    attempt_id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    date_time TIMESTAMP NOT NULL,
                    firstname VARCHAR(20) NOT NULL,
                    lastname VARCHAR(20) NOT NULL,
                    studentid INT(10) NOT NULL,
                    attempt INT(1) NOT NULL,
                    score INT(2) NOT NULL)";

                $open_table = mysqli_query($conn, $create_table);
                //check if the query was successful
                if (!$open_table) {
                    echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ ERRORS</legend>
                        <p>An error occured in the query</p>
                        $errMsg
                        <br><br><br><br>                        
                        <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p>
                        </fieldset>
                        </form>");
                }
                else {
                    // Table Exists
                    // Enter Data
                    // SQL command
                    $query = "INSERT INTO $sql_table (firstname, lastname, studentid, attempt, score) VALUES ('$firstname', '$lastname', '$studentid', '$attempt', '$score')";

                    // store the result in a result pointer
                    $result = mysqli_query($conn, $query);

                    //check if the query was successful
                    if (!$result) {
                        echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ ERRORS</legend>
                        <p>Something is wrong with the query</p>
                        $errMsg
                        <br><br><br><br>
                        <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p>
                        </fieldset>
                        </form>");
                    } 
                    else {
                        echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ RESULTS</legend>
                        <br>
                        <p>First Name: $firstname</p>
                        <p>Last Name: $lastname</p>
                        <p>Student ID: $studentid</p>                 
                        <p>Attempt: $attempt</p>
                        <p>Score: $score</p>
                        <br><br><br><br>
                        <p><a href='quiz.php' id='attemptbtn'>MAKE ANOTHER ATTEMPT</a></p>
                        </fieldset>
                        </form>");
                    }
                }
            }
            else if ($result->num_rows == 1) {
                $attempt += 2;
                // Check if table does not exist, create table
                $create_table = "CREATE TABLE IF NOT EXISTS $sql_table (
                    attempt_id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    date_time TIMESTAMP NOT NULL,
                    firstname VARCHAR(20) NOT NULL,
                    lastname VARCHAR(20) NOT NULL,
                    studentid INT(10) NOT NULL,
                    attempt INT(1) NOT NULL,
                    score INT(2) NOT NULL)";

                $open_table = mysqli_query($conn, $create_table);
                //check if the query was successful
                if (!$open_table) {
                    echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ ERRORS</legend>
                        <p>An error occured in the query</p>
                        $errMsg
                        <br><br><br><br>
                        <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p>
                        </fieldset>
                        </form>");
                }
                else {
                    // Table Exists
                    // Enter Data
                    // SQL command
                    $query = "INSERT INTO $sql_table (firstname, lastname, studentid, attempt, score) VALUES ('$firstname', '$lastname', '$studentid', '$attempt', '$score')";

                    // store the result in a result pointer
                    $result = mysqli_query($conn, $query);

                    //check if the query was successful
                    if (!$result) {
                        echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ ERRORS</legend>
                        <p>Something is wrong with the query</p>
                        $errMsg
                        <br><br><br><br>
                        <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p>
                        </fieldset>
                        </form>");
                    } 
                    else {
                        echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ RESULTS</legend>
                        <br>
                        <p>First Name: $firstname</p>
                        <p>Last Name: $lastname</p>
                        <p>Student ID: $studentid</p>                 
                        <p>Attempt: $attempt</p>
                        <p>Score: $score</p>
                        <br><br><br><br>
                        <p><a href='quiz.php' id='attemptbtn'>MAKE ANOTHER ATTEMPT</a></p>
                        </fieldset>
                        </form>");
                    }
                }
            }
            else if ($result->num_rows == 2){
                $attempt += 3;
                // Check if table does not exist, create table
                $create_table = "CREATE TABLE IF NOT EXISTS $sql_table (
                    attempt_id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    date_time TIMESTAMP NOT NULL,
                    firstname VARCHAR(20) NOT NULL,
                    lastname VARCHAR(20) NOT NULL,
                    studentid INT(10) NOT NULL,
                    attempt INT(1) NOT NULL,
                    score INT(2) NOT NULL)";

                $open_table = mysqli_query($conn, $create_table);
                //check if the query was successful
                if (!$open_table) {
                    echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ ERRORS</legend>
                        <p>An error occured in the query</p>
                        $errMsg
                        <br><br><br><br>
                        <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p>
                        </fieldset>
                        </form>");
                }
                else {
                    // Table Exists
                    // Enter Data
                    // SQL command
                    $query = "INSERT INTO $sql_table (firstname, lastname, studentid, attempt, score) VALUES ('$firstname', '$lastname', '$studentid', '$attempt', '$score')";

                    // store the result in a result pointer
                    $result = mysqli_query($conn, $query);

                    //check if the query was successful
                    if (!$result) {
                        echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ ERRORS</legend>
                        <p>Something is wrong with the query</p>
                        $errMsg
                        <br><br><br><br>
                        <p><a href='javascript:history.go(-1)' id='attemptbtn'>GO BACK</a></p>
                        </fieldset>
                        </form>");
                    } 
                    else {
                        echo (
                        "<form><fieldset id='fheight' class='quiz'>
                        <legend class='quizalign'>QUIZ RESULTS</legend>
                        <br>
                        <p>First Name: $firstname</p>
                        <p>Last Name: $lastname</p>
                        <p>Student ID: $studentid</p>                 
                        <p>Attempt: $attempt</p>
                        <p>Score: $score</p>
                        <br><br>
                        </fieldset>
                        </form>");
                    }
                }
            }
            else if ($result->num_rows == 3){
                echo (
                "<form><fieldset id='fheight' class='quiz'>
                <legend class='quizalign'>QUIZ ERROR</legend>
                <br><br><br><br>
                <p class='quizalign'>You have reached the maximum number of attempts !</p>
                <br><br><br><br>
                </fieldset>
                </form>");
            }
        }
        //Close database
        mysqli_close($conn);
    }
?>

    <br><br><br><br><br><br><br><br><br>
    <?php include 'footer.inc';?>

</body>
</html>
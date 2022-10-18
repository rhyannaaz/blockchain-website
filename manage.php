<?php include ('session.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.inc';?>
	<title>Manage | Blockchain</title>
    <!-- Description: Manage Page -->
    <!-- Author: Rhyanna Arisya 103698709 -->
    <!-- Last Modified: 23/6/2021 -->
</head>
<body>
	
    <?php include 'header.inc';?>
	<?php include 'menu.inc';?>

    <p class='quizalign'><a href="logout.php" id="logoutbtn" class='quizalign'>LOGOUT</a></p>

    <!--
    - List all attempts.
    - List all attempts for a particular student (given a student id OR name).
    -->
	<form method="POST" action="manage.php">
		<fieldset class="quiz">
			<legend class='quizalign'>RECORD OF QUIZ ATTEMPTS</legend>
			<br>
            <p class='quizalign'>Search for student or leave blank to display all quiz attempts</p>
            <br><br>
            <p class='quizalign'>
                <label>Search: </label>
                <input type="search" name="query" id="query" placeholder="Enter Student ID/ Name" autocomplete="off"/>
                <br><br>
                <label>Order Records By: </label>
                <select name="order" id="order">
                    <option value="">Select Order</option>
                    <option value="attemptid">Attempt ID</option>
                    <option value="date_time">Date & Time</option>
                    <option value="studentid">Student ID</option>
                    <option value="firstname">First Name</option>
                    <option value="lastname">Last Name</option>
                    <option value="attempt">Attempt</option>
                    <option value="score">Score</option>
                </select>
                <br><br>
                <input type="submit" name="SEARCH" value="SEARCH"/>
            </p>
		</fieldset>
	</form>

	<?php
	// Check if this for was submitted
	if (!empty($_POST["SEARCH"])) {
		if (isset($_POST["query"])) { //Check if the data is empty
			/**
            * Sanitised the input data
            */
            function sanitise_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            //Set variables
            $query = sanitise_input($_POST["query"]);
            $order = sanitise_input($_POST["order"]);

            // Import settings
            require_once("settings.php");
            $conn = @mysqli_connect(
            	$host,
                $user,
                $pwd,
                $sql_db
            );

            // Checks if connection is successful
            if (!$conn) {
            	// Displays an error message
            	echo "<p>Database connection failure</p>";
            }
            else {
            	// Upon successful connection
            	$sql_table = "attempts";

                // define search conditions
                $conditions = "";
                if ($query != "") {
                    $conditions .= " WHERE (`studentid` LIKE '%" . $query . "%') OR (`firstname` LIKE '%" . $query . "%') OR (`lastname` LIKE '%" . $query . "%')";
                }
                // oder the table by a specific field
                if ($order != "") {
                    $order = " ORDER BY " . $order;
                }

                // Set up the SQL command to add the data into the table
                $queryToDB = "SELECT * FROM $sql_table" . $conditions . $order;
                // execute the query and store result into the result pointer
                $result = mysqli_query($conn, $queryToDB);

            	//check if the query was successful
            	if (!$result) {
            		echo "<p>Something is wrong with " , $queryToDB, "</p>";
            	}
            	else {
                    if ($result->num_rows > 0) {
            			echo "<h2 class='quizalign'>RECORD OF ALL QUIZ ATTEMPTS</h2>\n";
            			echo "<table class=centeralign>\n";
                        echo "<tr>\n"
                        . "<th scope =\"col\">ATTEMPT ID</th>\n"
                        . "<th scope =\"col\">DATE & TIME</th>\n"
                        . "<th scope =\"col\">STUDENT ID</th>\n"
                        . "<th scope =\"col\">FIRST NAME</th>\n"
                        . "<th scope =\"col\">LAST NAME</th>\n"
                        . "<th scope =\"col\">ATTEMPT</th>\n"
                        . "<th scope =\"col\">SCORE</th>\n"
                        . "</tr>\n";

                        // Display the result
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>\n";
                            echo "<td>",$row["attempt_id"],"</td>\n";
                            echo "<td>",$row["date_time"],"</td>\n";
                            echo "<td>",$row["studentid"],"</td>\n";
                            echo "<td>",$row["firstname"],"</td>\n";
                            echo "<td>",$row["lastname"],"</td>\n";
                            echo "<td>",$row["attempt"],"</td>\n";
                            echo "<td>",$row["score"],"</td>\n";
                            echo "</tr>\n";
                        }
                        echo "</table>\n";
            		}
                    else {
                        echo "<br><br><p class='quizalign'>No records found for '$query' . Please try again</p>";
                    }
                    //free memory after displaying result
                   mysqli_free_result($result);
                }
                //close database
                mysqli_close($conn);
            }
        }
	}

	?>

	<!--Delete all attempts for a particular student (given a student id).-->
	<br>
	<form method="POST" action="manage.php">
		<fieldset class="quiz">
			<legend class='quizalign'>DELETE ALL ATTEMPTS OF A STUDENT</legend>
			<br><br>
			<p class='quizalign'>
                <label>Student ID: </label>
				<input type="input" name="studentid" id="studentid" placeholder="Enter Student ID"/>
				<br><br>
                <input type="submit" name="delete" value="DELETE"/>
			</p>
		</fieldset>
	</form>

	<?php
	// Check if this for was submitted
	if (!empty($_POST["delete"])) {
		// Import settings and connect to database
		require_once("settings.php");
        $conn = @mysqli_connect(
            $host,
            $user,
            $pwd,
            $sql_db
        );

        if (!$conn) {
            //display an error message
            echo "<p>Database connection failure</p>";
        }
        else {
            // Successful connection 
            // Set table
            $sql_table = "attempts";
            $studentid = trim(stripslashes(htmlspecialchars($_POST["studentid"])));
            if ($studentid =="") {
            	echo "<br><br><p class='quizalign'>'Please enter a Student ID'</p><br><br>";
            }
            else {
            	// SQL command
                $query = "DELETE FROM $sql_table WHERE studentid='$studentid'";

                // store the result in a result pointer
                $result = mysqli_query($conn, $query);

                //check if the query was successful
                if (!$result) {
                    echo "<br><br><p class='quizalign'>Something is wrong with " , $query , "</p><br><br>";
                }
                else {
            	    echo "<br><br><p class='quizalign'>Successfully deleted " . @mysqli_affected_rows($conn) . " record(s)</p><br><br>";
            	    // Close database connection
            	    @mysqli_close($conn);
            }
            }
        }
    }
    ?>
    
    <!--Change the score for a quiz attempt (given a student id).-->
    <br>
	<form method="POST" action="manage.php">
		<fieldset class="quiz">
			<legend class='quizalign'>MODIFY QUIZ ATTEMPT SCORE OF A STUDENT</legend>
			<br><br>
			<p class='quizalign'>
                <label>Student ID: </label>
				<input type="input" name="studentid" id="studentid" placeholder="Enter Student ID"/>
			</p>
			<p class='quizalign'>
                <label>Attempt Number: </label>
				<select name="attempt" id="attempt">
					<option value="">Select Attempt</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
			</p>
			<p class='quizalign'>
                <label>New Score: </label>
				<select name="newscore" id="newscore">
					<option value="">Select Score</option>
					<option value="2">2</option>
					<option value="4">4</option>
					<option value="6">6</option>
					<option value="4">8</option>
					<option value="6">10</option>
				</select>
			</p>
			<p class='quizalign'>
				<input type="submit" name="modify" value="MODIFY"/>
			</p>
		</fieldset>
	</form>

	<?php
	// Check if this for was submitted
	if (!empty($_POST["modify"])) {
		// Import settings and connect to database
		require_once("settings.php");
        $conn = @mysqli_connect(
            $host,
            $user,
            $pwd,
            $sql_db
        );

        if (!$conn) {
            //display an error message
            echo "<p>Database connection failure</p>";
        }
        else {
            // Successful connection 
            // Set table
            $sql_table = "attempts";
            $studentid = trim(stripslashes(htmlspecialchars($_POST["studentid"])));
            $attempt = trim(stripslashes(htmlspecialchars($_POST["attempt"])));
            $newscore = trim(stripslashes(htmlspecialchars($_POST["newscore"])));
            if (($studentid =="")||($attempt =="")||($newscore =="")) {
            	echo "<br><br><p class='quizalign'>'Please fill in the required fields'</p><br>";
            }
            else {
            	// SQL command
                $query = "UPDATE $sql_table SET score='$newscore' WHERE studentid='$studentid' AND attempt='$attempt'";

                // store the result in a result pointer
                $result = mysqli_query($conn, $query);

                //check if the query was successful
                if (!$result) {
                    echo "<br><br><p class='quizalign'>Something is wrong with " , $query , "</p><br><br>";
                }
                else {
            	    echo "<br><br><p class='quizalign'>Successfully deleted " . @mysqli_affected_rows($conn) . " record(s)</p><br><br>";
            	    // Close database connection
            	    @mysqli_close($conn);
            }
            }
        }
    }
    ?>

    <!--
    - List all students (id, first and last name) who got 100% on their first attempt.
    - List all students (id, first and last name) got less than 50% on their third attempt.-->
	<?php
        require_once("settings.php");
        $conn = @mysqli_connect(
            $host,
            $user,
            $pwd,
            $sql_db
        );

        if (!$conn) {
            //display an error message
            echo "<p>Database connection failure</p>";
        } 
        else {
            // successful connection 
            //Set table
            $sql_table = "attempts";

            // SQL command
            $first_attempt = "SELECT firstname, lastname, studentid FROM $sql_table WHERE attempt ='1' AND score ='10'";

            // store the result in a result pointer
            $result = mysqli_query($conn, $first_attempt);

            //check if the query was successful
            if (!$result) {
                echo "<p>Something is wrong with " , $all_attempts, "</p>";
            } 
            else {
                // create a table to display the result
                echo "<h2 class='quizalign'>LIST OF ALL STUDENTS WHO SCORED 100% ON FIRST ATTEMPT</h2>\n";
                echo "<table class=centeralign>\n";
                echo "<tr>\n"
                . "<th scope =\"col\">STUDENT ID</th>\n"
                . "<th scope =\"col\">FIRST NAME</th>\n"
                . "<th scope =\"col\">LAST NAME</th>\n"
                . "</tr>\n";

                // Display the result
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>",$row["studentid"],"</td>\n";
                    echo "<td>",$row["firstname"],"</td>\n";
                    echo "<td>",$row["lastname"],"</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";

                //free memory after displaying result
                mysqli_free_result($result);
            }

            $third_attempt = "SELECT firstname, lastname, studentid FROM $sql_table WHERE attempt ='3' AND score < 5";

            // store the result in a result pointer
            $result = mysqli_query($conn, $third_attempt);

            //check if the query was successful
            if (!$result) {
                echo "<p>Something is wrong with " , $all_attempts, "</p>";
            } 
            else {
                // create a table to display the result
                echo "<h2 class='quizalign'>LIST OF ALL STUDENTS WHO SCORED LESS THAN 50% ON THIRD ATTEMPT</h2>\n";
                echo "<table class=centeralign>\n";
                echo "<tr>\n"
                . "<th scope =\"col\">STUDENT ID</th>\n"
                . "<th scope =\"col\">FIRST NAME</th>\n"
                . "<th scope =\"col\">LAST NAME</th>\n"
                . "</tr>\n";

                // Display the result
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "<td>",$row["studentid"],"</td>\n";
                    echo "<td>",$row["firstname"],"</td>\n";
                    echo "<td>",$row["lastname"],"</td>\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";

                //free memory after displaying result
                mysqli_free_result($result);
            }
            //close database
            mysqli_close($conn);
        }
    ?>

    <br><br>
	<?php include 'footer.inc';?>

</body>
</html>
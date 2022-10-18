/**
* Author: Rhyanna Arisya 103698709
* Target: quiz.html and result.html
* Purpose: This file is to vaildate, store, and display the data a user has entered into the form
* Created: 16th May 2021
* Last updated: 23rd May 2021
* Credits: Week 5 lecture slides, Week 7 lecture slides, Week 7 Lab exercises instructions
**/

"use strict";  //prevents creation of global variables in functions

//to store data into local storage for record
function saveResult(firstname,lastname,studentid,score){
	if(typeof(Storage)!=="undefined"){
		localStorage.setItem("firstname", firstname);
		localStorage.setItem("lastname", lastname);
		localStorage.setItem("studentid", studentid);
		localStorage.setItem("score", score);
	}
}

//used for result.html to display results
function getResult(){
	if(typeof(Storage)!=="undefined"){
		if (localStorage.getItem("studentid") !== null) {
			var firstname = document.getElementById("firstname");
			firstname.textContent = localStorage.getItem("firstname");
			var lastname = document.getElementById("lastname");
			lastname.textContent = localStorage.getItem("lastname");
			var studentid = document.getElementById("studentid");
			studentid.textContent = localStorage.getItem("studentid");
			var attempt= document.getElementById("attempt");
			attempt.value = localStorage.getItem("attempt");
			var score= document.getElementById("score");
			score.value = localStorage.getItem("score");

			if(attempt.value==3) { // hide the "MAKE ANOTHER ATTEMPT" button if attempt has reached 3
				document.getElementById("attemptbtn").style.display = "none";
			}
			
		}	
	}
}

//to check if questions are answered and if answers are correct or not
function validate() {
	var errMsg="";
	var result=true;
	var score=0;
	var attempt=0;
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
    var studentid = document.getElementById("studentid").value;
    var q1 = document.getElementById("question1").value;
    var isStuarthaber = document.getElementById("stuarthaber").checked;
	var isSatoshinakamoto = document.getElementById("satoshinakamoto").checked;
	var isLukeconway = document.getElementById("lukeconway").checked;
	var isWscottstornetta = document.getElementById("wscottstornetta").checked;
	var isICO = document.getElementById("ico").checked;
	var isPercent = document.getElementById("percent").checked;
	var isCountries = document.getElementById("countries").checked;
	var isEthereum = document.getElementById("ethereum").checked;
	var q4 = document.getElementById("question4").value;
	var q5 = document.getElementById("question5").value;

	if ((studentid == localStorage.getItem("studentid")) && (localStorage.getItem("attempt")==3)) {
		alert("You have reached the maximum number of attempts!");
		result=false;
	}
	
	//Checks question 1
	if (q1 == "") { //checks if answer is empty
		errMsg += "Question 1: Please provide an answer.\n";
		result = false;
	}
	else if (q1.includes("decentralised" || "immutable ledger")) { //checks if answer includes "decentralised" or "ïmmutable ledger"
		score += 2;
	}

	//Checks question 2
	if (!(isStuarthaber || isSatoshinakamoto || isLukeconway || isWscottstornetta)) { //checks if any of the checkboxes are selected
		errMsg += "Question 2: Please select at least one name.\n";
		result = false;
	}
	else if ((isStuarthaber && isWscottstornetta) && !(isSatoshinakamoto) && !(isLukeconway)) { //checks if the "stuarthaber" and "wscottstornetta" checkboxes are checked
		score += 2;
	}

	//Checks question 3
	if (!(isICO || isPercent || isCountries || isEthereum)) { //checks if any of the radio buttons are selected
		errMsg += "Question 3: Please select one statement.\n";
		result = false;
	}
	else if (isPercent) { //checks if the "percent" radio button is checked
		score += 2;
	}

	//Checks question 4
	if (q4 == "") { //checks if answer is empty
		errMsg += "Question 4: Please select one statement.\n";
		result = false;
	}
	else if (q4 == "more efficient, reliable, stable, and cost-effective") { //checks if answer given by user is equal to the correct answer
		score += 2;
	}

	//Checks question 5
	if (q5 == "") { //checks if answer is empty
		errMsg += "Question 5: Please enter a number.\n";
		result = false;
	}
	else if (!q5.match(/^\d+$/)) { //checks if answer is a number
		errMsg += "Question 5: Please enter a valid number.\n";
		result = false;
	}
	else if (q5 < 1) { //checks if answer is less than 1
		errMsg += "Question 5: Number must be 1 or more.\n";
		result = false;
	}
	else if (q5 > 5) { //checks if answer is more than 5
		errMsg += "Question 5: Number must be 5 or less.\n";
		result = false;
	}
	else if (q5 == 2) { //checks if answer given by user is equal to 5
		score += 2;
	}


    //  display error message and return
	if (errMsg != "") {
		alert (errMsg);
	}
	else if (score == 0) { //display error message when score is zero
		alert ("Score is zero :(");
		result = false;
	}
	else {
		countattempt(attempt,score,studentid,result);
		saveResult(firstname,lastname,studentid,score);
	}
	return result;
}

//Checks if the studentid is stored in localStorage and the attempt count
function countattempt(attempt,score,studentid,result) {
	if (studentid != localStorage.getItem("studentid")) {
		var attempt1 = score;   //Store first score value as attempt1
		attempt+=1;
		localStorage.setItem("attempt", attempt);
		localStorage.setItem("attempt1", attempt1);
		alert("Attempt 1");
	}
	else if ((studentid == localStorage.getItem("studentid")) && (localStorage.getItem("attempt")==1)) {
		var attempt2 = score;   //Store second score value as attempt2
		attempt+=2;
		localStorage.setItem("attempt", attempt);
		localStorage.setItem("attempt2", attempt2);
		alert("Attempt 2");
	}
	else if ((studentid == localStorage.getItem("studentid")) && (localStorage.getItem("attempt")==2)) {
		var attempt3 = score;   //Store third score value as attempt3
		attempt+=3;
		localStorage.setItem("attempt", attempt);
		localStorage.setItem("attempt3", attempt3);
		alert("Attempt 3");
	}
	return result;
}

function init() {
	if (document.getElementById("quizPage")) {  // quiz page init
		document.getElementById("quizForm").onsubmit = validate;
	
	}
	else if (document.getElementById("resultPage")) { // result page init
		getResult();		
	}
}
window.onload = init;  

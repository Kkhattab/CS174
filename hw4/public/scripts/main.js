function validateDataEntry(){
	var textArea = document.getElementById("dataEntry").value;
	var lines = textArea.split("\n");
	var numOfLines = lines.length;
	if(numOfLines > 50) { // validates max 50 lines in textarea
		alert("Too many (> 50 lines) lines! You have " + numOfLines + " number of lines.");
		return;
	}
	var valid = false;
	var error = "";
	for(var i = 0; i < numOfLines; i++){
		if (lines[i].length > 80) { // validates max 80 char per line
			alert("Too many (> 80) characters on line " + i + ": " + lines[i] + ".");
			return;
		}
		var line_arr = lines[i].split(",");
		if (line_arr.length != 3) { // validates 3 values per line
			alert("Invalid number of values on line " + i + ".");
			return;
		}
		if (line_arr[0] === "") { // validates first value of each line
			alert("First value cannot be empty/blank on line " + i + ".");
			return;
		}
	}
	document.getElementById("chartForm").setAttribute("method", "post"); // sets form to send as post
	document.getElementById("chartForm").submit();
}
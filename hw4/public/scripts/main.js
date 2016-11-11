function validateDataEntry() {

    var textArea = document.getElementById("dataEntry").value;
    var lines = textArea.split("\n");
    var numOfLines = lines.length;

    if (numOfLines > 50) { // validates max 50 lines in textarea
        alert("Too many (> 50 lines) lines! You have " + numOfLines + " number of lines.");
        return;
    }
    var valid = false;
    var error = "";
   
    for (var i = 0; i < numOfLines; i++) {
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
        // Except the first element in array, all values should be numbers
        for(var j = 1; j < line_arr.length; j++) {
        	//http://php.net/manual/en/function.is-nan.php
            if(isNaN(line_arr[j])) {
                alert("Every plot values should be numbers except labels.\n"
                    + "Line: " + i + " Column: " + j + " is not a number!");
                return;
            }
        }
    }
    
    // Unnecessary we can simply write this into the html code
    //document.getElementById("chartForm").setAttribute("method", "post"); // sets form to send as post
    
    document.getElementById("chartForm").submit();
}
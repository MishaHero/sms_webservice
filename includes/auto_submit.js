// window.onload = function() {
//     // Onload event of Javascript
//     // Initializing timer variable
//     var x = 20;
//     var y = document.getElementById("timer");
//     // Display count down for 20s
//     setInterval(function() {
//     if (x <= 21 && x >= 1) {
//     x--;
//     y.innerHTML = '' + x + '';
//     if (x == 1) {
//     x = 21;
//     }
//     }
//     }, 1000);
//     // Form Submitting after 20s
//     var auto_refresh = setInterval(function() {
//     submitform();
//     }, 20000);
//     // Form submit function
//     function submitform() {
//     if (validate()) // Calling validate function
//     {
//     alert('Form is submitting.....');
//     document.getElementById("webform").submit();

//     }
//     alert('Form is not submitting.....');
//     }
//     // To validate form fields before submission
//     function validate() {
//     // Storing Field Values in variables
//     var phoneNr = document.getElementById("ToAddress").value;
//     var message = document.getElementById("Message").value;
//     // Regular Expression For Email
    
//     // Conditions
//     if (phoneNr != '' && message != '') {
  
//     if (phoneNr.length == 12) {
//     return true;
//     } else {
//     alert("The Contact No. must be at least 10 digit long!");
//     return false;
//     }
    
//     } else {
//     alert("All fields are required.....!");
//     return false;
//     }
//     }
//     };

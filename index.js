function validate(){
    var email = document.getElementById("inputEmail").value;
    var password = document.getElementById("inputPassword").value;
    var firstName = document.getElementById("inputFirstName").value;
    var lastName = document.getElementById("inputLastName").value;
    var college = document.getElementById("inputCollege").value;
    var major = document.getElementById("inputMajor").value;
    var at = email.indexOf("@");
    var dot = email.lastIndexOf(".");

    if((at < 1) || (dot < (at+2)) || ((dot+2) >= email.length)){
        alert("Please enter a valid email address");
        return false;
    }
    if(password.length < 1){
        alert("Please enter your password");
        return false;
    }
    if(firstName.length < 1){
        alert("Please enter your first name");
        return false;
    }
    if(lastName.length < 1){
        alert("Please enter your last name");
        return false;
    }
    if(college.length < 1){
        alert("Please enter your college name");
        return false;
    }
    if(major.length < 1){
        alert("Please enter your major");
        return false;
    }
}
function validateLogin(){
    var email = document.getElementById("inputEmail").value;
    var password = document.getElementById("inputPassword").value;
    var at = email.indexOf("@");
    var dot = email.lastIndexOf(".");

    if((at < 1) || (dot < (at+2)) || ((dot+2) >= email.length)){
        alert("Please enter a valid email address");
        return false;
    }
    if(password.length < 1){
        alert("Please enter your password");
        return false;
    }
}
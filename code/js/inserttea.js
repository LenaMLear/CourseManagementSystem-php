function validateForm() {
  var id = document.forms["insert"]["id"].value;
  var name = document.forms["insert"]["name"].value;
  var password = document.forms["insert"]["password"].value;
  var major = document.forms["insert"]["major"].value;
  var email = document.forms["insert"]["email"].value;

  var isValid = true;
  var errorMessages = [];

  if (id.trim() === "") {
    errorMessages.push("Instructor ID is required");
    isValid = false;
  }

  if (name.trim() === "") {
    errorMessages.push("Instructor Name is required");
    isValid = false;
  }

  if (password.trim() === "") {
    errorMessages.push("Password is required");
    isValid = false;
  }

  if (major.trim() === "") {
    errorMessages.push("Major is required");
    isValid = false;
  }

  // Email validation using regular expression
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email.trim() !== "" && !emailPattern.test(email)) {
    errorMessages.push("Email is not in valid format");
    isValid = false;
  }

  // Display error messages
  var errorContainer = document.getElementById("error-message");
  if (!isValid) {
    errorContainer.innerHTML = errorMessages.join("<br>");
    errorContainer.style.display = "block";
  } else {
    errorContainer.style.display = "none";
  }

  return isValid;
}

function go() {
  var confirmGo = confirm(
    "Do you really want to go to the displaytea.php page?"
  );
  if (confirmGo) window.location = "displaytea.php";
}

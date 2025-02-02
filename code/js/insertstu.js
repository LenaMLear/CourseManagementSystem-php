function validateForm() {
  var inputs = document.querySelectorAll(
    'input[type="text"], input[type="password"], input[type="email"]'
  );
  var isValid = true;
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  inputs.forEach(function (input) {
    if (
      input.value.trim() === "" ||
      (input.type === "email" && !emailPattern.test(input.value))
    ) {
      isValid = false;
    }
  });

  if (!isValid) {
    document.getElementById("warning").style.display = "block";
  } else {
    document.getElementById("warning").style.display = "none";
  }

  return isValid;
}

function go() {
  var confirmGo = confirm(
    "Do you really want to go to the displaytea.php page?"
  );
  if (confirmGo) window.location = "displaytea.php";
}

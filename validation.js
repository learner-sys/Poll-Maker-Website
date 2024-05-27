const form = document.getElementById('form');
const passwordInput = document.getElementById('password');
const lengthP = document.getElementById('length');
const numberP = document.getElementById('number');
const capitalP = document.getElementById('capital');
const specialCharP = document.getElementById('specialChar');
const username = document.getElementById('username');
const Email = document.getElementById('email');
const unAvailable = document.getElementById("unAvailable");
const EmailAvailable = document.getElementById('EmailAvailable');

function checkPass() {
    const password = passwordInput.value;
    if (password.length >= 1) {
        lengthP.style.display = numberP.style.display = capitalP.style.display = specialCharP.style.display = 'block';
    } else {
        lengthP.style.display = numberP.style.display = capitalP.style.display = specialCharP.style.display = 'none';
    }
  // Check password length
    if (password.length >= 8) {
        lengthP.style.color = 'green';
        } else {
        lengthP.style.color = 'red';
    }

  // Check if password contains at least one number
  if (/\d/.test(password)) {
    numberP.style.color = 'green';
  } else {
    numberP.style.color = 'red';
  }

  // Check if password contains at least one capital letter
  if (/[A-Z]/.test(password)) {
    capitalP.style.color = 'green';
  } else {
    capitalP.style.color = 'red';
  }

  // Check if password contains at least one special character
  if (/[!@#$%^&*]/.test(password)) {
    specialCharP.style.color = 'green';
  } else {
    specialCharP.style.color = 'red';
  }
}
function IsAvailableUN() {
  if (username.value == "") {
    unAvailable.style.display = 'none';
    document.getElementById('unAvailableInput').value = "";
    return;
  } else {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      unAvailable.innerHTML = this.responseText;
      if (unAvailable.textContent == "taken") {
        document.getElementById('unAvailableInput').value = "taken";
        unAvailable.style.color = 'red';
      } else {
        document.getElementById('unAvailableInput').value = "";
        unAvailable.style.color = 'green';
      }
    }
    xhttp.open("POST", "check_availabilityun.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("un=" + encodeURIComponent(username.value));
    unAvailable.style.display = 'block';
  }
}
function isAvailableEmail() {
  if (Email.value == "") {
    EmailAvailable.style.display = 'none';
    document.getElementById('EmailAvailableInput').value = "";
    return;
  } else {
    const xhttpemail = new XMLHttpRequest();
    xhttpemail.onload = function() {
      EmailAvailable.innerHTML = this.responseText;
      if (EmailAvailable.textContent == "taken") {
        document.getElementById('EmailAvailableInput').value = "taken";
        EmailAvailable.style.color = 'red';
      } else {
        document.getElementById('EmailAvailableInput').value = "";
        EmailAvailable.style.color = 'green';
      }
    }
    xhttpemail.open("POST", "check_availabilityemail.php");
    xhttpemail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttpemail.send("email=" + encodeURIComponent(Email.value));
    EmailAvailable.style.display = 'block';
  }
}

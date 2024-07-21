let changepass = document.getElementById("changepass");
changepass.addEventListener("submit", (e) => {
  e.preventDefault();
  let cr_pass = document.getElementById("current_password");
  let n_pass = document.getElementById("new_password");
  let c_pass = document.getElementById("confirm_new_password");
  let count = 0;
  let error = document.getElementById("error");
  error.removeAttribute("class");
  let form = new FormData(changepass);
  if (cr_pass.value.trim() == "") {
    cr_pass.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    cr_pass.removeAttribute("style");
    count++;
  }

  if (n_pass.value.trim() == "") {
    n_pass.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    n_pass.removeAttribute("style");
    count++;
  }

  if (c_pass.value.trim() == "") {
    
    c_pass.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    c_pass.removeAttribute("style");
    var reg_pat_password = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    if(c_pass.value.match(reg_pat_password)){
      count++;
    }else{
      c_pass.style.border = "1px solid red";
      error.classList.add("text-red-500");
      error.innerHTML = "password should contain Minimum eight characters, at least one letter, one number and one special character";
    }
    
  }

  if (n_pass.value.trim() != c_pass.value.trim()) {
    n_pass.style.border = "1px solid blue";
    c_pass.style.border = "1px solid blue";
    error.removeAttribute("class");
    error.innerHTML = `<span class='text-blue-500'>Password not matching</span>`;
  } else {
    count++;
  }

  if (count == 4) {
    xhr = new XMLHttpRequest();
    xhr.open("POST", `brain.php?task=changepass`, true);
    xhr.onload = function () {
      if (this.responseText == "passnotmatch") {
        error.classList.add("text-red-500");
        error.innerHTML = "Password not matching";
      } 
      else if (this.responseText == "cr_pass") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter current Passord";
      } 
      else if (this.responseText == "cr_pass_w") {
        Swal.fire("Please enter your old password correctly!", "", "error");
      }
      else if (this.responseText == "updated") {
        Swal.fire("Password changed successfully!", "", "success");
      }
       else {
        Swal.fire("Something went wrong!", "", "error");
      }
    };
    xhr.send(form);
  }
});

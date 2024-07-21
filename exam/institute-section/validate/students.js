let student = document.getElementById("student");
student.addEventListener("submit", (e) => {
  e.preventDefault();
  let inp = document.querySelectorAll(".with-border");
  let form = new FormData(student);
  let fname = document.getElementById("fname");
  let mname = document.getElementById("mname");
  let lname = document.getElementById("lname");
  let email = document.getElementById("email");
  let dob = document.getElementById("dob");
  let dept = document.getElementById("dept");
  let year = document.getElementById("year");
  let sem = document.getElementById("sem");
  let exnum = document.getElementById("exnum");
  let pass = document.getElementById("pass");
  let cpass = document.getElementById("cpass");
  let error = document.getElementById("error");
  let dept_box = document.getElementById("dept_box");
  let year_box = document.getElementById("year_box");
  let sem_box = document.getElementById("sem_box");
  let count = 0;
  error.innerHTML = "";
  if (fname.value.trim() == "") {
    fname.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    fname.removeAttribute("style");
    count++;
  }

  if (lname.value.trim() == "") {
    lname.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    lname.removeAttribute("style");
    count++;
  }

  if (mname.value.trim() == "") {
    mname.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    mname.removeAttribute("style");
    count++;
  }

  if (email.value.trim() == "") {
    email.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    email.removeAttribute("style");
    count++;
  }

  if (dob.value.trim() == "") {
    dob.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    dob.removeAttribute("style");
    count++;
  }

  if (form.get("dept") == null) {
    dept_box.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    dept_box.removeAttribute("style");
    count++;
  }

  if (form.get("year") == null) {
    year_box.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    year_box.removeAttribute("style");
    count++;
  }

  if (form.get("sem") == null) {
    sem_box.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    sem_box.removeAttribute("style");
    count++;
  }

  if (exnum.value.trim() == "") {
    exnum.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    exnum.removeAttribute("style");
    count++;
  }

  if (pass.value.trim() == "") {
    pass.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    pass.removeAttribute("style");
    count++;
  }
  if (cpass.value.trim() == "") {
    cpass.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    cpass.removeAttribute("style");
    count++;
  }

  if (pass.value.trim() != cpass.value.trim()) {
    pass.style.border = "1px solid blue";
    cpass.style.border = "1px solid blue";
    error.removeAttribute("class");
    error.innerHTML = "Please enter all details";
    error.innerHTML = `<span class='text-blue-500'>Password not matching</span>`;
  } else {
    count++;
  }
  if (count == 12) {
    xhr = new XMLHttpRequest();
    xhr.open("POST", `brain.php?task=student`, true);
    xhr.onload = function () {
      if (this.responseText == "passnotmatch") {
        error.classList.add("text-red-500");
        error.innerHTML = "Password not matching";
      } 
      else if (this.responseText == "fname") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter First name";
      } 
      else if (this.responseText == "mname") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter Middle name";
      } 
      else if (this.responseText == "lname") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter last name";
      } 
      else if (this.responseText == "email") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter Email";
      } 
      else if (this.responseText == "dept") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please Choose Department";
      } 
      else if (this.responseText == "year") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please Choose year";
      } 
      else if (this.responseText == "sem") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter semister";
      } 
      else if (this.responseText == "examnum") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter Exam Number";
      } 
      else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "Student with this Exam number already exists";
        Swal.fire("Student with this Exam number already exists!", "", "warning");
      } 
      else if (this.responseText == "inserted") {
        Swal.fire("Student Added successfully!", "", "success");
      } else {
        Swal.fire("Something went wrong!", "", "error");
      }
    };
    xhr.send(form);
  }
});

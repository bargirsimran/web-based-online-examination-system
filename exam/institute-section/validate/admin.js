let admin = document.getElementById("admin");
admin.addEventListener("submit", (e) => {
  e.preventDefault();
  let form = new FormData(admin);
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let email = document.getElementById("email");
  let pass = document.getElementById("pass");
  let cpass = document.getElementById("cpass");
  let error = document.getElementById("error");
  error.removeAttribute("class");
  let count = 0;
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
  if (email.value.trim() == "") {
    email.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    email.removeAttribute("style");
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
    pass.removeAttribute("style");
    count++;
  }
  if (pass.value.trim() != cpass.value.trim()) {
    pass.style.border = "1px solid blue";
    cpass.style.border = "1px solid blue";
    error.removeAttribute("class");
    error.innerHTML = "Please enter all details";
    error.innerHTML = `<span class='text-red-500'>Please enter all Details , </span><span class='text-blue-500'>Password not matching</span>`;
  } else {
    count++;
  }

  if (count == 6) {
    xhr = new XMLHttpRequest();
    xhr.open("POST", `brain.php?task=admin`, true);
    xhr.onload = function () {
      if (this.responseText == "passnotmatch") {
        error.classList.add("text-red-500");
        error.innerHTML = "Password not matching";
      } else if (this.responseText == "email") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter email";
      } else if (this.responseText == "fname") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter First name";
      } else if (this.responseText == "lname") {
        error.classList.add("text-red-500");
        error.innerHTML = "Please enter last name";
      } else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "Admin with this email already exists";
      } else if (this.responseText == "inserted") {
        Swal.fire("Admin Added successfully!", "", "success");
        setTimeout(()=>{
           window.location.reload();
        },1000)
      } else {
        Swal.fire("Something went wrong!", "", "error");
      }
    };
    xhr.send(form);
  }
});

function delete_admin(id) {
  Swal.fire({
    title: "Do you want delete this Admin?",
    showCancelButton: true,
    confirmButtonText: "Delete",
  }).then((result) => {
    let tr = document.getElementById(id);
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("GET", `brain.php?task=admin_delete&id=${id}`, true);
      xhr.onload = function () {
        if (this.responseText == "deleted") {
          tr.remove();
          Swal.fire("deleted!", "", "success");
        } else {
          Swal.fire("Something went wrong", "", "error");
        }
      };
      xhr.send();
    }
  });
}

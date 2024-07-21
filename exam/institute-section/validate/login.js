let login_form = document.getElementById("login_form");
login_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let username = document.getElementById("username");
  let password = document.getElementById("password");
  let errorbox = document.getElementById("error_box");
  username.style.border = "";
  password.style.border = "";
  errorbox.innerHTML = "";

  if (username.value != "" && password.value != "") {
    xhr = new XMLHttpRequest();
    let form = new FormData(login_form);
    xhr.open("POST", "logincheck.php", true);
    //this is after complition
    xhr.onload = function () {
      if (this.responseText == "success") {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Login successful',
          showConfirmButton: false,
          timer: 2000
        })
        setTimeout(() => {
          window.location.href = "index.php";
        }, 2000);
      } else if (this.responseText == "wrong") {
        Swal.fire({
          title: "Error!",
          text: "Please Enter Correct Credentials",
          icon: "error",
          confirmButtonText: "Ok, Retry",
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: "Something went wrong",
          icon: "error",
          confirmButtonText: "Ok, Retry",
        });
      }
    };

    xhr.send(form);
  } else {
    Swal.fire({
      title: "Error!",
      text: "Please Enter Credentials",
      icon: "error",
      confirmButtonText: "Ok",
    });
    username.style.border = "1px solid red";
    password.style.border = "1px solid red";
  }
});

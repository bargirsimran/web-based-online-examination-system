const info = ["", "", ""];
let count = 0;
let dept = document.getElementById("dept");
let dept_box = document.getElementById("dept_box");
dept.addEventListener("change", () => {
  info[0] = dept.value;
  getSubOption(info);
});
let year = document.getElementById("year");
let year_box = document.getElementById("year_box");
year.addEventListener("change", () => {
  info[1] = year.value;
  getSubOption(info);
});
let sem = document.getElementById("sem");
let sem_box = document.getElementById("sem_box");
sem.addEventListener("change", () => {
  info[2] = sem.value;
  getSubOption(info);
});

// function to fetch options
let sub = document.getElementById("subject");
function getSubOption(data) {
  xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `brain.php?task=subjectop&d=${data[0]}&y=${data[1]}&s=${data[2]}`,
    true
  );
  xhr.onload = function () {
    sub.innerHTML = this.responseText;
    if (this.responseText == "") {
      sub.innerHTML = `<option selected disabled>Choose subject</option>`;
    }
  };
  xhr.send();
}


let subject = document.getElementById("subject");
let total = document.getElementById("total");
let wrong = document.getElementById("wrong");
let time = document.getElementById("time");
let title = document.getElementById("title");
let new_test = document.getElementById("new_test");
let error = document.getElementById("error");
// let subjective = document.getElementById("subjective");
// let submark = document.getElementById("submark");

new_test.addEventListener("submit", (e) => {
  e.preventDefault();
  let form = new FormData(new_test);
  error.innerHTML = "";
  error.removeAttribute("class");
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

  if (form.get("subject") == null) {
    subject.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    subject.removeAttribute("style");
    count++;
  }

  if (form.get("title").trim() == "") {
    title.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    title.removeAttribute("style");
    count++;
  }

  if (form.get("total").trim() == "") {
    total.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    total.removeAttribute("style");
    count++;
  }

  if (form.get("right").trim() == "") {
    right.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    right.removeAttribute("style");
    count++;
  }

  if (form.get("wrong").trim() == "") {
    wrong.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    wrong.removeAttribute("style");
    count++;
  }

  if (form.get("time").trim() == "") {
    time.style.border = "1px solid red";
    error.classList.add("text-red-500");
    error.innerHTML = "Please enter all details";
  } else {
    time.removeAttribute("style");
    count++;
  }
  // if (form.get("subjective").trim() == "") {
  //   subjective.style.border = "1px solid red";
  //   error.classList.add("text-red-500");
  //   error.innerHTML = "Please enter all details";
  // } else {
  //   subjective.removeAttribute("style");
  //   count++;
  // }
  // if (form.get("submark").trim() == "") {
  //   submark.style.border = "1px solid red";
  //   error.classList.add("text-red-500");
  //   error.innerHTML = "Please enter all details";
  // } else {
  //   submark.removeAttribute("style");
  //   count++;
  // }
  console.log(count);
  if (count == 9) {
    xhr = new XMLHttpRequest();
    xhr.open("POST", `update.php?task=new_test`, true);
    xhr.onload = function () {
      let data = JSON.parse(this.responseText);
      if (data.msg == "success") {
        Swal.fire({
          title: "Test Created successfully please wait... redirecting",
          width: 600,
          padding: "3em",
          color: "#716add",
          backdrop: `
            rgba(0,0,123,0.4)
            url("https://sweetalert2.github.io/images/nyan-cat.gif")
            left top
            no-repeat
          `,
        });
        setTimeout(() => {
          window.location.href = `testdetails.php?test_id=${data.test_id}&task=question`;
        }, 2000);
      }else{
        Swal.fire({
          icon: 'error',
          text: 'Something went wrong!',
        })
      }
    };
    xhr.send(form);
  } else {
  }
});

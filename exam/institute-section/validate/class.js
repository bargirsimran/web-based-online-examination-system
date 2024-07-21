let year = document.getElementById("year");
year.addEventListener("submit", (e) => {
  e.preventDefault();
  let error = document.getElementById("error");
  let class_year = document.getElementById("class_year").value;
  error.innerHTML = "";
  error.removeAttribute("class");
  if (class_year.trim() != "") {
    xhr = new XMLHttpRequest();
    let form = new FormData(year);
    xhr.open("POST", "brain.php?task=class_year", true);
    xhr.onload = function () {
      if (this.responseText == "inserted") {
        error.classList.add("text-green-500");
        error.innerHTML = "Class year Added successfully";
        let dlist = document.getElementById("dlist");
        div = document.createElement("div");
        div.innerHTML = ` <div class="flex items-center px-5 py-3">
                             <ion-icon name="chevron-forward-circle" class="text-2xl mr-2 md hydrated" role="img" aria-label="play outline"></ion-icon> ${class_year}
                          </div>`;
        dlist.appendChild(div);
      } else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "Class year already exists";
      }
    };
    xhr.send(form);
  } else {
    error.classList.add("text-red-500");
    error.innerHTML = "Plese enter class year";
  }
});

function delete_year(id) {
    Swal.fire({
      title: "Do you want delete this Year?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      let tr = document.getElementById(id);
      if (result.isConfirmed) {
        xhr = new XMLHttpRequest();
        xhr.open("GET", `brain.php?task=year_delete&id=${id}`, true);
        xhr.onload = function () {
          if (this.responseText == "deleted") {
            tr.remove();
            Swal.fire("deleted!", "", "success");
          }else{
            Swal.fire("Something went wrong", "", "error");
          }
        };
        xhr.send();
      }
    });
  }



let sem = document.getElementById("sem");
sem.addEventListener("submit", (e) => {
  e.preventDefault();
  let error = document.getElementById("error_sem");
  let semester = document.getElementById("semester").value;
  error.innerHTML = "";
  error.removeAttribute("class");
  if (semester != "") {
    xhr = new XMLHttpRequest();
    let form = new FormData(sem);
    xhr.open("POST", "brain.php?task=semester", true);
    xhr.onload = function () {
      if (this.responseText == "inserted") {
        error.classList.add("text-green-500");
        error.innerHTML = "semester Added successfully";
        let dlist = document.getElementById("dlist_s");
        div = document.createElement("div");
        div.innerHTML = ` <div class="flex items-center px-5 py-3">
                             <ion-icon name="chevron-forward-circle" class="text-2xl mr-2 md hydrated" role="img" aria-label="play outline"></ion-icon> ${semester}
                          </div>`;
        dlist.appendChild(div);
      } else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "semester already exists";
      }
    };
    xhr.send(form);
  } else {
    error.classList.add("text-red-500");
    error.innerHTML = "Plese enter semester";
  }
});
  

function delete_sem(id) {
  Swal.fire({
    title: "Do you want delete this semester?",
    showCancelButton: true,
    confirmButtonText: "Delete",
  }).then((result) => {
    let tr = document.getElementById(id);
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("GET", `brain.php?task=sem_delete&id=${id}`, true);
      xhr.onload = function () {
        if (this.responseText == "deleted") {
          tr.remove();
          Swal.fire("deleted!", "", "success");
        }else{
          Swal.fire("Something went wrong", "", "error");
        }
      };
      xhr.send();
    }
  });
}

let division = document.getElementById("division");
division.addEventListener("submit", (e) => {
  e.preventDefault();
  let error = document.getElementById("error_div");
  let div = document.getElementById("div").value;
  error.innerHTML = "";
  error.removeAttribute("class");
  if (semester != "") {
    xhr = new XMLHttpRequest();
    let form = new FormData(division);
    xhr.open("POST", "brain.php?task=divisions", true);
    xhr.onload = function () {
      if (this.responseText == "inserted") {
        error.classList.add("text-green-500");
        error.innerHTML = "Division Added successfully";
        let dlist = document.getElementById("dlist_d");
        divs = document.createElement("div");
        divs.innerHTML = ` <div class="flex items-center px-5 py-3">
                             <ion-icon name="chevron-forward-circle" class="text-2xl mr-2 md hydrated" role="img" aria-label="play outline"></ion-icon> ${div}
                          </div>`;
        dlist.appendChild(divs);
      } else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "Division already exists";
      }
    };
    xhr.send(form);
  } else {
    error.classList.add("text-red-500");
    error.innerHTML = "Plese enter Division";
  }
});

function delete_div(id) {
  Swal.fire({
    title: "Do you want delete this Division?",
    showCancelButton: true,
    confirmButtonText: "Delete",
  }).then((result) => {
    let tr = document.getElementById(id);
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("GET", `brain.php?task=div_delete&id=${id}`, true);
      xhr.onload = function () {
        if (this.responseText == "deleted") {
          tr.remove();
          Swal.fire("deleted!", "", "success");
        }else{
          Swal.fire("Something went wrong", "", "error");
        }
      };
      xhr.send();
    }
  });
}


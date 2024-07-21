let dept = document.getElementById("dept");
dept.addEventListener("submit", (e) => {
  e.preventDefault();
  let error = document.getElementById("error");
  let department = document.getElementById("department").value;
  error.innerHTML = "";
  error.removeAttribute("class");
  if (department.trim() != "") {
    xhr = new XMLHttpRequest();
    let form = new FormData(dept);
    xhr.open("POST", "brain.php?task=department", true);
    xhr.onload = function () {
      if (this.responseText == "inserted") {
        error.classList.add("text-green-500");
        error.innerHTML = "Department Name Added successfully";
        let dlist = document.getElementById("dlist");
        div = document.createElement("div");
        div.innerHTML = ` <div class="flex items-center px-5 py-3">
                             <ion-icon name="chevron-forward-circle" class="text-2xl mr-2 md hydrated" role="img" aria-label="play outline"></ion-icon> ${department}
                          </div>`;
        dlist.appendChild(div);
      } else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "Department Name already exists";
      }
    };
    xhr.send(form);
  } else {
    error.classList.add("text-red-500");
    error.innerHTML = "Plese enter Department name";
  }
});

function delete_dep(id) {
  Swal.fire({
    title: "Do you want delete this Department?",
    showCancelButton: true,
    confirmButtonText: "Delete",
  }).then((result) => {
    let tr = document.getElementById(id);
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("GET", `brain.php?task=department_delete&id=${id}`, true);
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

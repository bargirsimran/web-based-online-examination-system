let grp = document.getElementById("grp");
grp.addEventListener("submit", (e) => {
  e.preventDefault();
  let error = document.getElementById("error");
  let form = new FormData(grp);
  error.innerHTML = "";
  error.removeAttribute("class");
  if (form.get("department").trim() != null && form.get("year").trim() != null && form.get("sem").trim()!= null && form.get("group").trim() !="") {
    xhr = new XMLHttpRequest();
    xhr.open("POST", "brain.php?task=group", true);
    xhr.onload = function () {
      if (this.responseText == "inserted") {
        error.classList.add("text-green-500");
        error.innerHTML = "Group created successfully";
        let dlist = document.getElementById("dlist_d");
      } else if (this.responseText == "exists") {
        error.classList.add("text-blue-500");
        error.innerHTML = "Group already exists";
      }
    };
    xhr.send(form);
  } else {
    error.classList.add("text-red-500");
    error.innerHTML = "Plese enter all Details";
  }
});

function delete_sub(id) {
    Swal.fire({
      title: "Do you want delete this Group?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      let tr = document.getElementById(id);
      if (result.isConfirmed) {
        xhr = new XMLHttpRequest();
        xhr.open("GET", `brain.php?task=group_delete&id=${id}`, true);
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
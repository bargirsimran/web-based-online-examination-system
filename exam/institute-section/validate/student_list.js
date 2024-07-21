function delete_std(id) {
    Swal.fire({
      title: "Do you want delete this Student?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      let tr = document.getElementById(id);
      if (result.isConfirmed) {
        xhr = new XMLHttpRequest();
        xhr.open("GET", `brain.php?task=student_delete&id=${id}`, true);
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
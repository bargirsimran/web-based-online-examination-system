const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});

let assign = document.getElementById("assign");
let cancle = document.getElementById("cn");
assign.addEventListener("submit", (e) => {
  e.preventDefault();
  let tid = assign.getAttribute("dataset");
  let form = new FormData(assign);
  xhr = new XMLHttpRequest();
  xhr.open("POST", `brain.php?task=asssign_group&test_id=${tid}`, true);
  xhr.onload = function () {
    if (this.responseText == "updated") {
      cancle.click();
      Toast.fire({
        icon: "success",
        title: "Group assigned to test successfully",
      });
    } else {
      cancle.click();
      Toast.fire({
        icon: "error",
        title: "Something went wrong",
      });
    }
  };
  xhr.send(form);
});

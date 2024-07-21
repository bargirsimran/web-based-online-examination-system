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

st_grp = document.getElementById("grp_std_add");
st_grp.addEventListener("submit", (e) => {
  let url = st_grp.getAttribute("action");
  e.preventDefault();
  let form = new FormData(st_grp);
  xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.onload = function () {
    if (this.responseText == "updated") {
      Toast.fire({
        icon: "success",
        title: "Members Added successfully",
      });
    } else {
      Toast.fire({
        icon: "error",
        title: "Please select students",
      });
    }
  };
  xhr.send(form);
});

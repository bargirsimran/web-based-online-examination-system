var Toaster = Swal.mixin({
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
  

function disable(id) {
  Swal.fire({
    title: "Do you want to Disable this Test?",
    showCancelButton: true,
    confirmButtonText: "Disable",
  }).then((result) => {
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("POST", `update.php?test_id=${id}&task=disable`, true);
      xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        if (data.msg == "disabled") {
          let dv = document.getElementById("en-db-" + id);
          dv.innerHTML = `<div class="text-center"><span onclick="enable('${id}')" class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Enable</span></div>`;
          Toaster.fire({
            icon: "success",
            title: "Disabled successfully",
          });
        }
      };
      xhr.send();
    }
  });
}

function enable(id) {
  Swal.fire({
    title: "Do you want to Enable this Test?",
    showCancelButton: true,
    confirmButtonText: "Enable",
  }).then((result) => {
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("POST", `update.php?test_id=${id}&task=enable`, true);
      xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        if (data.msg == "enabled") {
          Toaster.fire({
            icon: "success",
            title: "Enabled successfully",
          });
          let dv = document.getElementById("en-db-" + id);
          dv.innerHTML = `<div class="text-center"><span onclick="disable('${id}')" class="text-yellow-500 bg-transparent border border-solid border-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Disable</span></div>`;
        }
      };
      xhr.send();
    }
  });
}

function remove(id) {
  Swal.fire({
    title: "Do you want to Remove this Test?",
    showCancelButton: true,
    confirmButtonText: "Remove",
  }).then((result) => {
    if (result.isConfirmed) {
      xhr = new XMLHttpRequest();
      xhr.open("POST", `update.php?test_id=${id}&task=remove`, true);
      xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        if (data.msg == "removed") {
          let dv = document.getElementById(id);
          dv.remove();
          Toaster.fire({
            icon: "success",
            title: "Removed successfully",
          });

        }
      };
      xhr.send();
    }
  });
}

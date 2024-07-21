let test = document.getElementById("test_edit");
let tid = test.getAttribute("data-t");
let qid = test.getAttribute("data-q");
let url = test.getAttribute("action");

function erroralert() {
  Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Please enter All Details",
  });
}

test.addEventListener("submit", (e) => {
  e.preventDefault();
  let count = 0;
  let q = document.getElementById("q_box");
  let q_val = tinymce.get("qns").getContent();
  let op1 = document.getElementById("op1");
  let op1val = op1.value;
  let op2 = document.getElementById("op2");
  let op2val = op2.value;
  let op3 = document.getElementById("op3");
  let op3val = op3.value;
  let op4 = document.getElementById("op4");
  let op4val = op4.value;

  let ans = document.getElementById("ans");
  let ansbox = document.getElementById("ans_box");
  let ansval = ans.value;
  let opb = document.getElementById("opb");

  if (q_val.trim() == "") {
    q.style.border = "1.5px solid red";
    erroralert();
  } else {
    q.removeAttribute("style");
    count++;
  }

  if (op1val.trim() == "") {
    op1.style.border = "1.5px solid red";
    opb.style.border = "1.5px solid red";
    erroralert();
  } else {
    op1.removeAttribute("style");
    opb.removeAttribute("style");
    count++;
  }
  if (op2val.trim() == "") {
    op2.style.border = "1.5px solid red";
    opb.style.border = "1.5px solid red";
    erroralert();
  } else {
    op2.removeAttribute("style");
    opb.removeAttribute("style");
    count++;
  }
  if (op3val.trim() == "") {
    op3.style.border = "1.5px solid red";
    opb.style.border = "1.5px solid red";
    erroralert();
  } else {
    op3.removeAttribute("style");
    opb.removeAttribute("style");
    count++;
  }
  if (op4val.trim() == "") {
    op4.style.border = "1.5px solid red";
    opb.style.border = "1.5px solid red";
    erroralert();
  } else {
    op4.removeAttribute("style");
    opb.removeAttribute("style");
    count++;
  }

  if (ansval.trim() == "") {
    ansbox.style.border = "1.5px solid red";
    opb.style.border = "1.5px solid red";
    erroralert();
  } else {
    ansbox.removeAttribute("style");
    opb.removeAttribute("style");
    count++;
  }
  if (count == 6) {
    tinymce.triggerSave();
    let form = new FormData(test);
    xhr = new XMLHttpRequest();
    xhr.open("POST", `${url}`, true);
    xhr.onload = function () {
      let data = JSON.parse(this.responseText);
      if (data.msg == "success") {
        Swal.fire({
          icon: "success",
          title: "Question updated Successfully",
          text: "",
        });
        setTimeout(() => {
           window.location.href = `testdetails.php?test_id=${data.test_id}&task=view`;
        }, 2000);
      } else {
        Swal.fire({
          icon: "error",
          text: "Something went wrong!",
        });
      }
    };
    xhr.send(form);
  }
});

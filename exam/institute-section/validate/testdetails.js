let test = document.getElementById("test");
let n = test.getAttribute("data-set");
let url = test.getAttribute("action");
console.log(url);
function erroralert() {
  Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Please enter all question, options and answers",
  });
}
test.addEventListener("submit", (e) => {
  e.preventDefault();
  let count = 0;
  let i;
  for (i = 1; i <= n; i++) {
    let q = document.getElementById("q_box-" + i);
    let q_val = tinymce.get("qns-" + i).getContent();
    let op1 = document.getElementById("op" + i + "1");
    let op1val = op1.value;
    let op2 = document.getElementById("op" + i + "2");
    let op2val = op2.value;
    let op3 = document.getElementById("op" + i + "3");
    let op3val = op3.value;
    let op4 = document.getElementById("op" + i + "4");
    let op4val = op4.value;

    let ans = document.getElementById("ans" + i);
    let ansbox = document.getElementById("ans_box" + i);
    let ansval = ans.value;
    let opb = document.getElementById("opb-" + i);
    // console.log(q_val)
    // console.log(op1val)
    // console.log(op2val)
    // console.log(op3val)
    // console.log(op4val)
    // console.log(ansval)

    if (q_val == "") {
      q.style.border = "1.5px solid red";
      erroralert();
    } else {
      q.removeAttribute("style");
      count++;
    }

    if (op1val == "") {
      op1.style.border = "1.5px solid red";
      opb.style.border = "1.5px solid red";
      erroralert();
    } else {
      op1.removeAttribute("style");
      opb.removeAttribute("style");
      count++;
    }
    if (op2val == "") {
      op2.style.border = "1.5px solid red";
      opb.style.border = "1.5px solid red";
      erroralert();
    } else {
      op2.removeAttribute("style");
      opb.removeAttribute("style");
      count++;
    }
    if (op3val == "") {
      op3.style.border = "1.5px solid red";
      opb.style.border = "1.5px solid red";
      erroralert();
    } else {
      op3.removeAttribute("style");
      opb.removeAttribute("style");
      count++;
    }
    if (op4val == "") {
      op4.style.border = "1.5px solid red";
      opb.style.border = "1.5px solid red";
      erroralert();
    } else {
      op4.removeAttribute("style");
      opb.removeAttribute("style");
      count++;
    }

    if (ansval == "") {
      ansbox.style.border = "1.5px solid red";
      opb.style.border = "1.5px solid red";
      erroralert();
    } else {
      ansbox.removeAttribute("style");
      opb.removeAttribute("style");
      count++;
    }
  }

  if (count == n * 6) {
    tinymce.triggerSave();
    let form = new FormData(test);
    xhr = new XMLHttpRequest();
    xhr.open("POST", `${url}`, true);
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

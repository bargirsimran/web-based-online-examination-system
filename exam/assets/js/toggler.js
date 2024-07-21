let mc = document.getElementById("main_cont");
let addq = document.getElementById("addq");
let editt = document.getElementById("editt");
let addqbox = document.getElementById("addqbox");
let c_addqbox = document.getElementById("c_addqbox");
let c_edittbox = document.getElementById("c_edittbox");
addq.addEventListener("click",(e)=>{
    e.preventDefault();
    mc.classList.toggle("hider");
    addqbox.classList.toggle("hider");

})
c_addqbox.addEventListener("click",(e)=>{
    e.preventDefault();
    mc.classList.toggle("hider");
    addqbox.classList.toggle("hider");

})
editt.addEventListener("click",(e)=>{
    e.preventDefault();
    mc.classList.toggle("hider");
    edittbox.classList.toggle("hider");

})
c_edittbox.addEventListener("click",(e)=>{
    e.preventDefault();
    mc.classList.toggle("hider");
    edittbox.classList.toggle("hider");

})

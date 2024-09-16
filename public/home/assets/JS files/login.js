let log = document.querySelector(".log");
let sign = document.querySelector(".sign");
let link = document.querySelector(".link");
link.onclick = function(e){
    e.preventDefault();
    sign.style.display= "block";
    log.style.display = "none"
}
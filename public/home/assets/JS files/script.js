// nav-bar-items-active
var navbarItems = document.querySelector(".navbar-items ");

var a = navbarItems.querySelectorAll("a");

for (var i = 0; i < a.length; i++) {
  a[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("item-active");
    current[0].className = current[0].className.replace("item-active", "");
    this.className += "item-active";
  });
}

// heart-icon
var icon = document.getElementsByClassName("heart-icon");
for (let i = 0; i < icon.length; i++) {
  icon[i].addEventListener("click", function () {
    icon[i].classList.remove("fa-regular");
    icon[i].classList.add("fa-solid");
    icon[i].style.color = "red";
    icon[i].style.backgroundColor = "#eee";
  });
}

// for navbar
function changeBg() {
  var navbar = document.querySelector(".navbar");
  var scrollValue = window.scrollY;
  if (scrollValue < 100) {
    navbar.classList.remove("bgChange");
  } else {
    navbar.classList.add("bgChange");
  }
}
window.addEventListener("scroll", changeBg);

// for counting
let valueDisplay = document.querySelectorAll(".counter");
let interval = 5000;
valueDisplay.forEach((value) => {
  let start = 0;
  let end = parseInt(value.getAttribute("data-target"));
  let duration = Math.floor(interval / end);
  let counter = setInterval(function () {
    start += 1;
    value.textContent = start;
    if (start == end) {
      clearInterval(counter);
    }
  }, duration);
});

// for carousel
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    prevEl: ".swiper-button-next",
    nextEl: ".swiper-button-prev",
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  },
});

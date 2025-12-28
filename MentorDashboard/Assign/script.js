
var Mentor = document.getElementById("");
var test = document.getElementById("test");

function handleRegisterTextHover() {
  if (Mentor.style.opacity === "0") {
    test.style.opacity = "1";
  } else {
    test.style.opacity = "0";
  }
}

Mentor.addEventListener("mouseenter", function() {
  handleRegisterTextHover();
});

Mentor.addEventListener("mouseleave", function() {
  handleRegisterTextHover();
});
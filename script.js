const navbar = document.querySelector(".navbar");
        
window.addEventListener("scroll", () => {
    if (window.scrollY === 0) {
        navbar.classList.remove("hidden");
    } else {
        navbar.classList.add("hidden");
    }
});
document.addEventListener("mousemove", (event) => {
    if (event.clientY < 150) { 
        navbar.classList.remove("hidden");
    }
});
window.addEventListener("scroll", function () {
    var navbar = document.querySelector(".navbar"); 
    if (window.scrollY > 300) { 
        navbar.classList.add("scrolled"); 
    } else {
        navbar.classList.remove("scrolled"); 
    }
});


const el = document.getElementById("logo");
const height = el.clientHeight;
const width = el.clientWidth;

el.style.transition = "transform 0.2s ease-out";

el.addEventListener("mousemove", (e) => {
    const xVal = e.layerX;
    const yVal = e.layerY;
    const yRotation = 50 * ((xVal - width / 2) / width);
    const xRotation = -50 * ((yVal - height / 2) / height);
    const string = `perspective(500px) scale(1.1) rotateX(${xRotation}deg) rotateY(${yRotation}deg)`;
    el.style.transform = string;
});

el.addEventListener("mouseleave", () => {
    el.style.transform = "perspective(500px) scale(1)";
});

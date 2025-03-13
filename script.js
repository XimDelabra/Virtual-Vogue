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
    if (window.scrollY > 400) { 
        navbar.classList.add("scrolled"); 
    } else {
        navbar.classList.remove("scrolled"); 
    }
});

function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}
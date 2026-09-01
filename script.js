let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
};

const typed = new Typed('.multiple-text', {
    strings: [
        'frontend developer',
        'backend developer',
        'blockchain developer',
        'web designer',
        'youtuber'
    ],
    typeSpeed: 80,
    backSpeed: 80,
    backDelay: 1200,
    loop: true
});

// TESTIMONIAL SLIDESHOW

const wrapper = document.querySelector(".wrapper");
const items = document.querySelectorAll(".testimonial-item");

const nextBtn = document.querySelector(".next-btn");
const prevBtn = document.querySelector(".prev-btn");

const dots = document.querySelectorAll(".dot");

let currentIndex = 0;

// Show slide
function showSlide(index) {

    if (index >= items.length) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = items.length - 1;
    } else {
        currentIndex = index;
    }

    wrapper.style.transform = `translateX(-${currentIndex * 100}%)`;

    // Update dots
    dots.forEach(dot => dot.classList.remove("active"));
    dots[currentIndex].classList.add("active");
}

// Next button
nextBtn.addEventListener("click", () => {
    showSlide(currentIndex + 1);
});

// Previous button
prevBtn.addEventListener("click", () => {
    showSlide(currentIndex - 1);
});

// Dots click
dots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
        showSlide(index);
    });
});

// Automatic slideshow
setInterval(() => {
    showSlide(currentIndex + 1);
}, 5000);
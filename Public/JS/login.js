function showRegister() {
    document.getElementById("loginForm").style.opacity = 0;
    setTimeout(() => {
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("registerForm").style.display = "block";
        setTimeout(() => document.getElementById("registerForm").style.opacity = 1, 50);
    }, 200);
}

function showLogin() {
    document.getElementById("registerForm").style.opacity = 0;
    setTimeout(() => {
        document.getElementById("registerForm").style.display = "none";
        document.getElementById("loginForm").style.display = "block";
        setTimeout(() => document.getElementById("loginForm").style.opacity = 1, 50);
    }, 200);
}

const images = [
    ["/public/PIC/CR7.jpg", "/public/PIC/inter.jpg"],
    ["/public/PIC/spiderman.jpg", "/public/PIC/dbz.jpg"]
];

let index = 0;

setInterval(() => {
    index = (index + 1) % images.length;

    const left = document.querySelector(".bg-left");
    const right = document.querySelector(".bg-right");

    left.style.backgroundImage = `url('${images[index][0]}')`;
    right.style.backgroundImage = `url('${images[index][1]}')`;

}, 4000);
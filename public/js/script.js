document.addEventListener("DOMContentLoaded", function () {
    gsap.from(".login-section", { duration: 1, y: -50, opacity: 0, ease: "power3.out" });
    gsap.from(".login-form input, .login-form button", {
        duration: 0.6,
        opacity: 0,
        y: 30,
        stagger: 0.2,
        ease: "back.out(1.7)"
    });
});

/*===== go to top ===========*/
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("return-to-top");

    window.addEventListener("scroll", function () {
        if (window.scrollY >= 100) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    });

    btn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
    // Smooth scroll for anchor links with header offset
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#' && targetId.length > 1) {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    const navHeight = document.querySelector('.navbar-custom')?.offsetHeight || 90;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - navHeight - 20;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });

                    // Focus on first input if clicking into a form
                    const firstInput = targetElement.querySelector('input:not([type="hidden"]), textarea');
                    if (firstInput) {
                        setTimeout(() => firstInput.focus(), 600);
                    }
                }
            }
        });
    });
});


/* ----- AOS ----- */
AOS.init({
    easing: 'ease-out-back',
    duration: 1000
});
/* ---------- reveal on scroll ---------- */
// let io;
// function observeReveals(){
//   if (io) io.disconnect();
//   io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting){ e.target.classList.add("in"); io.unobserve(e.target); } }), {threshold:.12});
//   document.querySelectorAll(".page.current .rv:not(.in)").forEach(el => io.observe(el));
// }
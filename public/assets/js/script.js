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
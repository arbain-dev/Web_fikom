// Progress form sederhana
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formDaftar");
    if (!form) return; // Guard clause

    const req = Array.from(form.querySelectorAll(".req"));
    const bar = document.getElementById("progressBar");
    const pct = document.getElementById("progressPct");
    const toast = document.getElementById("toastOk");

    function calc() {
        let filled = 0;
        req.forEach(el => {
            const val = (el.value || "").toString().trim();
            if (val !== "") filled++;
        });
        const percent = Math.round((filled / req.length) * 100);

        if (bar) bar.style.width = percent + "%";
        if (pct) pct.textContent = percent + "%";
        if (toast) toast.style.display = percent === 100 ? "block" : "none";
    }

    form.addEventListener("input", calc);
    form.addEventListener("change", calc);
    calc();

    // Validasi NIK numeric
    const nikInput = form.querySelector('input[name="nik"]');
    if (nikInput) {
        nikInput.addEventListener("input", (e) => {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 16);
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".count-up");

    counters.forEach((counter) => {
        const target = +counter.getAttribute("data-value");
        let current = 0;
        const speed = 50; // smaller = faster

        const updateCount = () => {
            const increment = Math.ceil(target / 40); // 40 steps approx

            if (current < target) {
                current += increment;
                counter.innerText = current > target ? target : current;
                setTimeout(updateCount, speed);
            } else {
                counter.innerText = target;
            }
        };

        updateCount();
    });
});

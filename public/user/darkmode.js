tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                },
                secondary: {
                    50: "#f0fdfa",
                    100: "#ccfbf1",
                    200: "#99f6e4",
                    300: "#5eead4",
                    400: "#2dd4bf",
                    500: "#14b8a6",
                },
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
            },
        },
    },
};

document.addEventListener("DOMContentLoaded", function () {
    const savedTheme =
        localStorage.getItem("theme") ||
        (window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light");

    if (savedTheme === "dark") {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }

    const darkModeToggle = document.getElementById("darkModeToggle");

    darkModeToggle.addEventListener("click", function () {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("theme", "light");
        } else {
            document.documentElement.classList.add("dark");
            localStorage.setItem("theme", "dark");
        }
    });

    const mobileMenuButton = document.getElementById("mobileMenuButton");
    const mobileMenu = document.getElementById("mobileMenu");

    mobileMenuButton.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });

    const mobileMenuLinks = mobileMenu.querySelectorAll("a");
    mobileMenuLinks.forEach((link) => {
        link.addEventListener("click", function () {
            mobileMenu.classList.add("hidden");
        });
    });

    const backToTopButton = document.getElementById("backToTop");

    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove("opacity-0");
            backToTopButton.classList.add("opacity-100");
        } else {
            backToTopButton.classList.remove("opacity-100");
            backToTopButton.classList.add("opacity-0");
        }
    });

    backToTopButton.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });

    // createPieChart();
    // createDonutChart();
    // createLineChart();

    const animateOnScroll = function () {
        const elements = document.querySelectorAll(".animate-on-scroll");

        elements.forEach((element) => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementPosition < windowHeight - 50) {
                element.classList.add("fadeIn");
            }
        });
    };

    animateOnScroll();

    window.addEventListener("scroll", animateOnScroll);
});

// function createPieChart() {
//     const ctx = document.getElementById("pieChart");

//     if (!ctx) return;

//     new Chart(ctx, {
//         type: "pie",
//         data: {
//             labels: [
//                 "Islam",
//                 "Kristen/Protestan",
//                 "Katolik",
//                 "Hindu",
//                 "Buddha",
//                 "Konghucu",
//             ],
//             datasets: [
//                 {
//                     data: [86.7, 7.6, 3.1, 1.7, 0.8, 0.1],
//                     backgroundColor: [
//                         "#22c55e", // Green
//                         "#3b82f6", // Blue
//                         "#6366f1", // Indigo
//                         "#a855f7", // Purple
//                         "#eab308", // Yellow
//                         "#ef4444", // Red
//                     ],
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             plugins: {
//                 legend: {
//                     position: "right",
//                     labels: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "#f3f4f6"
//                             : "#374151",
//                     },
//                 },
//             },
//         },
//     });
// }

// function createDonutChart() {
//     const ctx = document.getElementById("donutChart");

//     if (!ctx) return;

//     new Chart(ctx, {
//         type: "doughnut",
//         data: {
//             labels: [
//                 "Haji (35%)",
//                 "Pendidikan (30%)",
//                 "Nikah (20%)",
//                 "Wakaf (10%)",
//                 "Lainnya (5%)",
//             ],
//             datasets: [
//                 {
//                     data: [35, 30, 20, 10, 5],
//                     backgroundColor: [
//                         "#22c55e", // Green
//                         "#8b5cf6", // Purple
//                         "#ec4899", // Pink
//                         "#f97316", // Orange
//                         "#3b82f6", // Blue
//                     ],
//                     borderWidth: 1,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             cutout: "70%",
//             plugins: {
//                 legend: {
//                     position: "bottom",
//                     labels: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "#f3f4f6"
//                             : "#374151",
//                     },
//                 },
//             },
//         },
//     });
// }

// function createLineChart() {
//     const ctx = document.getElementById("lineChart");

//     if (!ctx) return;

//     new Chart(ctx, {
//         type: "line",
//         data: {
//             labels: ["2019", "2020", "2021", "2022", "2023"],
//             datasets: [
//                 {
//                     label: "Haji & Umrah",
//                     data: [450000, 100000, 200000, 450000, 554124],
//                     borderColor: "#22c55e",
//                     backgroundColor: "rgba(34, 197, 94, 0.1)",
//                     tension: 0.3,
//                     fill: true,
//                 },
//                 {
//                     label: "Pernikahan",
//                     data: [180000, 175000, 195000, 210000, 221000],
//                     borderColor: "#ec4899",
//                     backgroundColor: "rgba(236, 72, 153, 0.1)",
//                     tension: 0.3,
//                     fill: true,
//                 },
//                 {
//                     label: "Pendidikan",
//                     data: [1400000, 1450000, 1500000, 1550000, 1650000],
//                     borderColor: "#8b5cf6",
//                     backgroundColor: "rgba(139, 92, 246, 0.1)",
//                     tension: 0.3,
//                     fill: true,
//                 },
//                 {
//                     label: "Wakaf",
//                     data: [65000, 68000, 72000, 78000, 82400],
//                     borderColor: "#f97316",
//                     backgroundColor: "rgba(249, 115, 22, 0.1)",
//                     tension: 0.3,
//                     fill: true,
//                 },
//             ],
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             scales: {
//                 y: {
//                     beginAtZero: true,
//                     grid: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "rgba(255, 255, 255, 0.1)"
//                             : "rgba(0, 0, 0, 0.1)",
//                     },
//                     ticks: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "#f3f4f6"
//                             : "#374151",
//                     },
//                 },
//                 x: {
//                     grid: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "rgba(255, 255, 255, 0.1)"
//                             : "rgba(0, 0, 0, 0.1)",
//                     },
//                     ticks: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "#f3f4f6"
//                             : "#374151",
//                     },
//                 },
//             },
//             plugins: {
//                 legend: {
//                     position: "bottom",
//                     labels: {
//                         color: document.documentElement.classList.contains(
//                             "dark"
//                         )
//                             ? "#f3f4f6"
//                             : "#374151",
//                     },
//                 },
//             },
//         },
//     });
// }

// document
//     .getElementById("darkModeToggle")
//     .addEventListener("click", function () {
//         setTimeout(() => {
//             Chart.getChart("pieChart")?.destroy();
//             Chart.getChart("donutChart")?.destroy();
//             Chart.getChart("lineChart")?.destroy();

//             // createPieChart();
//             createDonutChart();
//             createLineChart();
//         }, 50);
//     });

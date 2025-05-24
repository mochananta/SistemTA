document.addEventListener("DOMContentLoaded", function () {
    const { donutLabels, donutSeries, lineLabels, lineSurat, lineKonsultasi } = window.chartData;

    const colorPalette = [
        "#3B82F6", "#6366F1", "#60A5FA", "#10B981", "#34D399",
        "#059669", "#F59E0B", "#EF4444", "#8B5CF6", "#14B8A6"
    ];

    const capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1);

    const getFilteredData = (type) => {
        if (type === "all") {
            return {
                labels: donutLabels,
                series: donutSeries,
            };
        }

        const filtered = donutLabels
            .map((label, index) => ({ label, index }))
            .filter((item) =>
                item.label.toLowerCase().startsWith(capitalize(type).toLowerCase())
            );

        return {
            labels: filtered.map((i) => i.label),
            series: filtered.map((i) => donutSeries[i.index]),
        };
    };

    let donutChart;
    let lastDonutType = "all";

    function renderDonut(type = "all") {
        lastDonutType = type;
        const data = getFilteredData(type);
        const prefersDark = document.documentElement.classList.contains("dark");

        if (donutChart) donutChart.destroy();

        const optionsDonut = {
            series: data.series,
            chart: {
                type: "donut",
                height: 300,
                fontFamily: "inherit",
                foreColor: prefersDark ? "#E5E7EB" : "#374151",
            },
            labels: data.labels,
            colors: colorPalette.slice(0, data.labels.length),
            legend: {
                position: "bottom",
                labels: {
                    colors: prefersDark ? "#E5E7EB" : "#374151",
                },
            },
            dataLabels: {
                style: {
                    fontSize: "10px",
                    colors: Array(data.labels.length).fill(
                        prefersDark ? "#FFFFFFFF" : "#FFFFFFFF"
                    ),
                },
            },
            tooltip: {
                theme: prefersDark ? "dark" : "light",
            },
        };

        donutChart = new ApexCharts(
            document.querySelector("#donutChart"),
            optionsDonut
        );
        donutChart.render();
    }

    let lineChart;

    function renderLineChart() {
        const prefersDark = document.documentElement.classList.contains("dark");

        const optionsLine = {
            series: [
                { name: "Pengajuan Surat", data: lineSurat },
                { name: "Konsultasi", data: lineKonsultasi },
            ],
            chart: {
                type: "line",
                height: 300,
                zoom: { enabled: false },
                fontFamily: "inherit",
            },
            dataLabels: { enabled: false },
            stroke: { curve: "smooth" },
            xaxis: {
                categories: lineLabels,
                labels: {
                    style: {
                        colors: Array(lineLabels.length).fill(
                            prefersDark ? "#E5E7EB" : "#5C5959FF"
                        ),
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: prefersDark ? "#E5E7EB" : "#5C5959FF",
                    },
                },
            },
            colors: ["#6366F1", "#F59E0B"],
            tooltip: {
                theme: prefersDark ? "dark" : "light",
            },
            legend: {
                labels: {
                    colors: prefersDark ? "#E5E7EB" : "#5C5959FF",
                },
            },
        };

        const lineElement = document.querySelector("#lineChart");
        if (lineElement) {
            if (lineChart) {
                lineChart.destroy();
            }
            lineChart = new ApexCharts(lineElement, optionsLine);
            lineChart.render();
        }
    }

    function observeThemeChange() {
        const targetNode = document.documentElement;
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === "class") {
                    renderDonut(lastDonutType);
                    renderLineChart();
                }
            });
        });

        observer.observe(targetNode, {
            attributes: true,
            attributeFilter: ["class"],
        });
    }

    // Init charts
    renderDonut();
    renderLineChart();
    observeThemeChange();

    // Dropdown toggle
    const toggleButton = document.querySelector("#toggleFilterMenu");
    const filterMenu = document.querySelector("#filterMenu");

    toggleButton.addEventListener("click", () => {
        filterMenu.classList.toggle("hidden");
    });

    // Dropdown item click handler
    document.querySelectorAll("#filterMenu button[data-filter]").forEach((btn) => {
        btn.addEventListener("click", () => {
            const type = btn.getAttribute("data-filter");
            renderDonut(type);
            filterMenu.classList.add("hidden");
        });
    });

    // Click outside to close menu
    document.addEventListener("click", (e) => {
        if (!toggleButton.contains(e.target) && !filterMenu.contains(e.target)) {
            filterMenu.classList.add("hidden");
        }
    });
});

const isDark = document.documentElement.classList.contains('dark');

var optionsDonut = {
    series: [554124, 221000, 1650000, 82400],
    chart: {
        type: "donut",
        height: 300,
    },
    labels: ["Jamaah Haji", "Pernikahan", "Pelajar Madrasah", "Wakaf Tanah"],
    colors: ["#10B981", "#3B82F6", "#8B5CF6", "#F59E0B"],
    legend: {
        position: "bottom",
        labels: {
            colors: isDark ? "#ffffff" : "#000000FF", // putih untuk dark mode, gray-800 untuk light
        }
    },
    dataLabels: {
        style: {
            colors: [isDark ? "#ffffff" : "#FFFFFFFF"], // putih atau hitam tergantung mode
        }
    }
};





var donutChart = new ApexCharts(
    document.querySelector("#donutChart"),
    optionsDonut
);
donutChart.render();

var optionsLine = {
    series: [
        {
            name: "Layanan",
            data: [1200000, 1500000, 1600000, 1800000, 2000000],
        },
    ],
    chart: {
        height: 300,
        type: "line",
        zoom: {
            enabled: false,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
    },
    xaxis: {
        categories: ["2019", "2020", "2021", "2022", "2023"],
    },
    colors: ["#6366F1"],
};

var lineChart = new ApexCharts(
    document.querySelector("#lineChart"),
    optionsLine
);
lineChart.render();

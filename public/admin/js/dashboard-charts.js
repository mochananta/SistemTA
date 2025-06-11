document.addEventListener("DOMContentLoaded", function () {
    if (typeof pengajuanLabels === "undefined") return;

    const ctx = document.getElementById("pengajuanTracker").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: pengajuanLabels,
            datasets: [
                {
                    label: "Pengajuan Masuk",
                    data: pengajuanData,
                    backgroundColor: "#3f51b5",
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});

<div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg">
    <div class="rounded-t mb-0 px-4 py-3 text-black">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full max-w-full flex-grow flex-1 ml-5">
                <h6 class="uppercase mb-1 text-xs font-semibold">Overview</h6>
                <h2 class="text-xl font-semibold">Track of Client Growth and Bookings</h2>
            </div>
        </div>
    </div>
    <div class="p-4 flex-auto flex justify-center items-center">
        <div class="relative" style="height: 400px; width: 100%; max-width: 800px;">
            <canvas id="interest-line-chart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function getMonthLabels() {
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const currentMonth = new Date().getMonth();
        return monthNames.slice(0, currentMonth + 1);
    }

    let clientGrowthData = @json($clientGrowthData);
    let bookingData = @json($bookingData);

    const ctx = document.getElementById('interest-line-chart').getContext('2d');
    
    // Gradient for the area under the line
    const gradientGreen = ctx.createLinearGradient(0, 0, 0, 400);
    gradientGreen.addColorStop(0, 'rgba(76, 175, 80, 0.3)');
    gradientGreen.addColorStop(1, 'rgba(76, 175, 80, 0)');

    const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
    gradientBlue.addColorStop(0, 'rgba(33, 150, 243, 0.3)');
    gradientBlue.addColorStop(1, 'rgba(33, 150, 243, 0)');

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: getMonthLabels(),
            datasets: [
                {
                    label: "Client Growth",
                    data: clientGrowthData,
                    borderColor: "#4CAF50",
                    backgroundColor: gradientGreen,
                    borderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 10,
                    pointBackgroundColor: "#4CAF50",
                    pointHoverBackgroundColor: "#4CAF50",
                    pointHoverBorderWidth: 3,
                    pointHoverBorderColor: "rgba(76, 175, 80, 0.5)",
                    fill: true,
                    tension: 0.4,
                    shadowColor: "rgba(76, 175, 80, 0.5)",
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowOffsetY: 4,
                },
                {
                    label: "Unique Client Bookings",
                    data: bookingData,
                    borderColor: "#2196F3",
                    backgroundColor: gradientBlue,
                    borderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 10,
                    pointBackgroundColor: "#2196F3",
                    pointHoverBackgroundColor: "#2196F3",
                    pointHoverBorderWidth: 3,
                    pointHoverBorderColor: "rgba(33, 150, 243, 0.5)",
                    fill: true,
                    tension: 0.4,
                    shadowColor: "rgba(33, 150, 243, 0.5)",
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowOffsetY: 4,
                }
            ]
        },
        options: {
            responsive: true,
            animation: {
                easing: 'easeInOutBack',
                duration: 1500,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: { size: 12 }
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#333',
                    borderColor: '#ddd',
                    borderWidth: 1,
                    cornerRadius: 6,
                    padding: 14,
                    displayColors: false,
                    shadowOffsetX: 2,
                    shadowOffsetY: 4,
                    shadowBlur: 8,
                    shadowColor: "rgba(0, 0, 0, 0.3)"
                }
            },
            interaction: {
                mode: 'nearest',
                intersect: false,
            },
            scales: {
                x: {
                    grid: {
                        borderDash: [5, 5],
                        color: "rgba(200, 200, 200, 0.2)"
                    },
                    ticks: {
                        color: '#666'
                    }
                },
                y: {
                    grid: {
                        borderDash: [5, 5],
                        color: "rgba(200, 200, 200, 0.2)"
                    },
                    beginAtZero: true,
                    ticks: {
                        color: '#666'
                    }
                }
            }
        }
    });
});
</script>

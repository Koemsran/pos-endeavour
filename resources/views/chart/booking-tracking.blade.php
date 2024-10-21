<div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg">
    <div class="rounded-t mb-0 px-4 py-3 text-black">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full max-w-full flex-grow flex-1">
                <h6 class="uppercase mb-1 text-xs font-semibold">Overview</h6>
                <h2 class="text-xl font-semibold">Track of Client Growth and Bookings</h2>
            </div>
        </div>
    </div>
    <div class="p-4 flex-auto">
        <div class="relative" style="height: 400px;">
            <canvas id="line-chart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to get month names dynamically up to the current month
    function getMonthLabels() {
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const currentMonth = new Date().getMonth(); // Get current month (0-11)
        return monthNames.slice(0, currentMonth + 1); // Slice months up to the current month
    }

    let clientGrowthData = @json($clientGrowthData);
    let bookingData = @json($bookingData);
    
    console.log('Client Growth Data:', clientGrowthData);
    console.log('Booking Data:', bookingData);

    const ctx = document.getElementById('line-chart').getContext('2d');
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: getMonthLabels(),
            datasets: [
                {
                    label: 'Client Growth',
                    data: clientGrowthData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true,
                },
                {
                    label: 'Bookings',
                    data: bookingData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});
</script>

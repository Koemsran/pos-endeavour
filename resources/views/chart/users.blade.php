<div class="flex items-center justify-center">
    <div class="chart-text bg-white p-6 rounded-lg shadow-lg flex items-center justify-center" style="width: 510px; height: 350px; flex-direction: column;">
        <canvas id="visitorChart" style="max-width: 100%; max-height: 100%; padding: 15px;"></canvas>
        <h1 class="text-2xl font-bold mb-4">Users</h1>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pass PHP data to JavaScript
    const adminCount = @json($adminCount);
    const ownerCount = @json($ownerCount);
    const customerCount = @json($customerCount);

    // Prepare data for Chart.js
    const labels = ['Admin', 'Owner', 'Customer'];
    const data = [adminCount, ownerCount, customerCount];
    const totalCount = data.reduce((acc, count) => acc + count, 0);

    // Create the chart
    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#3b82f6', '#14b8a6', '#fb923c'], // Add more colors if needed
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true // Set to true to display the legend
                },
                doughnutCenterText: {
                    text: totalCount + '+'
                }
            },
            cutout: '60%'
        },
        plugins: [{
            id: 'doughnutCenterText',
            beforeDraw: (chart) => {
                const width = chart.width,
                      height = chart.height,
                      ctx = chart.ctx;

                ctx.restore();
                const fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";

                const text = chart.config.options.plugins.doughnutCenterText.text,
                      textX = Math.round((width - ctx.measureText(text).width) / 2),
                      // Add a margin offset to center the text vertically
                      textY = (height / 2) + 10; // Adjust '10' to the desired margin offset

                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        }]
    });
</script>

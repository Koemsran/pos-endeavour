<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg p-6 max-w-3xl">
    <div class="mb-4">
        <h6 class="uppercase text-gray-500 mb-1 text-xs font-semibold">Performance</h6>
        <h2 class="text-gray-700 text-xl font-semibold">Top Countries by Client Progress</h2>
    </div>

    <div class="relative flex justify-center items-center" style="height: 400px;">
        <canvas id="myChart" style="width:100%; max-width:800px;"></canvas>
    </div>

    <script>
        // Fetching the country data from the backend
        const countryNames = @json($countryNames);
        const countryCounts = @json($countryCounts);

        const barColors = [
            "#b91d47", "#00aba9", "#e8c3b9", "#c45850", "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"
        ]; // Dynamic colors

        const chartData = countryCounts.length > 0 ? countryCounts : [1]; // Fallback to show chart when no data
        const chartLabels = countryNames.length > 0 ? countryNames : ["No country data"];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: chartLabels, // Dynamic country names or "No country data"
                datasets: [{
                    backgroundColor: barColors,
                    data: chartData // Dynamic country counts or fallback
                }]
            },
            options: {
                title: {
                    display: true,
                    text: countryNames.length > 0 ? "Top Countries by Client Progress" : "No country data available",
                    fontSize: 18,
                    fontColor: '#333'
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: '#333'
                    }
                }
            }
        });
    </script>
</div>

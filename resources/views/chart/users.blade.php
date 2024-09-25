<div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg p-6 max-w-3xl">
    <div class="mb-4">
        <h6 class="uppercase text-gray-500 mb-1 text-xs font-semibold">Performance</h6>
        <h2 class="text-gray-700 text-xl font-semibold">Client Bookings</h2>
    </div>
    <div class="relative flex justify-center items-center" style="height: 400px;">
        <canvas id="myChart" style="width:100%; max-width:800px;"></canvas>
    </div>
</div>

<script>
    const xValues = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    const yValues = [55, 49, 44, 24, 15];
    const barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "World Wide Wine Production 2018",
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

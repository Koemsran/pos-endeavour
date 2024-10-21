<div
  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg"
  style="padding: 20px; background-color: #f8f9fa;"
>
  <div class="rounded-t px-4 py-3 bg-transparent border-b border-gray-200">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full max-w-full flex-grow flex-1">
        <h6 class="uppercase text-gray-500 mb-1 text-xs font-semibold tracking-wider">
          Performance
        </h6>
        <h2 class="text-gray-700 text-lg font-semibold leading-snug">
          Clients' Paid and Contracts
        </h2>
      </div>
    </div>
  </div>
  <div class="p-4 flex-auto">
    <div class="relative" style="height: 400px;">
      <canvas id="bar-chart"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let config = {
        type: "bar",
        data: {
            labels: [
                "January", "February", "March", "April", "May", "June", 
                "July", "August", "September", "October", "November", "December"
            ],
            datasets: [
                {
                    label: "Clients Paid",
                    backgroundColor: "#4A90E2", // Bright blue for Paid Clients
                    data: {!! json_encode($monthlyPaidClients) !!}, // Monthly paid clients data
                    barThickness: 45,
                },
                {
                    label: "Clients Contract",
                    backgroundColor: "#E94E77", // Contrasting pinkish-red for Contract Clients
                    data: {!! json_encode($monthlyContractClients) !!}, // Monthly contract clients data
                    barThickness: 45,
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            title: {
                display: true,
                text: "Clients: Paid vs Contracts Per Month",
                fontSize: 16,
                fontColor: "#333",
                padding: 20,
            },
            tooltips: {
                mode: "index",
                intersect: false,
                backgroundColor: "#fff",
                titleFontColor: "#333",
                bodyFontColor: "#666",
                borderColor: "#ddd",
                borderWidth: 1,
                xPadding: 10,
                yPadding: 10,
            },
            hover: {
                mode: "nearest",
                intersect: true,
            },
            legend: {
                display: true,
            },
            scales: {
                xAxes: [
                    {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Months",
                            fontSize: 13,
                            fontColor: "#666",
                        },
                        gridLines: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            fontSize: 12,
                            fontColor: "#666",
                            maxTicksLimit: 5,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgba(33, 37, 41, 0.1)",
                        },
                    },
                ],
            },
        },
    };
    let ctx = document.getElementById('bar-chart').getContext('2d');
    new Chart(ctx, config);
});
</script>

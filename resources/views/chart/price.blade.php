<div
  class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded"
>
  <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full max-w-full flex-grow flex-1">
        <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
          Overview
        </h6>
        <h2 class="text-blueGray-700 text-xl font-semibold">
          Sales Value
        </h2>
      </div>
    </div>
  </div>
  <div class="p-4 flex-auto">
    <div class="relative" style="height: 400px;"> <!-- Adjusted height here -->
      <canvas id="line-chart"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let config = {
        type: 'line',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: new Date().getFullYear(),
              backgroundColor: '#4c51bf',
              borderColor: '#4c51bf',
              data: [65, 78, 66, 44, 56, 67, 75],
              fill: false,
            },
            {
              label: new Date().getFullYear() - 1,
              backgroundColor: '#36a2eb',
              borderColor: '#36a2eb',
              data: [40, 68, 86, 74, 56, 60, 87],
              fill: false,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false, // Ensures it respects the container's height
          title: {
            display: false,
            text: 'Sales Chart'
          },
          legend: {
            labels: {
              fontColor: '#333'
            },
            align: 'end',
            position: 'bottom',
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: false,
                labelString: 'Month'
              },
              gridLines: {
                color: 'rgba(33, 37, 41, 0.3)',
              },
              ticks: {
                fontColor: '#333',
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: false,
                labelString: 'Value'
              },
              gridLines: {
                color: 'rgba(33, 37, 41, 0.2)',
              },
              ticks: {
                fontColor: '#333',
              }
            }]
          }
        }
      };
      let ctx = document.getElementById('line-chart').getContext('2d');
      new Chart(ctx, config);
});
</script>

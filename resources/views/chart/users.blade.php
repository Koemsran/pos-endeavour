<div
  class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
>
  <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full max-w-full flex-grow flex-1">
        <h6 class="uppercase text-blueGray-400 mb-1 text-xs font-semibold">
          Performance
        </h6>
        <h2 class="text-blueGray-700 text-xl font-semibold">
          Client Bookings
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
    let ctx = document.getElementById('bar-chart').getContext('2d');
    
    let config = {
        type: 'bar',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: new Date().getFullYear(),
              backgroundColor: '#ed64a6',
              borderColor: '#ed64a6',
              data: [30, 78, 56, 34, 100, 45, 13],
              barThickness: 8,
            },
            {
              label: new Date().getFullYear() - 1,
              backgroundColor: '#4c51bf',
              borderColor: '#4c51bf',
              data: [27, 68, 86, 74, 10, 4, 87],
              barThickness: 8,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          title: {
            display: false,
            text: 'Client Booking Chart'
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          legend: {
            labels: {
              fontColor: '#333'
            },
            align: 'end',
            position: 'bottom',
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
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
                display: true,
                labelString: 'Bookings'
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
      
      new Chart(ctx, config);
});
</script>

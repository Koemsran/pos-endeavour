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
          Client Progress
        </h2>
      </div>
    </div>
  </div>
  <div class="p-4 flex-auto">
    <div class="relative flex justify-center align-items-center" style="height: 400px;">
      <canvas id="pie-chart"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let config = {
        type: 'pie',
        data: {
          labels: [
            "Phone Consultation", 
            "Office Consultation", 
            "Booking", 
            "Contract", 
            "Refund", 
            "In Process", 
            "Paid"
          ],
          datasets: [{
            label: ' ',
            data: [300, 50, 100, 80, 120, 150, 200],  // Updated data array to match the labels count
            backgroundColor: [
              '#ff6384',  // Red
              '#36a2eb',  // Blue
              '#ffce56',  // Yellow
              '#4bc0c0',  // Green
              '#9966ff',  // Purple
              '#ff9f40',  // Orange
              '#c9cbcf'   // Gray
            ],
            hoverBackgroundColor: [
              '#ff6384',
              '#36a2eb',
              '#ffce56',
              '#4bc0c0',
              '#9966ff',
              '#ff9f40',
              '#c9cbcf'
            ]
          }]
        },
        options: {
          responsive: true,
          legend: {
            position: 'bottom',
            labels: {
              fontColor: '#333'
            }
          },
          tooltips: {
            callbacks: {
              label: function(tooltipItem, data) {
                let dataset = data.datasets[tooltipItem.datasetIndex];
                let total = dataset.data.reduce((prev, curr) => prev + curr);
                let currentValue = dataset.data[tooltipItem.index];
                let percentage = ((currentValue / total) * 100).toFixed(2); // Show percentage with two decimal places
                return `${data.labels[tooltipItem.index]}: ${currentValue} (${percentage}%)`;
              }
            }
          }
        }
      };
      let ctx = document.getElementById('pie-chart').getContext('2d');
      new Chart(ctx, config);
});
</script>

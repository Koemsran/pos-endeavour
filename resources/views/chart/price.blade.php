<div class="bg-white p-4 rounded-lg shadow-md mt-8" style="width: 550px; height: 350px;">
  <h2 class="font-bold mb-4 text-2xl">This Week: 300$</h2>
  <div>
    <canvas id="bookingChart"></canvas>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('bookingChart').getContext('2d');
      var bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
          datasets: [{
            label: 'Revenue',
            data: 20,
            backgroundColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 205, 86, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(201, 203, 207, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>
</div>

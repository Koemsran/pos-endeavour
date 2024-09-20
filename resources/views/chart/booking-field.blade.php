<div class="container mx-auto px-6 py-5 bg-white m-5 rounded-lg shadow-md" style="width: 550px; height: 350px;">
  <h1 class="text-2xl font-bold mb-4">Field Booking Frequency</h1>
  <div>
    <canvas id="fieldBookingChart"></canvas>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('fieldBookingChart').getContext('2d');

    // Log weeklyDataField to console for debugging
    var fieldBookingChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
          label: 'Field Booking Frequency',
          data: 20, // Dynamically generate data values
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {
        scales: {
          x: {
            display: true,
            title: {
              display: true,
              text: 'Days of the Week'
            }
          },
          y: {
            display: true,
            title: {
              display: true,
              text: 'Number of Bookings'
            },
            suggestedMin: 0,
            precision: 0,
          }
        }
      }
    });
  });
</script>

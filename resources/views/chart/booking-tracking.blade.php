<div
  class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg"
>
  <div class="rounded-t mb-0 px-4 py-3 text-black">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full max-w-full flex-grow flex-1">
        <h6 class="uppercase mb-1 text-xs font-semibold">
          Overview
        </h6>
        <h2 class="text-xl font-semibold">
          Track of Client Growth and Bookings
        </h2>
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

    let config = {
        type: 'line',
        data: {
          labels: getMonthLabels(),  // Dynamically get month labels
          datasets: [
            {
              label: 'Client Growth (' + new Date().getFullYear() + ')',
              backgroundColor: 'rgba(76, 81, 191, 0.1)',  // Light fill color
              borderColor: '#4c51bf',  // Line color
              pointBackgroundColor: '#4c51bf',  // Point color
              pointBorderColor: '#fff',  // Point border color
              pointHoverBackgroundColor: '#fff',  // Point hover background color
              pointHoverBorderColor: '#4c51bf',  // Point hover border color
              data: clientGrowthData,  // Dynamic client growth data
              fill: true,  // Fill the area below the line
              tension: 0.4,  // Curve the line
            },
            {
              label: 'Booking (' + new Date().getFullYear() + ')',
              backgroundColor: 'rgba(54, 162, 235, 0.1)',  // Light fill color
              borderColor: '#36a2eb',  // Line color
              pointBackgroundColor: '#36a2eb',  // Point color
              pointBorderColor: '#fff',  // Point border color
              pointHoverBackgroundColor: '#fff',  // Point hover background color
              pointHoverBorderColor: '#36a2eb',  // Point hover border color
              data: bookingData,  // Dynamic booking data
              fill: true,  // Fill the area below the line
              tension: 0.4,  // Curve the line
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
              labels: {
                color: 'black',  // Legend text color
                font: {
                  size: 12,  // Adjust legend font size
                  family: 'Arial',  // Font family for the legend
                }
              }
            },
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.7)',  // Dark tooltip background
              titleFont: {
                family: 'Arial',
                size: 14,
                weight: 'bold'
              },
              bodyFont: {
                family: 'Arial',
                size: 12
              },
              padding: 10,  // Increase padding inside the tooltip
            }
          },
          scales: {
            x: {
              grid: {
                display: false,  // Hide x-axis grid lines for a cleaner look
              },
              ticks: {
                color: '#333',  // Darker x-axis label color
                font: {
                  size: 12,  // Adjust font size
                  family: 'Arial',  // Font family for x-axis labels
                }
              }
            },
            y: {
              grid: {
                borderDash: [5, 5],  // Dashed grid lines
                color: 'rgba(0, 0, 0, 0.1)',  // Lighter grid color
              },
              ticks: {
                color: '#333',  // Darker y-axis label color
                font: {
                  size: 12,  // Adjust font size
                  family: 'Arial',  // Font family for y-axis labels
                }
              }
            }
          }
        }
    };

    new Chart(document.getElementById('line-chart'), config);
});
</script>

<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-5">
      <div class="container mx-auto px-6 py-2">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <div>
            <form action="{{ route('admin.progresses.index') }}" method="GET" class="flex items-center mb-4 w-full" id="search-form">
              <input type="number" name="search" placeholder="Search view by step number..."
                class="px-4 py-2 border rounded-l-lg focus:outline-none focus:border-blue-500"
                id="search-input" style="width: auto; max-width: 20%; flex: 1;">
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">
                Search
              </button>
            </form>
          </div>
          <hr>

          <div class="w-full p-5 mt-5">
            <div class="relative flex justify-between items-center mb-8">
              <!-- Steps -->
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Phone Consultation">1</div>
                <span class="mt-2 text-sm">Phone Consultation</span>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Office Consultation">2</div>
                <span class="mt-2 text-sm">Office Consultation</span>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Booking">3</div>
                <span class="mt-2 text-sm">Booking</span>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Contract">4</div>
                <span class="mt-2 text-sm">Contract</span>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Refund">5</div>
                <span class="mt-2 text-sm">Refund</span>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="In Process">6</div>
                <span class="mt-2 text-sm">In Process</span>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Paid">7</div>
                <span class="mt-2 text-sm">Paid</span>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex space-x-4 p-5">
            <button id="start" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Start</button>
            <button id="prev" class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400" disabled>Previous</button>
            <button id="next" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" disabled>Next</button>
          </div>

          <!-- Modal (Popup) -->
          <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded shadow-lg w-96"> <!-- Increased Width -->
              <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Step Information</h2>
                <button id="closeModal" class="text-gray-600 text-3xl hover:text-gray-900">&times;</button> <!-- Close Button -->
              </div>
              <div id="modalContent" class="mb-4"> <!-- Content for each step -->
                <!-- Step information will be injected here -->
              </div>
              <form id="infoForm">
                <div class="mb-4">
                  <label for="info" class="block text-gray-700 text-sm font-bold mb-2">Your Info:</label>
                  <input type="text" id="info" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter some info" required>
                </div>
                <div class="flex justify-end gap-4">
                  <button type="button" id="skip" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Skip</button> <!-- Skip Button -->
                  <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 library -->
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      iconColor: 'white',
      customClass: {
        popup: 'colored-toast',
      },
      showConfirmButton: false,
      timer: 1000,
      timerProgressBar: true,
    });

    const steps = document.querySelectorAll(".step");
    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");
    const startButton = document.getElementById("start");
    const modal = document.getElementById("modal");
    const closeModalButton = document.getElementById("closeModal");
    const infoForm = document.getElementById("infoForm");
    const modalContent = document.getElementById("modalContent");
    const skipButton = document.getElementById("skip");

    let currentStep = 0; // Current step index

    // Show modal when clicking Start button
    startButton.addEventListener("click", () => {
      modal.classList.remove("hidden");
      showStepModal(); // Show the first step modal
    });

    // Close modal
    closeModalButton.addEventListener("click", () => {
      modal.classList.add("hidden");
    });

    // Handle form submission
    infoForm.addEventListener("submit", (e) => {
      e.preventDefault();
      modal.classList.add("hidden"); // Close modal after submit
      infoForm.reset();
      // Show Toast notification
      Toast.fire({
        icon: 'success',
        title: 'Completed successfully!',
      }).then(() => {
        currentStep++; // Move to the next step

        // Hide the Start button and enable Previous/Next buttons after the first step
        if (currentStep === 1) {
          startButton.classList.add("hidden"); // Hide Start button after the first step
          prevButton.disabled = false; // Enable the Previous button
          nextButton.disabled = false; // Enable the Next button
        }

        updateProgress();
        if (currentStep < steps.length) {
          showStepModal(); // Show the next step modal
        } else {
          Toast.fire({
            icon: 'success',
            title: 'All steps completed!',
          });
        }
      });
    });

    // Next button handler
    nextButton.addEventListener("click", () => {
      // No action taken on Next button click until the current step is submitted
      if (currentStep < steps.length - 1) {
        showStepModal(); // Show modal for the next step
      }
    });

    skipButton.addEventListener("click", () => {
      // Move to the next step without submitting the form
      currentStep++;
      modal.classList.add("hidden"); // Close modal
      updateProgress();

      // Enable the Next button only if not at the last step
      nextButton.disabled = currentStep >= steps.length - 1; // Disable Next if at last step

      if (currentStep < steps.length) {
        showStepModal(); // Show modal for the next step
      } else {
        Toast.fire({
          icon: 'success',
          title: 'All steps completed!',
        });
      }
    });
    // Previous button handler
    prevButton.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        updateProgress();
        showStepModal(); // Show modal for the current step
      }
    });

    function updateProgress() {
      steps.forEach((step, index) => {
        // If the step is completed
        if (index < currentStep) {
          step.classList.add("bg-green-500");
          step.classList.remove("bg-gray-300", "bg-blue-500");
          step.innerHTML = "&#10003;"; // Add check icon (HTML code for checkmark)
        }
        // If the current step is active
        else if (index === currentStep) {
          step.classList.add("bg-blue-500");
          step.classList.remove("bg-gray-300", "bg-green-500");
          step.innerHTML = (index + 1).toString(); // Show step number
        }
        // If the step is not yet reached
        else {
          step.classList.add("bg-gray-300");
          step.classList.remove("bg-blue-500", "bg-green-500");
          step.innerHTML = (index + 1).toString(); // Show step number
        }
      });
    }

    // Show modal for the current step
    function showStepModal() {
      modal.classList.remove("hidden");
      const stepMessages = [
        "You are in step: Phone Consultation",
        "You are in step: Office Consultation",
        "You are in step: Booking",
        "You are in step: Contract",
        "You are in step: Refund",
        "You are in step: In Process",
        "You are in step: Paid Thank you for your payment!"
      ];
      modalContent.innerText = stepMessages[currentStep]; // Update the modal content with the step message
      skipButton.classList.toggle("hidden", currentStep !== 1 && currentStep !== 2 && currentStep !== 4);

    }

    // Initialize with first step inactive
    updateProgress();
  </script>
</x-app-layout>
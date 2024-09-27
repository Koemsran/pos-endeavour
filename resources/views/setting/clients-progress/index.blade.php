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
            <div class="bg-white p-6 rounded shadow-lg " style="width: 60%;"> <!-- Increased Width -->
              <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Step of Client Progress</h2>
                <button id="closeModal" class="text-gray-600 text-3xl hover:text-gray-900">&times;</button> <!-- Close Button -->
              </div>

              <div id="modalContent" class="mb-4"> <!-- Content for each step -->
                <!-- Step information will be injected here -->
              </div>

              <!-- Form of Step -->

              <form id="infoForm">

                <!-- Step 1 -->

                <div class="step-form" id="step1" hidden>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                      <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                      <input type="tel" id="phone_number" name="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                      <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>
                  <div class="flex gap-5">

                    <div class="mb-4">
                      <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
                      <input type="number" id="age" name="age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="ielts" class="block text-gray-700 text-sm font-bold mb-2">IELTS Lavel:</label>
                      <input type="text" id="ielts" name="ielts" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                      <label for="hsk" class="block text-gray-700 text-sm font-bold mb-2">HSK Lavel:</label>
                      <input type="text" id="hsk" name="hsk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                  </div>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="current_university" class="block text-gray-700 text-sm font-bold mb-2">Current University:</label>
                      <input type="text" id="current_university" name="current_university" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="current_skill" class="block text-gray-700 text-sm font-bold mb-2">Current Skill:</label>
                      <input type="text" id="current_skill" name="current_skill" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="prefer_skill" class="block text-gray-700 text-sm font-bold mb-2">Preferred Skill:</label>
                      <input type="text" id="prefer_skill" name="prefer_skill" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="current_education" class="block text-gray-700 text-sm font-bold mb-2">Current Level of Education:</label>
                    <select name="current_education" id="current_education" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select current education</option>
                      <!-- Dropped Out School -->
                      <optgroup label="Dropped Out School">
                        <option value="Dropped Out School">Dropped Out School</option>
                      </optgroup>
                      <!-- High School -->
                      <optgroup label="High School">
                        <option value="10th Grade">10th Grade</option>
                        <option value="11th Grade">11th Grade</option>
                        <option value="12th Grade">12th Grade</option>
                      </optgroup>

                      <!-- Bachelor's Degree -->
                      <optgroup label="Bachelor's Degree">
                        <option value="Undergraduate (Year 1)">Undergraduate (Year 1)</option>
                        <option value="Undergraduate (Year 2)">Undergraduate (Year 2)</option>
                        <option value="Undergraduate (Year 3)">Undergraduate (Year 3)</option>
                        <option value="Undergraduate (Year 4)">Undergraduate (Year 4)</option>
                      </optgroup>

                      <!-- Master's Degree -->
                      <optgroup label="Master's Degree">
                        <option value="Master's (Year 1)">Master's (Year 1)</option>
                        <option value="Master's (Year 2)">Master's (Year 2)</option>
                      </optgroup>

                      <!-- PhD -->
                      <optgroup label="PhD">
                        <option value="PhD (Year 1)">PhD (Year 1)</option>
                        <option value="PhD (Year 2)">PhD (Year 2)</option>
                        <option value="PhD (Year 3)">PhD (Year 3)</option>
                        <option value="PhD (Year 4+)">PhD (Year 4+)</option>
                      </optgroup>

                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="current_education" class="block text-gray-700 text-sm font-bold mb-2">Level of Study Desired:</label>
                    <select name="current_education" id="current_education" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select your level of study desired</option>
                      <option value="Bachelor's">Bachelor's</option>
                      <option value="Master's">Master's</option>
                      <option value="PhD">PhD</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="study_destination" class="block text-gray-700 text-sm font-bold mb-2">Study Destination:</label>
                    <select name="study_destination" id="study_destination" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select your study destination</option>
                      <option value="USA">USA</option>
                      <option value="China">China</option>
                      <option value="UK">UK</option>
                      <option value="Australia">Australia</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="study_destination" class="block text-gray-700 text-sm font-bold mb-2">Preferred Universities:</label>
                    <select name="study_destination" id="study_destination" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select your preferred university</option>
                      <!-- USA -->
                      <optgroup label="USA">
                        <option value="Harvard University">Harvard University</option>
                        <option value="Stanford University">Stanford University</option>
                        <option value="Massachusetts Institute of Technology (MIT)">Massachusetts Institute of Technology (MIT)</option>
                        <option value="University of California, Berkeley">University of California, Berkeley</option>
                        <option value="Columbia University">Columbia University</option>
                      </optgroup>

                      <!-- China -->
                      <optgroup label="China">
                        <option value="Tsinghua University">Tsinghua University</option>
                        <option value="Peking University">Peking University</option>
                        <option value="Fudan University">Fudan University</option>
                        <option value="Shanghai Jiao Tong University">Shanghai Jiao Tong University</option>
                        <option value="Zhejiang University">Zhejiang University</option>
                      </optgroup>

                      <!-- UK -->
                      <optgroup label="UK">
                        <option value="University of Oxford">University of Oxford</option>
                        <option value="University of Cambridge">University of Cambridge</option>
                        <option value="Imperial College London">Imperial College London</option>
                        <option value="London School of Economics (LSE)">London School of Economics (LSE)</option>
                        <option value="University College London (UCL)">University College London (UCL)</option>
                      </optgroup>

                      <!-- Australia -->
                      <optgroup label="Australia">
                        <option value="University of Melbourne">University of Melbourne</option>
                        <option value="Australian National University (ANU)">Australian National University (ANU)</option>
                        <option value="University of Sydney">University of Sydney</option>
                        <option value="University of Queensland">University of Queensland</option>
                        <option value="University of New South Wales (UNSW)">University of New South Wales (UNSW)</option>
                      </optgroup>
                    </select>

                  </div>
                </div>
                <!-- Step 2 -->

                <div class="step-form" id="step2" hidden>
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Step 2:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                </div>
                <!-- Step 3 -->

                <div class="step-form" id="step3" hidden>
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Step 3:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                </div>
                <!-- Step 4 -->

                <div class="step-form" id="step4" hidden>
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Step 4:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                </div>

                <!-- Step 5 -->
                <div class="step-form" id="step5" hidden>
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Step 5:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                </div>

                <!-- Step 6 -->
                <div class="step-form" id="step6" hidden>
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Step 6:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                </div>

                <!-- Step 7 -->
                <div class="step-form" id="step7" hidden>
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Step 7:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
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
      showStepModal(currentStep); // Show the first step modal
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
          showStepModal(currentStep); // Show the next step modal
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
        showStepModal(currentStep); // Show modal for the next step
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
        showStepModal(currentStep); // Show modal for the next step
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
        showStepModal(currentStep); // Show modal for the current step
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
    function showStepModal(stepNumber) {
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
      const stepForms = document.querySelectorAll('.step-form');
      stepForms.forEach(form => form.hidden = true);
      const currentForm = document.getElementById(`step${stepNumber+1}`);
      if (currentForm) currentForm.hidden = false;
      modalContent.innerText = stepMessages[currentStep]; // Update the modal content with the step message
      skipButton.classList.toggle("hidden", currentStep !== 1 && currentStep !== 2 && currentStep !== 4);

    }
    $("input").prop('required',true);
    // Initialize with first step inactive
    updateProgress();
  </script>
</x-app-layout>
<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-5">
      <div class="container mx-auto px-6 py-2">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <div>
            <h1 class="flex items-center py-2 px-6 "><i class='bx bx-user-plus text-3xl mr-3'></i> <strong> {{$client->name}}</strong></h1>
            <input type="text" hidden id="current_step" value="{{$progress->step_number}}">
            <form action="{{ route('client.progress.index', ['client_id' => $client->id])}}" method="GET" class="flex items-center mb-4 w-full" id="search-form">
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

              <form id="infoForm" novalidate>
                <input type="number" hidden name="progress_id" id="progress_id" value="{{$progress->id}}">
                <input type="number" hidden name="client_id" id="client_id" value="{{$client->id}}">

                <!-- Step 1 -->

                <div class="step-form" id="step1" hidden>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                      <input type="text" id="name" name="name" value="{{$client->name}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                      <input type="tel" id="phone_number" name="phone_number" value="{{$client->phone_number}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
                      <input type="number" id="age" name="age" value="{{$client->age}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>
                  <div class="flex gap-5">

                    <div class="mb-4">
                      <label for="source" class="block text-gray-700 text-sm font-bold mb-2">Source:</label>
                      <input type="text" id="source" name="source" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="ielts" class="block text-gray-700 text-sm font-bold mb-2">IELTS Lavel:</label>
                      <input type="number" id="ielts" name="ielts" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                      <label for="hsk" class="block text-gray-700 text-sm font-bold mb-2">HSK Lavel:</label>
                      <input type="number" id="hsk" name="hsk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                  </div>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="grade" class="block text-gray-700 text-sm font-bold mb-2">Grade:</label>
                      <input type="text" id="grade" name="grade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="major" class="block text-gray-700 text-sm font-bold mb-2">Major:</label>
                      <input type="text" id="major" name="major" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="prefer_school" class="block text-gray-700 text-sm font-bold mb-2">Prefer School:</label>
                      <input type="text" id="prefer_school" name="prefer_school" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="program_looking" class="block text-gray-700 text-sm font-bold mb-2">Program Looking for:</label>
                    <select name="program_looking" id="program_looking" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select client's study program</option>
                      <option value="Bachelor's">Bachelor's</option>
                      <option value="Master's">Master's</option>
                      <option value="PhD">PhD</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="prefer_country" class="block text-gray-700 text-sm font-bold mb-2">Prefer Country:</label>
                    <select name="prefer_country" id="prefer_country" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select country</option>
                      <option value="USA">USA</option>
                      <option value="China">China</option>
                      <option value="Australia">Australia</option>
                    </select>
                  </div>
                </div>

                <!-- Step 2 -->

                <div class="step-form" id="step2" hidden>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                      <input type="text" id="name" name="name" value="{{$client->name}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                      <input type="tel" id="phone_number" name="phone_number" value="{{$client->phone_number}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
                      <input type="number" id="age" name="age" value="{{$client->age}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="education_level" class="block text-gray-700 text-sm font-bold mb-2">Education Level:</label>
                      <input type="text" id="education_level" name="education_level" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                      <label for="school" class="block text-gray-700 text-sm font-bold mb-2">School:</label>
                      <input type="text" id="school" name="school" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                      <label for="language_test" class="block text-gray-700 text-sm font-bold mb-2">Language test:</label>
                      <input type="text" id="language_test" name="language_test" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                  </div>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="prefer_university" class="block text-gray-700 text-sm font-bold mb-2">Prefer University:</label>
                      <input type="text" id="prefer_university" name="prefer_university" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="major2" class="block text-gray-700 text-sm font-bold mb-2">Major:</label>
                      <input type="text" id="major2" name="major2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Currently Address:</label>
                      <input type="text" id="address" name="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="program_looking2" class="block text-gray-700 text-sm font-bold mb-2">Program Looking for:</label>
                    <select name="program_looking2" id="program_looking2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select client's study program</option>
                      <option value="Bachelor's">Bachelor's</option>
                      <option value="Master's">Master's</option>
                      <option value="PhD">PhD</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="prefer_country2" class="block text-gray-700 text-sm font-bold mb-2">Prefer Country:</label>
                    <select name="prefer_country2" id="prefer_country2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select country</option>
                      <option value="USA">USA</option>
                      <option value="China">China</option>
                      <option value="Australia">Australia</option>
                    </select>
                  </div>
                </div>
                <!-- Step 3 -->

                <div class="step-form" id="step3" hidden>
                  <div class="mb-4">
                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                    <input type="number" id="amount" name="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                </div>

                <!-- Step 4 -->
                <div class="step-form" id="step4" hidden>
                  <div class="mb-4">
                    <div class="flex items-center mb-4">
                      <input id="booking" type="radio" name="booking_option" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="booking" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Booking</label>
                    </div>
                    <div class="flex items-center mb-4">
                      <input id="booking-waiver" type="radio" name="booking_option" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="booking-waiver" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Booking fee waiver</label>
                    </div>
                  </div>
                </div>

                <!-- Step 5 -->
                <div class="step-form" id="step5" hidden>
                  <div class="mb-4">
                    <div class="flex items-center mb-4">
                      <input id="refund-scholarship" type="radio" name="refund_reason" value="Refund because scholarships not accepted" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" required>
                      <label for="refund-scholarship" class="ms-2 text-sm font-medium text-gray-900">Refund because scholarships not accepted</label>
                    </div>
                    <div class="flex items-center mb-4">
                      <input id="refund-visa" type="radio" name="refund_reason" value="Refund because failed Visa" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                      <label for="refund-visa" class="ms-2 text-sm font-medium text-gray-900">Refund because failed Visa</label>
                    </div>
                    <div class="flex items-center mb-4">
                      <input id="unrefund-client" type="radio" name="refund_reason" value="Unrefund because client passed" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                      <label for="unrefund-client" class="ms-2 text-sm font-medium text-gray-900">Unrefund because client passed</label>
                    </div>
                  </div>
                </div>

                <!-- Step 6 -->
                <div class="step-form" id="step6" hidden>
                  <div class="mb-4">
                    <div class="flex items-center mb-4">
                      <input id="prepared-docs-checkbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="prepared-docs-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Prepared documents for the application</label>
                    </div>
                  </div>
                </div>

                <!-- Step 7 -->
                <div class="step-form" id="step7" hidden>
                  <div class="mb-4">
                    <label for="amount1" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                    <input type="number" id="amount1" name="amount1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                  </div>
                  <div class="mb-4 text-center text-3xl text-green-500">
                    Congratulation!
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
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

    let currentStep = +document.getElementById('current_step').value;

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
    infoForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      currentStep++
      let formData = {}
      // Collect form data
      if (currentStep === 1) {
        formData = {
          name: document.getElementById("name").value,
          phone_number: document.getElementById("phone_number").value,
          age: document.getElementById("age").value,
          source: document.getElementById("source").value,
          ielts: document.getElementById("ielts").value,
          hsk: document.getElementById("hsk").value,
          grade: document.getElementById("grade").value,
          major: document.getElementById("major").value,
          prefer_school: document.getElementById("prefer_school").value,
          program_looking: document.getElementById("program_looking").value,
          prefer_country: document.getElementById("prefer_country").value,
          progress_id: document.getElementById("progress_id").value,
          status: 'completed'
        };

      } else if (currentStep === 2) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          school: document.getElementById("school").value,
          education_level: document.getElementById("education_level").value,
          language_test: document.getElementById("language_test").value,
          prefer_university: document.getElementById("prefer_university").value,
          major: document.getElementById("major2").value,
          address: document.getElementById("address").value,
          program_looking: document.getElementById("program_looking2").value,
          prefer_country: document.getElementById("prefer_country2").value,
        };
      } else if (currentStep === 3) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          amount: document.getElementById("amount").value,
          booking_date: new Date().toISOString().slice(0, 10),
        }
      } else if (currentStep === 4) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          status: document.querySelector('input[name="booking_option"]:checked') ?
            parseInt(document.querySelector('input[name="booking_option"]:checked').value, 10) // Get the selected radio button value as a number
            :
            null

        };
      } else if (currentStep === 5) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          refund_reason: document.querySelector('input[name="refund_reason"]:checked')?.value // Get the checked radio button value
        };
      } else if (currentStep === 6) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          status: document.getElementById("prepared-docs-checkbox").checked ? "true" : "false"
        }
      } else if (currentStep === 7) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          amount: document.getElementById("amount1").value,
          paid_date: new Date().toISOString().slice(0, 10),
        }
      } else {
        alert("Invalid step");
      }

      try {
        const queryString = new URLSearchParams(formData).toString();
        updateProgress();

        let redirectUrl = '';
        // Redirect with query parameters
        if (currentStep === 1) {
          redirectUrl = `/client/phone_consult?${queryString}`;

        } else if (currentStep === 2) {
          redirectUrl = `/client/office_consult?${queryString}`;

        } else if (currentStep === 3) {
          redirectUrl = `/client/booking?${queryString}`;

        } else if (currentStep === 4) {
          redirectUrl = `/client/contract?${queryString}`;

        } else if (currentStep === 5) {
          redirectUrl = `/client/refund?${queryString}`;

        } else if (currentStep === 6) {
          redirectUrl = `/client/in_process?${queryString}`;
        } else if (currentStep === 7) {
          redirectUrl = `/client/paid?${queryString}`;

        } else {
          alert('Current step is not valid')
          let redirectUrl = `/client/progress/${document.getElementById("client_id").value}`
        }

        window.location.href = redirectUrl;
        Toast.fire({
          icon: 'success',
          title: 'Completed successfully!',

        })
        modal.classList.add("hidden"); // Close modal after submit
        infoForm.reset(); // Reset form

      } catch (error) {
        // Handle error (e.g., show error notification)
        Toast.fire({
          icon: 'error',
          title: 'Failed to submit the form!',
        });
        console.error(error);
      }

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
      let redirectUrl = `/client/progress/update/${document.getElementById("progress_id").value}`
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
      window.location.href = redirectUrl;
    });
    // Previous button handler
    prevButton.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        updateProgress();
        showStepModal(currentStep); // Show modal for the current step
        
      }
      if(currentStep === 1){
        let redirectUrl = `/client/phone_consult/show/${document.getElementById("progress_id").value}`
        window.location.href = redirectUrl;
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
        if (currentStep === 1) {
          startButton.classList.add("hidden"); // Hide Start button for step 1
          prevButton.disabled = false; // Enable Previous button
          nextButton.disabled = false; // Enable Next button
        } else if (currentStep > 1) {
          // Change button states based on other steps
          startButton.classList.add("hidden"); // Keep Start button hidden
          prevButton.disabled = currentStep === 1; // Disable if on the first step
          nextButton.disabled = currentStep === steps.length; // Disable if on the last step
        }
        if (currentStep < steps.length && currentStep >= 1) {
          showStepModal(currentStep); // Show the next step modal
        } else if (currentStep === steps.length) {
          Toast.fire({
            icon: 'success',
            title: 'All steps completed!',
          });
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
    // Initialize with first step inactive
    updateProgress();
  </script>
</x-app-layout>
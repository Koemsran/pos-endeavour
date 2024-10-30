<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-5">
      <div class="container mx-auto px-6 py-2">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <div>
            <h1 id="congrate" class="flex items-center py-2 px-6 text-green-500 text-2xl hidden"><strong> Congratulation!🎉</strong></h1>

            <h1 class="flex items-center py-2 px-6 "><i class='bx bx-user-plus text-3xl mr-3'></i> <strong> {{$client->name}} </strong></h1>
            <input type="text" hidden id="current_step" value="{{$progress->step_number}}">
          </div>
          <hr>
          <div class="w-full p-5 mt-5">
            <div class="relative flex justify-between items-center mb-8">
              <!-- Steps -->
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Phone Consultation">1</div>
                <span class="mt-2 text-sm">Phone Consultation</span>
                <button disabled class="edit1 text-gray-500 edit" title="edit" data-step="1">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Office Consultation">2</div>
                <span class="mt-2 text-sm">Office Consultation</span>
                <button disabled class="edit2 text-gray-500 edit" title="edit" data-step="2">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Booking">3</div>
                <span class="mt-2 text-sm">Booking</span>
                <button disabled class="edit3 text-gray-500 edit" title="edit" data-step="3">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Contract">4</div>
                <span class="mt-2 text-sm">Contract</span>
                <button disabled class="edit4 text-gray-500 edit" title="edit" data-step="4">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Refund">5</div>
                <span class="mt-2 text-sm">Refund</span>
                <button disabled class="edit5 text-gray-500 edit" title="edit" data-step="5">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="In Process">6</div>
                <span class="mt-2 text-sm">In Process</span>
                <button disabled class="edit6 text-gray-500 edit" title="edit" data-step="6">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step" data-step="Paid">7</div>
                <span class="mt-2 text-sm">Paid</span>
                <button disabled class="edit7 text-gray-500 edit" title="edit" data-step="7">
                  <i class='bx bx-edit text-lg'></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex space-x-4 p-5">
            <button id="start" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Start</button>
            <button id="next" class="bg-gray-300 text-white py-2 px-4 rounded" disabled>Next</button>
            <button id="done" class="bg-blue-500 text-white py-2 px-4 rounded hidden">Done</button>
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
                <input type="number" hidden name="step_number" id="step_number" value="">

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
                      <input type="text" id="ielts" name="ielts" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                      <label for="hsk" class="block text-gray-700 text-sm font-bold mb-2">HSK Lavel:</label>
                      <input type="text" id="hsk" name="hsk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                      <label for="university1" class="block text-gray-700 text-sm font-bold mb-2">University 1:</label>
                      <input type="text" id="university1" name="university1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="university2" class="block text-gray-700 text-sm font-bold mb-2">University 2:</label>
                      <input type="text" id="university2" name="university2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                  </div>

                  <div class="mb-4">
                    <label for="program_looking" class="block text-gray-700 text-sm font-bold mb-2">Program Looking for:</label>
                    <select name="program_looking" id="program_looking" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select degree</option>
                      <option value="Bachelor's">Bachelor's</option>
                      <option value="Master's">Master's</option>
                      <option value="PhD">PhD</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="prefer_country" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
                    <select name="prefer_country" id="prefer_country" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select product</option>
                      @foreach ($categories as $country)
                      <option value="{{ $country->name }}">{{ $country->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <!-- Step 2 -->

                <div class="step-form" id="step2" hidden>
                  <div class="flex gap-5">
                    <div class="mb-4">
                      <label for="name2" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                      <input type="text" id="name2" name="name" value="{{$client->name}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="phone_number2" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                      <input type="tel" id="phone_number2" name="phone_number" value="{{$client->phone_number}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                      <label for="age2" class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
                      <input type="number" id="age2" name="age" value="{{$client->age}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
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
                      <label for="prefer_university" class="block text-gray-700 text-sm font-bold mb-2">Institute:</label>
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
                    <label for="prefer_country2" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
                    <select name="prefer_country2" id="prefer_country2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select product</option>
                      @foreach ($categories as $country)
                      <option value="{{ $country->name }}">{{ $country->name }}</option>
                      @endforeach
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
                </div>

                <div class="flex justify-end gap-4">
                  <button type="button" id="skip" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Skip</button> <!-- Skip Button -->
                  <button type="submit" id="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Submit</button>
                  <button type="button" id="cancel" hidden class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Cancel</button>
                  <button type="submit" id="save" hidden class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Save</button>
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
    const edits = document.querySelectorAll(".edit");
    const nextButton = document.getElementById("next");
    const startButton = document.getElementById("start");
    const doneButton = document.getElementById("done");
    const modal = document.getElementById("modal");
    const closeModalButton = document.getElementById("closeModal");
    const infoForm = document.getElementById("infoForm");
    const modalContent = document.getElementById("modalContent");
    const skipButton = document.getElementById("skip");
    let currentStep = +document.getElementById('current_step').value;
    let saveBtn = document.getElementById('save');
    let cancelBtn = document.getElementById('cancel');
    let submitBtn = document.getElementById('submit');
    let editIcons = document.querySelectorAll('.edit');
    let updateStepNumber = document.getElementById("step_number");
    let congrate = document.getElementById("congrate");
    //Edit btn

    edits.forEach((edit) => {
      edit.addEventListener("click", () => {
        const stepId = edit.dataset.step;
        const progressId = document.getElementById("progress_id").value;
        // Define the correct URL based on the stepId
        let fetchUrl = '';

        if (stepId == 1) {
          fetchUrl = `/client/phone_consult/show/${progressId}`;
        } else if (stepId == 2) {
          fetchUrl = `/client/office_consult/show/${progressId}`;
        } else if (stepId == 3) {
          fetchUrl = `/client/booking/show/${progressId}`;
        } else if (stepId == 4) {
          fetchUrl = `/client/contract/show/${progressId}`;
        } else if (stepId == 5) {
          fetchUrl = `/client/refund/show/${progressId}`;
        } else if (stepId == 6) {
          fetchUrl = `/client/in_process/show/${progressId}`;
        } else if (stepId == 7) {
          fetchUrl = `/client/paid/show/${progressId}`;
        }

        // Make the fetch request to the determined URL
        fetch(fetchUrl)
          .then(response => {
            if (!response.ok) {
              throw new Error(`Error fetching consultation data: ${response.status}`);
            }
            return response.json(); // Parse the JSON response
          })
          .then(data => {
            // Check if the `phoneConsult` or similar data exists
            if (data.success && data.phoneConsult) {
              showEditStepModal(stepId, data.phoneConsult); // Pass data to your modal function
            } else {
              console.error("Consultation data not found:", data);
            }
          })
          .catch(error => {
            console.error("Error fetching consultation data:", error);
          });
      });
    });

    // Show modal when clicking Start button
    startButton.addEventListener("click", () => {
      modal.classList.remove("hidden");
      showStepModal(currentStep); // Show the first step modal
    });
    cancelBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
      saveBtn.hidden = true
      cancelBtn.hidden = true
      submitBtn.classList.remove('hidden')
    });

    // Close modal
    closeModalButton.addEventListener("click", () => {
      modal.classList.add("hidden");
      saveBtn.hidden = true
      cancelBtn.hidden = true
      submitBtn.classList.remove('hidden')
    });

    // Handle form submission
    infoForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      currentStep++
      let formData = {}
      // Collect form data
      if (updateStepNumber.value == '') {
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
            university1: document.getElementById("university1").value,
            university2: document.getElementById("university2").value,
            program_looking: document.getElementById("program_looking").value,
            prefer_country: document.getElementById("prefer_country").value,
            progress_id: document.getElementById("progress_id").value,
          };
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }

        } else if (currentStep === 2) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            name: document.getElementById("name2").value,
            phone_number: document.getElementById("phone_number2").value,
            age: document.getElementById("age2").value,
            school: document.getElementById("school").value,
            education_level: document.getElementById("education_level").value,
            language_test: document.getElementById("language_test").value,
            prefer_university: document.getElementById("prefer_university").value,
            major: document.getElementById("major2").value,
            address: document.getElementById("address").value,
            program_looking: document.getElementById("program_looking2").value,
            prefer_country: document.getElementById("prefer_country2").value,
          };
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else if (currentStep === 3) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            amount: document.getElementById("amount").value,
            booking_date: new Date().toISOString().slice(0, 10),
          }
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
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
          let isEmpty = false;

          // Loop through formData and validate each field
          for (let key in formData) {
            if (formData[key] === null || (typeof formData[key] === 'string' && formData[key].trim() === "")) {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else if (currentStep === 5) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            refund_reason: document.querySelector('input[name="refund_reason"]:checked')?.value // Get the checked radio button value
          };
          if (formData.refund_reason == undefined) {
            alert("Please select a refund reason");
            return false;
          }
        } else if (currentStep === 6) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            status: document.getElementById("prepared-docs-checkbox").checked ? "true" : "false"
          }
          if (formData.status == 'false') {
            alert("Please checked box");
            return false;
          }
        } else if (currentStep === 7) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            amount: document.getElementById("amount1").value,
            paid_date: new Date().toISOString().slice(0, 10),
          }
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else {
          alert("Invalid step");
        }
      } else {
        if (updateStepNumber.value == 1) {
          formData = {
            name: document.getElementById("name").value,
            phone_number: document.getElementById("phone_number").value,
            age: document.getElementById("age").value,
            source: document.getElementById("source").value,
            ielts: document.getElementById("ielts").value,
            hsk: document.getElementById("hsk").value,
            grade: document.getElementById("grade").value,
            major: document.getElementById("major").value,
            university1: document.getElementById("university1").value,
            university2: document.getElementById("university2").value,
            program_looking: document.getElementById("program_looking").value,
            prefer_country: document.getElementById("prefer_country").value,
            progress_id: document.getElementById("progress_id").value,
          };
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }

        } else if (updateStepNumber.value == 2) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            name: document.getElementById("name2").value,
            phone_number: document.getElementById("phone_number2").value,
            age: document.getElementById("age2").value,
            school: document.getElementById("school").value,
            education_level: document.getElementById("education_level").value,
            language_test: document.getElementById("language_test").value,
            prefer_university: document.getElementById("prefer_university").value,
            major: document.getElementById("major2").value,
            address: document.getElementById("address").value,
            program_looking: document.getElementById("program_looking2").value,
            prefer_country: document.getElementById("prefer_country2").value,
          };
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else if (updateStepNumber.value == 3) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            amount: document.getElementById("amount").value,
            booking_date: new Date().toISOString().slice(0, 10),
          }
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else if (updateStepNumber.value == 4) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            status: document.querySelector('input[name="booking_option"]:checked') ?
              parseInt(document.querySelector('input[name="booking_option"]:checked').value, 10) // Get the selected radio button value as a number
              :
              null

          };
          let isEmpty = false;

          // Loop through formData and validate each field
          for (let key in formData) {
            if (formData[key] === null || (typeof formData[key] === 'string' && formData[key].trim() === "")) {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else if (updateStepNumber.value == 5) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            refund_reason: document.querySelector('input[name="refund_reason"]:checked')?.value // Get the checked radio button value
          };
          if (formData.refund_reason == undefined) {
            alert("Please select a refund reason");
            return false;
          }
        } else if (updateStepNumber.value == 6) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            status: document.getElementById("prepared-docs-checkbox").checked ? "true" : "false"
          }
          // Loop through formData and validate each field
          if (formData.status == 'false') {
            alert("Please checked box");
            return false;
          }

        } else if (updateStepNumber.value == 7) {
          formData = {
            progress_id: document.getElementById("progress_id").value,
            client_id: document.getElementById("client_id").value,
            amount: document.getElementById("amount1").value,
            paid_date: new Date().toISOString().slice(0, 10),
          }
          let isEmpty = false;
          for (let key in formData) {
            if (formData[key] === null || formData[key].trim() === "") {
              alert(`Please fill in the ${key.replace("_", " ")} field`);
              isEmpty = true;
              return false
            }
          }
        } else {
          alert("Invalid step");
        }
      }

      try {
        const queryString = new URLSearchParams(formData).toString();

        let redirectUrl = '';
        // Redirect with query parameters
        if (infoForm.hasAttribute('id')) {
          updateProgress();
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
        } else {
          currentStep--
          const progressId = document.getElementById("progress_id").value;
          if (updateStepNumber.value == 1) {
            redirectUrl = `/client/phone_consult/update/${progressId}?${queryString}`;
          } else if (updateStepNumber.value == 2) {
            redirectUrl = `/client/office_consult/update/${progressId}?${queryString}`;
          } else if (updateStepNumber.value == 3) {
            redirectUrl = `/client/booking/update/${progressId}?${queryString}`;
          } else if (updateStepNumber.value == 4) {
            redirectUrl = `/client/contract/update/${progressId}?${queryString}`;
          } else if (updateStepNumber.value == 5) {
            redirectUrl = `/client/refund/update/${progressId}?${queryString}`;
          } else if (updateStepNumber.value == 6) {
            redirectUrl = `/client/in_process/update/${progressId}?${queryString}`;
          } else if (updateStepNumber.value == 7) {
            redirectUrl = `/client/paid/update/${progressId}?${queryString}`;
          } else {
            alert('Current step is not valid')
            let redirectUrl = `/client/progress/${document.getElementById("client_id").value}`
          }
        }

        window.location.href = redirectUrl;
        Toast.fire({
          icon: 'success',
          title: 'Completed successfully!',

        })
        // modal.classList.add("hidden"); // Close modal after submit
        // infoForm.reset(); // Reset form

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
      updateProgress();
      let redirectUrl = '';
      let formData = {};
      if (currentStep == 2) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          name: document.getElementById("name2").value,
          phone_number: document.getElementById("phone_number2").value,
          age: document.getElementById("age2").value,
          school: '',
          education_level: '',
          language_test: '',
          prefer_university: '',
          major: '',
          address: '',
          program_looking: '',
          prefer_country: '',
        };
      } else if (currentStep == 3) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          amount: '',
          booking_date: '',
        }
      } else if (currentStep == 5) {
        formData = {
          progress_id: document.getElementById("progress_id").value,
          client_id: document.getElementById("client_id").value,
          refund_reason: ''
        }
      } else {
        alert('Current step is not valid')
        let redirectUrl = `/client/progress/${document.getElementById("client_id").value}`
      }
      const queryString = new URLSearchParams(formData).toString();

      if (currentStep === 2) {

        redirectUrl = `/client/office_consult?${queryString}`;
      } else if (currentStep === 3) {
        redirectUrl = `/client/booking?${queryString}`;
      } else if (currentStep === 5) {
        redirectUrl = `/client/refund?${queryString}`;
      }
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

    doneButton.addEventListener("click", () => {
      let redirectUrl = '/admin/clients'
      window.location.href = redirectUrl;
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
        if (currentStep >= 1) {
          // Change button states based on other steps
          startButton.classList.add("hidden");
          nextButton.disabled = false;
          nextButton.disabled = currentStep === steps.length; // Disable if on the last step
          nextButton.classList.remove('bg-gray-300')
          nextButton.classList.add('bg-blue-500')
          nextButton.classList.add('text-white')

        }
        if (currentStep < steps.length && currentStep >= 1) {
          showStepModal(currentStep); // Show the next step modal
        } else if (currentStep === steps.length) {
          nextButton.classList.add("hidden");
          doneButton.classList.remove("hidden");
          congrate.classList.remove("hidden");
          Toast.fire({
            icon: 'success',
            title: 'All steps completed!',
          });
        }
      });
    }
    editIcons.forEach((edit, index) => {
      // If the step is completed
      if (index < currentStep) {
        edit.disabled = false;
        edit.classList.remove('text-gray-500');
        edit.classList.add('text-blue-500');
      }

    });

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
    // Show modal for the current step
    function showEditStepModal(stepNumber, data) {
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
      const currentForm = document.getElementById(`step${stepNumber}`);
      if (currentForm) currentForm.hidden = false;
      modalContent.innerText = stepMessages[stepNumber - 1];

      saveBtn.hidden = false
      cancelBtn.hidden = false
      skipButton.classList.add('hidden')
      submitBtn.classList.add('hidden')
      infoForm.removeAttribute('id');
      infoForm.classList.add('editForm');
      updateStepNumber.value = stepNumber;
      if (stepNumber == 1) {
        document.getElementById("name").value = data.name;
        document.getElementById("phone_number").value = data.phone_number;
        document.getElementById("age").value = data.age;
        document.getElementById("source").value = data.source;
        document.getElementById("ielts").value = data.ielts;
        document.getElementById("hsk").value = data.hsk;
        document.getElementById("grade").value = data.grade;
        document.getElementById("major").value = data.major;
        document.getElementById("university1").value = data.university1;
        document.getElementById("university2").value = data.university2;
        document.getElementById("program_looking").value = data.program_looking;
        document.getElementById("prefer_country").value = data.prefer_country;
        document.getElementById("progress_id").value = data.progress_id;


      } else if (stepNumber == 2) {
        document.getElementById("progress_id").value = data.progress_id;
        document.getElementById("name2").value = data.name;
        document.getElementById("phone_number2").value = data.phone_number;
        document.getElementById("age2").value = data.age;
        document.getElementById("school").value = data.school;
        document.getElementById("education_level").value = data.education_level;
        document.getElementById("language_test").value = data.language_test;
        document.getElementById("prefer_university").value = data.prefer_university;
        document.getElementById("major2").value = data.major;
        document.getElementById("address").value = data.address;
        document.getElementById("program_looking2").value = data.program_looking;
        document.getElementById("prefer_country2").value = data.prefer_country;
      } else if (stepNumber == 3) {
        document.getElementById("progress_id").value = data.progress_id
        document.getElementById("client_id").value = data.client_id
        document.getElementById("amount").value = data.amount

      } else if (stepNumber == 4) {
        if (data.status === 0) {
          document.getElementById("booking-waiver").checked = true; // Check the booking fee waiver option
        } else {
          document.getElementById("booking").checked = true; // Otherwise, check the booking option
        }

      } else if (stepNumber == 5) {
        // Check the radio button based on the label text
        if (data.refund_reason === "Refund because scholarships not accepted") {
          document.getElementById("refund-scholarship").checked = true; // Check the first option
        } else if (data.refund_reason === "Refund because failed Visa") {
          document.getElementById("refund-visa").checked = true; // Check the second option
        } else if (data.refund_reason === "Unrefund because client passed") {
          document.getElementById("unrefund-client").checked = true; // Check the third option
        }

      } else if (stepNumber == 6) {
        if (data.status) {
          document.getElementById("prepared-docs-checkbox").checked = true; // Check the booking fee waiver option
        }

      } else if (stepNumber == 7) {
        document.getElementById("progress_id").value = data.progress_id
        document.getElementById("client_id").value = data.client_id
        document.getElementById("amount1").value = data.amount
      }

    }

    // Initialize with first step inactive
    updateProgress();
  </script>
</x-app-layout>
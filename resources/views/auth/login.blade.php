<x-guest-layout>
  <div class="font-sans min-h-screen antialiased bg-gray-900 flex justify-center items-center">
    <div class="flex flex-col justify-center sm:w-96 mx-5 mb-3 space-y-3">
      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <!-- Validation Errors -->
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="flex flex-col bg-white p-10 rounded-lg shadow space-y-6">
          <div style="display: flex; justify-content: center; align-items: center;">
            <img width="150" height="150" src="/images/logo1.png" alt="Logo">
          </div>
          <h1 class="font-bold text-xl text-center">Sign in to your account</h1>

          <div class="flex flex-col space-y-1">
            <input type="email" name="email" id="email" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Email" :value="old('email')" required autofocus />
            @if (session('error-email'))
            <span class="text-red-500">
              {{ session('error-email')}}
            </span>
            {{ session()->forget('error-email') }}
            @endif
          </div>

          <div class="flex flex-col space-y-1 relative">
            <div class="flex flex-col space-y-1 relative">
              <input type="password" name="password" id="password" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Password" required autocomplete="current-password" />
              <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility()">
                <i id="eyeIcon" class='bx bx-low-vision text-gray-500'></i>
              </span>
            </div>
            @if (session('error-pass'))
            <span class="text-red-500">
              {{ session('error-pass')}}
            </span>
            {{ session()->forget('error-pass') }}
            @endif

          </div>
          <div class="flex flex-col-reverse sm:flex-row sm:justify-between items-center">
            <button type="submit" class="w-full bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-700 transition-colors m-auto">Log In</button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- Include Boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

  <script>
    function togglePasswordVisibility() {
      const passwordField = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('bx-low-vision');
        eyeIcon.classList.add('bx-show');
      } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('bx-show');
        eyeIcon.classList.add('bx-low-vision');
      }
    }
  </script>
</x-guest-layout>
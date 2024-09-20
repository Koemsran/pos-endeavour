<div class="container w-50 p-2 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
  <div class="flex text-center justify-center">
      <h1 class="text-3xl font-bold text-gray-800 m-3">Payment Form </h1>
      <img class="w-13 h-8 mt-3" src="https://lh6.googleusercontent.com/proxy/T8fjld7xQK5zAxSh8SfzGOT7Ufidp8BZcHByP9_Bl3r-opUtdBHT_Ws7XoOkKkb7mloIy-U3GQEr_dhFYg8Sjosli8qBKIY6HA" alt="">
      <hr>
  </div>
  <form id="payment-form">
      @csrf
      <div class="form-group mt-3">
          <label for="email">Email *</label>
          <input type="email" id="email" class="form-control" placeholder="xxxxxx@gmail.com" required />
      </div>
      <div class="form-group mt-3">
          <label for="name">Name on Card</label>
          <input type="text" id="name" class="form-control" required />
      </div>
      <div class="form-group mt-3">
          <label for="total">You need to pay ($) *</label>
          <input type="number" id="total" value="50" class="form-control" required disabled />
      </div>
      <div class="form-group mt-3">
          <label for="amount">Amount ($) *</label>
          <input type="number" id="amount" class="form-control" required />
      </div>
      <div class="form-group mt-3">
          <label for="card-element">Card Information</label>
          <div id="card-element" class="form-control">
              <div id="card-number" class="form-control"></div>
              <div class="row mt-2">
                  <div class="col-md-4">
                      <div id="card-expiry" class="form-control"></div>
                  </div>
                  <div class="col-md-4">
                      <div id="card-cvc" class="form-control"></div>
                  </div>
                  <div class="col-md-4">
                      <input type="text" id="postal-code" class="form-control" placeholder="ZIP" required />
                  </div>
              </div>
          </div>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
      <div id="card-errors" role="alert" class="text-danger mt-2"></div>
  </form>
</div>
<script>
  document.addEventListener('DOMContentLoaded', async function() {
      const stripe = await Stripe('pk_test_51PY0rM2LbQW9hazpTrN6pOrbmkotW9UrQkyEAW9YojtC3VyakwQmUqqN3EJgG2yjLoEH1lo54bKdrJK35ZQ1sK0E00Vv0cUxjY');
      const elements = stripe.elements();
      const cardNumber = elements.create('cardNumber');
      const cardExpiry = elements.create('cardExpiry');
      const cardCvc = elements.create('cardCvc');
      cardNumber.mount('#card-number');
      cardExpiry.mount('#card-expiry');
      cardCvc.mount('#card-cvc');

      cardNumber.on('change', function(event) {
          const displayError = document.getElementById('card-errors');
          if (event.error) {
              displayError.textContent = event.error.message;
          } else {
              displayError.textContent = '';
          }
      });

      document.getElementById('payment-form').addEventListener('submit', async function(e) {
          e.preventDefault();
          const { error, paymentIntent } = await stripe.confirmCardPayment('{{ $clientSecret }}', {
              payment_method: {
                  card: cardNumber,
                  billing_details: {
                      name: document.getElementById('name').value,
                      email: document.getElementById('email').value,
                      address: {
                          postal_code: document.getElementById('postal-code').value
                      }
                  },
              }
          });

          if (error) {
              const displayError = document.getElementById('card-errors');
              displayError.textContent = error.message;
          } else {
              if (paymentIntent.status === 'succeeded') {
                  alert('Payment succeeded!');
                  // Here you can add logic to update payment status in your database
              }
          }
      });
  });
</script>
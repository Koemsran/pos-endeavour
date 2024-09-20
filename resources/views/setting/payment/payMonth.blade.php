<x-guest-layout>
    <div class="font-sans min-h-screen antialiased bg-gray-900 pt-5 pb-5">
        <div class="flex flex-col justify-center sm:m-auto mx-5 mb-3 space-y-3">
            <h1 class="font-bold text-center text-4xl text-yellow-500">S<span class="text-blue-500">vahab</span></h1>

            <div
                class="container w-full max-w-lg mx-auto mt-10 p-6 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                </h1>
                <div class="flex justify-center items-center mb-4">
                    <h1 class="text-3xl font-bold text-gray-800 m-3">Payment Form</h1>
                    <img class="w-13 h-8 mt-3"
                        src="https://lh6.googleusercontent.com/proxy/T8fjld7xQK5zAxSh8SfzGOT7Ufidp8BZcHByP9_Bl3r-opUtdBHT_Ws7XoOkKkb7mloIy-U3GQEr_dhFYg8Sjosli8qBKIY6HA"
                        alt="">
                </div>
                <form id="payment-form" class="space-y-6" >
                    @csrf
                    <div class="form-group">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" id="email"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="xxxxxx@gmail.com" required />
                    </div>
                    <div class="form-group">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name on Card</label>
                        <input type="text" name="name" id="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
                    </div>
                    <div class="form-group">
                        <label for="total" class="block text-sm font-medium text-gray-700">You need to pay ($) *</label>
                        <input type="number" id="total" value="50"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required disabled />
                    </div>
                    <div class="form-group">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount ($) *</label>
                        <input type="number" id="amount" name="amount"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="card-element" class="block text-sm font-medium text-gray-700">Card
                            Information</label>
                        <div id="card-element" class="border border-gray-300 p-2 rounded-md">
                            <div id="card-number" class="form-control"></div>
                            <div class="flex mt-2 space-x-2">
                                <div class="flex-1">
                                    <div id="card-expiry" class="form-control"></div>
                                </div>
                                <div class="flex-1">
                                    <div id="card-cvc" class="form-control"></div>
                                </div>
                                <div class="flex-1">
                                    <input type="text" id="postal-code"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="ZIP" required />
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-400">You must pay to admin before you create account!</p>
                    </div>
                    <button type="submit"
                        class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Pay Now
                    </button>
                    <div id="card-errors" role="alert" class="text-red-500 mt-2"></div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
<script src="https://js.stripe.com/v3/"></script> 
<script>
    document.addEventListener('DOMContentLoaded', async function() {
        const stripe = Stripe('pk_test_51PY0rM2LbQW9hazpTrN6pOrbmkotW9UrQkyEAW9YojtC3VyakwQmUqqN3EJgG2yjLoEH1lo54bKdrJK35ZQ1sK0E00Vv0cUxjY');
        const elements = stripe.elements();

        const style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#a0aec0"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        const cardNumber = elements.create('cardNumber', { style: style, placeholder: 'XXXX-XXXX-XXXX-XXXX' });
        const cardExpiry = elements.create('cardExpiry', { style: style, placeholder: 'MM/YY' });
        const cardCvc = elements.create('cardCvc', { style: style, placeholder: 'CVC' });

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
                    window.location.href = '/admin/payments';
                }else{
                    alert('Payment failed!');
                    window.location.href = '/payment/form';
                }
            }
        });
    });
</script>

<style>
    #card-element {
        border: 1px solid #e2e8f0;
        /* Tailwind CSS border color */
        padding: 10px;
        border-radius: 0.375rem;
        /* Tailwind CSS rounded-md */
    }

    .form-control {
        padding: 10px;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
    }

    #payment-form {
        max-width: 500px;
        margin: auto;
    }

    .StripeElement--focus {
        border-color: #a0aec0;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
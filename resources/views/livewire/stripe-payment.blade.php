<div>
    <div class="bg-white shadow-lg rounded-lg p-6 relative">
        <div wire:loading.flex
            class="absolute w-full h-full bg-gray-200 bg-opacity-50 z-20 items-center justify-center">
            <div class="loader"></div>
        </div>
        <div>
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold mb-4">Pago con tarjeta</h2>
                <img class="h-8" src="{{ asset('img/visa-mastercard-american-express.jpg') }}" alt="logo_tarjetas">
            </div>

            <form id="card-form">
                <div class="form-group">
                    <label class="form-label" for="">Titular de la tarjeta</label>
                    <input class="form-control" id="card-holder-name" type="text"
                        placeholder="Nombre completo del titular" required>
                </div>


                <!-- Stripe Elements Placeholder -->
                <div class="form-group">
                    <label class="form-label" for="">Número de tarjeta</label>
                    <div class="form-control" id="card-element"></div>
                    <span class="invalid-feedback" id="card-error"></span>
                </div>

                <div class="flex justify-between items-end">
                    <div>
                        <div class="font-semibold flex flex-col items-end">
                            <p class="text-lg">Subtotal {{ $order->total - $order->coste_envio }}&#128;</p>
                            <p class="text-lg">Envío {{ $order->coste_envio }}&#128;</p>
                            <p class="text-2xl">Total {{ $order->total }}&#128;</p>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-jet-danger-button id="card-button" type='submit'>
                            Pagar
                        </x-jet-danger-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mt-6">
        <div wire:loading.flex
            class="absolute w-full h-full bg-gray-200 bg-opacity-50 z-20 items-center justify-center">
            <div class="loader"></div>
        </div>
        <h2 class="text-2xl font-semibold mb-4">Pago con PayPal</h2>
        <div id="paypal-button-container"></div>
    </div>

    @push('js')
    <script>
        document.addEventListener('livewire:load', function(){
            stripe();
        });

        Livewire.on('refreshStripe', function(){
            document.getElementById('card-form').reset();
            stripe();
        })
    </script>

    <script>
        function stripe(){
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const cardForm = document.getElementById('card-form');

        cardForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
        billing_details: { name: cardHolderName.value }
        }
        );

        if (error) {
        // Display "error.message" to the user...
        document.getElementById('card-error').innerHtml = error.message;
        } else {
        // The card has been verified successfully...
        Livewire.emit('paymentMethod', paymentMethod.id);
        }
        });
        }

    </script>

    <script>
        paypal.Buttons({

        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
        return actions.order.create({
        purchase_units: [{
        amount: {
        value: "{{ $order->total }}" // Can reference variables or functions. Example: `value: document.getElementById('...').value`
        }
        }]
        });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
        // Successful capture! For dev/demo purposes:
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        //var transaction = orderData.purchase_units[0].payments.captures[0];
        //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

        // When ready to go live, remove the alert and show a success message within this page. For example:
        //var element = document.getElementById('paypal-button-container');
        //element.innerHTML = '';
        //element.innerHTML = "<h3 class='text-red-600'>Gracias por su compra!</h3>";
        // Or go to another URL: actions.redirect('thank_you.html');
        Livewire.emit('paypalSuccess');
        });
        }
        }).render('#paypal-button-container');

    </script>
    @endpush
</div>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-block">
                <h4>{{ __('Update your credit card details') }}</h4>

                <form action="/dashboard/billing" method="post" id="payment-form">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group">
                        <label for="card-element">
                            {{ __('Credit Card') }}
                        </label>
                        <div id="card-element" class="form-control">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors -->
                        <div id="card-errors" class="form-text text-danger" role="alert"></div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="{{ __('Save billing details') }}">
                </form>
            </div>
        </div>
    </div>

    <script>
        var stripe = Stripe('pk_test_wvnvya7Ph7lPmmCd0aMKI284');
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var options = {
//            hidePostalCode: true,
            iconStyle: 'default',
            value: {
                postalCode: 'G1G 4B2'
            },
            style: {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '1.063rem',
                    lineHeight: '1.5'
                }
            }
        };

        // Create an instance of the card Element
        var card = elements.create('card', options);

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
</body>
</html>
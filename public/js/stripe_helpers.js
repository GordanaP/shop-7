/**
 * Mount the Stripe card elements.
 *
 * @param  Stripe stripe
 * @param  JSON\Objext
 * @return Stripe\Elements
 */
function mountCardElement(stripe, style)
{
    var elements = stripe.elements();

    var card = elements.create("card", {
        style: style,
        hidePostalCode: true
    });

    card.mount("#card-element");

    return card;
}

/**
 * Display Stripe card errors.
 *
 * @param  Stripe\Elements card
 */
function displayCardErrors(card)
{
    card.addEventListener('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('text-danger', 'text-xs');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('text-danger', 'text-xs');
            displayError.textContent = '';
        }
    });
}

/**
 * Update Stripe card postal code field.
 *
 * @param  Stripe\Elements card
 * @param  JS\Object field
 */
function updateCardBillingPostalCodeField(card, field)
{
    if(field.value) {
        card.update({value: {postalCode: field.value}});
    } else {
        field.addEventListener('change', function(event) {
            card.update({value: {postalCode: event.target.value}});
        });
    }
}

/**
 * Handle Stripe payment response.
 *
 * @param  JSON\Response response
 */
function handlePaymentResponse(response)
{
    var clientSecret = response.client_secret;
    var billingDetails = response.billing
    var shippingDetails = response.shipping;

    stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: card,
            billing_details: billingDetails
        },
        shipping: shippingDetails
    })
    .then(function(response) {
        handlePostPaymentResponse(response)
    });
}

/**
 * Handle response after a successful Stripe payment.
 *
 * @param  JSON\Response response
 */
function handlePostPaymentResponse(response)
{
    if (response.error) {
        if(response.error.type !== 'validation_error') {
            $('.alert-danger').show().text(response.error.message);
        }
    } else {
        if (response.paymentIntent.status === 'succeeded') {
            $.ajax({
                url: '/orders',
                type: 'POST',
                data: {
                    payment_intent_id: response.paymentIntent.id
                },
            })
            .then(function(result) {
                redirectTo(result.success)
            });
        }
    }
}
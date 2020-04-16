/**
 * Redirect to a location.
 *
 * @param  string location
 */
function redirectTo(location)
{
    window.location.href = location;
}

/**
 * Get the element by it's id.
 *
 * @param  string fieldId
 * @return JS ElementsObject
 */
function getById(id)
{
    return document.getElementById(id);
}

function billingDetails(customer, address)
{
    if(customer) {
        return getAddress(address);
    }
}

function shippingDetails(toggleBtn, address){
    if(isCheckedToggleBtn(toggleBtn)) {
        return myShipping(address);
    }
}

function getAddress(address)
{
    return {
        name : $('#'+address + 'Name').val(),
        address : {
            line1 : $('#'+address + 'Line1').val(),
            line2 : ' ',
            city : $('#'+address + 'City').val(),
            postal_code : $('#'+address + 'Postal_code').val(),
            country : $('#'+address + 'Country').val(),
        },
        phone: $('#'+address + 'Phone').val(),
        email: $('#'+address + 'Email').val()
    }
}

function myShipping(address)
{
    return {
        name : $('#'+address + 'Name').val(),
        address : {
            line1 : $('#'+address + 'Line1').val(),
            line2 : ' ',
            city : $('#'+address + 'City').val(),
            postal_code : $('#'+address + 'Postal_code').val(),
            country : $('#'+address + 'Country').val(),
        },
        phone: $('#'+address + 'Phone').val(),
    }
}

/**
 * Toggle hidden field visibility.
 *
 * @param  {string} fieldId
 * @return void
 */
function toggleVisibility(field)
{
    return $(field).toggle();
}

/**
 * Switch the toggle button's status.
 *
 * @param  JQuery\Object toggleBtn
 */
function switchToggleBtn(toggleBtn)
{
    toggleBtn.click( function() {
        if($(this).is(':checked')) {
            $(this).val('on');
        } else {
            $(this).val('off');
        }
    });
}

/**
 * Detemine if the toggle button is checked.
 *
 * @param  JQuery\Object  toggleBtn
 * @return boolean
 */
function isCheckedToggleBtn(toggleBtn)
{
    return toggleBtn.val() == 'on';
}

/**
 * Handle server response upon stripe payment.
 */
function handleServerResponse(response) {
    if (response.error) {
        console.log(response.error)
    } else if (response.requires_action) {
        // Create paymentIntent id
        stripe.handleCardAction(
            response.payment_intent_client_secret
        )
        .then(function(result) {
            if (result.error) {
                console.log(result.error)
            } else {
                // Send paymentIntent id back to server
                $.ajax({
                    url: payOrderUrl,
                    type: 'POST',
                    data: {
                        payment_intent_id: result.paymentIntent.id
                    }
                })
                .then(function(confirmResult) {
                    return confirmResult;
                });
            }
        });
    } else {
        clearForm();
        window.location.replace(response.success);
    }
}
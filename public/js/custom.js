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

function customerDetails(customer)
{
    if(customer) {
        return addressFromForm(customer)
    }
}

function addressFromForm()
{
    return {
        name : getById('billingName').value,
        address : {
            line1 : getById('billingLine1').value,
            line2 : ' ',
            city : getById('billingCity').value,
            postal_code : getById('billingPostal_code').value,
            country : getById('billingCountry').value,
        },
        phone: getById('billingPhone').value,
        email: getById('billingEmail').value
    }
}

function ucFirst(str)
{
    if (typeof str !== 'string') return ''
      return str.charAt(0).toUpperCase() + str.slice(1)
}


/**
 * Get the guest customer's address.
 *
 * @param  string address
 * @return JS\Object
 */
function getAddress(address)
{
    return {
        name : $('#'+address + 'Name').val(),
        street_address : $('#'+address + 'Line1').val(),
        city : $('#'+address + 'City').val(),
        postal_code : $('#'+address + 'Postal_code').val(),
        country : $('#'+address + 'Country').val(),
        phone: $('#'+address + 'Phone').val(),
        email: $('#'+address + 'Email').val()
    }
}
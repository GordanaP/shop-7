/**
 * Get the customer's address.
 *
 * @param  string address
 * @return JS\Object
 */
function getAddress(address)
{
    return {
        name : $('#'+address + 'Name').val(),
        street_address : $('#'+address + 'StreetAddress').val(),
        city : $('#'+address + 'City').val(),
        postal_code : $('#'+address + 'PostalCode').val(),
        country : $('#'+address + 'Country').val(),
        phone: $('#'+address + 'Phone').val(),
        email: $('#'+address + 'Email').val()
    }
}
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
 * @param  string id
 * @return JS\Object
 */
function getById(id)
{
    return document.getElementById(id);
}

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

/**
 * Toggle hidden field visibility.
 *
 * @param  string field
 */
function toggleVisibility(field)
{
    $(field).toggle();
}

/**
 * Switch the toggle button's status.
 */
$.fn.switchStatus = function()
{
    $(this).click( function() {
        if($(this).is(':checked')) {
            $(this).val('on');
        } else {
            $(this).val('off');
        }
    });
}

/**
 * Switch from thumbnail to main image.
 *
 * @param  JQ\Object mainImage
 */
$.fn.switchToMainImage = function(mainImage)
{
    $(this).each(function(el) {
        $(this).hover(function() {
            $(this).css('cursor','pointer');
        });

        $(this).on('click', function(ev) {
            mainImage.attr('src', $(this).attr('src'));
        });
    });
}

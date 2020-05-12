/**
 * Reset the modal content upon close.
 *
 * @param  array errors
 * @param  array hiddenElems
 */
$.fn.clearContentOnClose = function(errors)
{
    $(this).on("hidden.bs.modal", function() {
        clearErrors(errors);
    });
}

/**
 * Clear the form content.
 */
$.fn.clearFormContent = function()
{
    $(this).find('form').trigger('reset');
}

/**
 * The modal autofocus field.
 *
 * @param string elementId
 */
$.fn.autofocus = function(elementId) {
    $(this).on('shown.bs.modal', function () {
        $(this).find(elementId).focus();
    });
}

/**
 * Close the modal.
 */
$.fn.close = function()
{
    $(this).modal('hide');
}

/**
 * Open the modal.
 */
$.fn.open = function()
{
    $(this).modal('show');
}

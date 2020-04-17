/**
 * Clear hidden errors.
 *
 * @param  JQ\Object hiddenField
 */
$.fn.clearHiddenFieldContent = function(hiddenField)
{
    $(this).on('click', function() {
        if($(this).is(':checked')) {
            hiddenField.find('.invalid-feedback').empty().hide();
            hiddenField.find('input, select').val('');
        }
    });
}

/**
 * Remove the error upon triggering an event on a given element.
 */
function clearErrorOnTriggeringAnEvent()
{
    $("input, textarea").on('focus', function () {
        $(this).next('.invalid-feedback').empty();
    });

    $("select").on('change', function () {
         $(this).next('.invalid-feedback').empty();
    });

    $("input[type=radio]").on('click', function() {
        $(this).parent().siblings('.invalid-feedback').empty();
    });

    $("input[type=checkbox]").on('click', function() {
        $(this).parent().siblings('.invalid-feedback').empty();
    });
}

/**
 * Display errors.
 *
 * @param  array errors
 */
function displayErrors(errors)
{
    for (error in errors) {
        var errorMessage = errors[error][0];
        errorContainer(error).show().text(errorMessage);
    }
}

/**
 * Html element containing the given error.
 *
 * @param  string error
 * @return JQuery\Jquery Object
 */
function errorContainer(error)
{
    var className = error.replace(/\./g, "-");

    return $('.'+className);
}
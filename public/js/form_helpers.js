$.fn.switchColor = function(placeholderColor, optionColor)
{
    if ($(this).val()) {
        $(this).css('color', optionColor);
    }

    $(this).on('change', function(){
        if ($(this).val()) {
            $(this).css('color', optionColor)
        }
        else {
            $(this).css('color', placeholderColor)
        }
    });
}

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
        $(this).parents().eq(1).siblings('.invalid-feedback').empty();
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
 * Clear all errors.
 *
 * @param  array errors
 */
function clearErrors(errors)
{
    $.each(errors, function (index, error) {
        errorContainer(error).hide().empty();
    });
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

/**
 * Check the radio input.
 *
 * @param  mixed value
 */
function checkRadioValue(value)
{
    $("input:radio[value="+value+"]").prop('checked', true);
}


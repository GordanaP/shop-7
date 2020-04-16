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
    var className = error.replace(/\./g, "_");

    return $('.'+className);
}
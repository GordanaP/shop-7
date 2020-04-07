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

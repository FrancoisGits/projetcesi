/* all miscellaneous functions related to updateUserForm */

/**
 * export to main.js
 * Fires addStarToLabel on each required field
 */
export const addStarToLabels = function () {
    requiredFields.forEach(field => addStarToLabel(field))
};

/**
 * All form fields matching attribute required
 * @type {NodeListOf<Element>}
 */
const requiredFields = document.querySelectorAll('.formInput[required]');

/**
 * Adds a star to an element's label
 * @param e
 */
const addStarToLabel = function (e) {
    let fieldId = e.getAttribute('id');
    if (fieldId === 'civilite1' || fieldId === 'civilite2'){
        fieldId = 'civilite';
    }
    let requiredFieldsLabel = document.querySelector('label[for=' + fieldId + ']');
    if (!requiredFieldsLabel.innerHTML.includes('*')){
        requiredFieldsLabel.innerHTML += ' *';
    }
};
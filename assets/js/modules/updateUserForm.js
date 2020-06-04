/* all miscellaneous functions related to updateUserForm -- jQuery & Ajax */
import {requestInseeCodes} from './dynamicSelect.js';

/**
 * export to main.js
 * Fires addStarToLabel on each required field
 */
export const addStarToLabels = function () {
    requiredFields.forEach(field => addStarToLabel(field))
};

/**
 * Request base URI
 * @type {string}
 */
const BASE_URI = "http://connectlife.test/actions/";

/**
 * All form fields matching attribute required
 * @type {NodeListOf<Element>}
 */
const requiredFields = document.querySelectorAll('.formInput[required]');

/**
 *All form fields
 * @type {NodeListOf<Element>}
 */
const fields = document.querySelectorAll('input');

/**
 * All form fields depending on wether the user is a professional or not
 * @type {NodeListOf<Element>}
 */
const societeRelatedFields = document.querySelectorAll('.societe');

/**
 * gets info about the current user.
 */
export const getCurrentUser = () => {
    $.ajax({
        url: BASE_URI + "getCurrentUser.php",
        type: 'GET',
        dataType: 'json',

        success: function (data, status) {
            if (fields) {
                if (data.isSociete === '0') {
                    hideFields(societeRelatedFields);
                    phoneFieldToggle();
                }
                populateFieldsWithData(fields, data);
            }
        }
    });
};

/**
 * Toggles phone related fields names and required attributes.
 */
const phoneFieldToggle = () => {
    const telPro = document.getElementById('telPro');
    const telPerso = document.getElementById('telPerso');
    const phoneDisclaimer = document.querySelector('.phoneDisclaimer');
    const telProLabel = document.querySelector('label[for=telPro]');
    const telPersoLabel = document.querySelector('label[for=telPerso]');

    if (telPro && telPerso) {
        telPro.removeAttribute('required');
        telPerso.removeAttribute('required');
    }

    if (phoneDisclaimer && telProLabel && telPersoLabel) {
        phoneDisclaimer.style.display = 'flex';
        telProLabel.innerHTML = 'Téléphone fixe';
        telPersoLabel.innerHTML = 'Téléphone portable';
    }

    const submitBtn = document.querySelector('#updateUserFormSubmitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', (e) => {
            if (telPro.value === '' && telPerso.value === '') {
                telPerso.placeholder = 'Merci de renseigner ce champ';
                telPerso.focus();
                e.preventDefault();
            }
        });
    }
};

/**
 * Adds a star to an element's label
 * @param e
 */
const addStarToLabel = function (e) {
    let fieldId = e.getAttribute('id');
    if (fieldId === 'madame' || fieldId === 'monsieur') {
        fieldId = 'civilite';
    }
    let requiredFieldsLabel = document.querySelector('label[for=' + fieldId + ']');
    if (!requiredFieldsLabel.innerHTML.includes('*')) {
        requiredFieldsLabel.innerHTML += ' *';
    }
};

/**
 * hides fields
 * @param fields
 */
const hideFields = (fields) => {
    Array.from(fields).forEach(field => {
        field.querySelector('input').removeAttribute('required');
        field.style.display = "none";
    })
};

/**
 * form fields pre-filling.
 * @param fields
 * @param data
 */
const populateFieldsWithData = (fields, data) => {
    const madame = document.getElementById('madame');
    const monsieur = document.getElementById('monsieur');
    if (madame && data.civilite === 'Mme') {
        madame.checked = true;
    } else if (monsieur && data.civilite === 'M.') {
        monsieur.checked = true;
    }
    Array.from(fields).forEach(field => {
        let fieldName = field.getAttribute('name');
        switch (fieldName) {
            case 'nom':
                if (data.nom) {
                    field.value = data.nom;
                }
                break;
            case 'prenom':
                if (data.prenom) {
                    field.value = data.prenom;
                }
                break;
            case 'email':
                if (data.mail) {
                    field.value = data.mail;
                }
                break;
            case 'adresse1':
                if (data.adresse1) {
                    field.value = data.adresse1;
                }
                break;
            case 'adresse2':
                if (data.adresse2) {
                    field.value = data.adresse2;
                }
                break;
            case 'codePostal':
                if (data.codePostal) {
                    field.value = data.codePostal;
                    requestInseeCodes();
                }
                break;
            case 'telPro':
                if (data.telPro) {
                    field.value = data.telPro;
                }
                break;
            case 'telPerso':
                if (data.telPerso) {
                    field.value = data.telPerso;
                }
                break;
            case 'societe':
                if (data.societe) {
                    field.value = data.societe;
                }
                break;
            case 'poste':
                if (data.poste) {
                    field.value = data.poste;
                }
        }
    })
};


/* dynamicSelect Module fires a query to fill the select element dynamically with zip codes -- uses jQuery and Ajax */

/**
 * Request base URI
 * @type {string}
 */
const BASE_URI = "http://projetcesi.test/actions/";

/**
 * Form element to select a city
 * @type {jQuery|HTMLElement}
 */
const citySelect = $("#codeInsee");

/**
 * CodePostal input field
 * @type {jQuery|HTMLElement}
 */
const codePostalField = $("#codePostal");

/**
 * Exports to main.js
 * Fires a query on keyup in codePostal field
 */
export const codePostalObserver = function(){
    codePostalField.keyup(function () {
        requestInseeCodes();
    });
};

/**
 * Request insee codes from api
 */
const requestInseeCodes = function () {
    // fires the query if user has type 4 or 5 characters only
    let count = codePostalField.val().length;
    citySelect.attr("disabled", true);
    if (!!codePostalField.val() && count >= 4 && count <= 5){
        $.ajax({
            url: BASE_URI + "getInsee.php",
            type: 'GET',
            data: codePostalField.serialize(),
            dataType: 'json',

            success: function(data, status){
                citySelect.empty();
                data.sort(dynamicSort("ville"));
                addOptions(data);
                if (data.length > 0){
                    citySelect.removeAttr("disabled");
                }
            },

            complete: function(result, status,error){
            },

            error: function (result, status, error) {
            },
        })
    }

};

/**
 * Add an <option> for each item in the data response array
 * @param data
 */
const addOptions = function (data) {
    data.forEach(function (item) {
        let optionValue = item.id;
        let optionText = !item.complement ? item.ville : item.ville + ` (${item.complement}) `;
        let option = new Option(optionText, optionValue);
        citySelect.append(option);
    })
};

/**
 * Allows sorting of an array of objects by property i.e. data.sort(dynamicSort(property))
 * @param property
 * @returns {function(*, *): number}
 */
const dynamicSort = function (property) {
    let sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        let result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
};
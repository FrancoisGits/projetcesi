/* exportForm Module fires a query in order to display a message if files are not up to download -- uses jQuery and Ajax */

/**
 * Request base URI
 * @type {string}
 */
const BASE_URI = "http://connectlife.test/actions/";

/**
 * Download not available message
 * @type {HTMLElement}
 */
export const downloadNotAvailable = document.getElementById('downloadNotAvailable');

/**
 * button to export last users
 * @type {HTMLElement}
 */
const exportLastButton = document.getElementById('exportLastButton');

/**
 * Requests last registered users count from api
 */
export const getLastUsers = () => {
    $.ajax({
        url: BASE_URI + "getLastUsers.php",
        type: 'GET',
        dataType: 'json',

        success: function (data, status) {
            if (data.toExport === '0' && downloadNotAvailable){
                downloadNotAvailable.style.display = 'flex';
                exportLastButton.disabled = true;
            } else if (data.toExport !== '0' && downloadNotAvailable) {
                downloadNotAvailable.style.display = 'none';
                exportLastButton.disabled = false;
            }
        }
    });
};
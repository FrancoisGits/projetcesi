/* security module prevents user from altering some elements of the DOM */

/**
 * export full observer to main.js
 */
export const securizeMutations = function () {
    observer.observe(document.body, config);
};

/**
 * Config for the mutation observer
 * @type {{subtree: boolean, attributes: boolean, childList: boolean}}
 */
const config = {
    attributes: true,
    childList: true,
    subtree: true
};

/**
 * Mutation observer callback
 * Reload pages if user tries to alter fields being required or having a regex pattern
 * @param mutationsList
 */
const callback = function (mutationsList) {
    for (let mutation of mutationsList) {
        if (mutation.type == 'attributes') {
            if (mutation.attributeName == 'required' || mutation.attributeName == 'pattern') {
                alert('¯\\_(シ)_/¯');
                document.location.reload();
            }
        }
    }
};

/**
 * Observe mutations
 * @type {MutationObserver}
 */
const observer = new MutationObserver(callback);
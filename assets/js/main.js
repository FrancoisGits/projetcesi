import * as updateForm from "./modules/updateUserForm.js";
import * as exportForm from "./modules/exportForm.js";
import * as security from "./modules/security.js";
import * as select from "./modules/dynamicSelect.js";

window.onload = updateForm.getCurrentUser;
if (exportForm.downloadNotAvailable) {
    window.onload = exportForm.getLastUsers;
    window.setInterval(exportForm.getLastUsers, 4000);
}
updateForm.addStarToLabels();
security.securizeMutations();
select.codePostalObserver();




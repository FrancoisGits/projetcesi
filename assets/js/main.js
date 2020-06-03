import * as updateForm from "./modules/updateUserForm.js";
import * as security from "./modules/security.js";
import * as select from "./modules/dynamicSelect.js";

window.onload = updateForm.getCurrentUser;
updateForm.addStarToLabels();
security.securizeMutations();
select.codePostalObserver();
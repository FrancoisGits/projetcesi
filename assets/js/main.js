import * as updateForm from "./modules/updateUserForm.js";
import * as security from "./modules/security.js";
import * as select from "./modules/dynamicSelect.js";
import * as charCounter from "./modules/charactersCounter.js";

updateForm.addStarToLabels();
security.securizeMutations();
select.codePostalObserver();
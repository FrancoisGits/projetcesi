<form class="formGroup" action="../actions/updateUserAction.php" method="post">
    <div class="formInputGroup radioInputGroup">
        <label for="civilite">Civilité:</label>
        <div class="radioContainer">
            <label for="civilite1">Madame:</label>
            <input
                name="civilite"
                id="civilite1"
                value="0"
                class="formInput"
                required
                type="radio"
                checked>
        </div>
        <div class="radioContainer">
            <label for="civilite2">Monsieur:</label>
            <input
                name="civilite"
                id="civilite2"
                value="1"
                class="formInput"
                required
                type="radio">
        </div>
    </div>
    </div>
    <div class="formInputGroup">
        <label for="nom">Nom:</label>
        <input
            placeholder="Nom"
            name="nom"
            id="nom"
            class="formInput formError"
            required
            type="text">
    </div>
    <div class="formInputGroup">
        <label for="prenom">Prénom:</label>
        <input
            placeholder="Prénom"
            name="prenom"
            id="prenom"
            class="formInput"
            required
            type="text">
    </div>
    <div class="formInputGroup">
        <label for="societe">Nom de la société:</label>
        <input
            placeholder="Société"
            name="societe"
            id="societe"
            class="formInput"
            required
            type="text">
    </div>
    <div class="formInputGroup">
        <label for="poste">Poste occupé:</label>
        <input
            placeholder="Poste"
            name="poste"
            id="poste"
            class="formInput"
            required
            type="text">
    </div>
    <div class="formInputGroup">
        <label for="adresse1">Adresse 1:</label>
        <input
            placeholder="123, rue Delarue"
            name="adresse1"
            id="adresse1"
            class="formInput"
            required
            type="text">
    </div>
    <div class="formInputGroup">
        <label for="adresse2">Adresse 2:</label>
        <input
            placeholder="Appartement 1, étage 1"
            name="adresse2"
            id="adresse2"
            class="formInput"
            type="text">
    </div>
    <div class="formInputGroup">
        <label for="codePostal">Code Postal:</label>
        <input
            placeholder="75000"
            name="codePostal"
            id="codePostal"
            class="formInput"
            pattern="^[0-9]{4,5}"
            title="4 à 5 chiffres"
            required
            type="text">
    </div>
    <div id="selectInputGroup" class="formInputGroup">
        <label for="codeInsee">Ville:</label>
        <div class="select">
            <select
                name="codeInsee"
                id="codeInsee"
                class="formInput"
                disabled
                required>
            </select>
        </div>
    </div>
    <div class="formInputGroup">
        <label for="telPro">Téléphone professionel:</label>
        <input placeholder="03 45 67 89 01"
               name="telPro"
               id="telPro"
               class="formInput"
               type="text"
               required
               pattern="^(0[0-9]|\+[3]{2}\s?[0-9]{1})(\s?[0-9]{2}){4}"
               title="0 ou +33 suivi de 9 chiffres, avec ou sans espaces">
    </div>
    <div class="formInputGroup">
        <label for="telPerso">Téléphone personnel:</label>
        <input placeholder="06 78 90 12 34"
               name="telPerso"
               id="telPerso"
               class="formInput"
               type="text"
               required
               pattern="^(0[0-9]|\+[3]{2}\s?[0-9]{1})(\s?[0-9]{2}){4}"
               title="0 ou +33 suivi de 9 chiffres, avec ou sans espaces">
    </div>
    <div class="formInputGroup">
        <label for="email">Email:</label>
        <input placeholder="email@societe.com"
               name="email"
               id="email"
               class="formInput"
               required
               type="email">
    </div>
    <span>* Champs requis</span>
    <button type="submit">Valider</button>
</form>